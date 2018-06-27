<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->post('/api/auth', function (\Illuminate\Http\Request $request)  {
    $user = app('db')->table('users')->where('login', $request->login)
    ->where('password', $request->password)
    ->first();
    if ($user){
        return response()->json(['status' => 'success', 'user' => $user]);
    } else {
        return response()->json(['status' => 'error']);
    }
});
$router->get('/api/settings', function ()  {
    $results = app('db')->table('settings')->where('id', 1)->first();
    return response()->json($results);
 });
 $router->post('/api/settings/update', function (\Illuminate\Http\Request $request)  {
    $results = app('db')->table('settings')->where('id', 1)->update(['purse' => $request->purse]);
    if ($request->status == 1){
        app('db')->table('users')->where('id', 1)->update(['password' => $request->password]);
    }
   
    return response()->json($results);
 });
 $router->get('/api/requests', function ()  {
    $results = app('db')->select("SELECT * FROM requests");
    return $results;
 });
 $router->get('/api/requests/{id}', function ($id)  {
    $results = app('db')->table('requests')->where('id', $id)->first();
    return response()->json($results);
 });
 $router->post('/api/requests/{id}/update', function (\Illuminate\Http\Request $request)  {

   $results = app('db')->table('requests')->where('id', $request->id)
            ->update([
                'phone' => $request->phone,
                'summBTC' => $request->summBTC,
                'status' => $request->status,
                'summRUB' => $request->summRUB,
                'session' => $request->session
                ]);
    return response()->json($results);
 });
$router->get('/', function () use ($router) {
    return view('index');
});
$router->get('/admin', function () use ($router) {
    return view('admin');
});
$router->get('/admin/{path}', function ()  {
    return view('admin');
});
$router->get('/admin/requests/{id}', function ()  {
    return view('admin');
});
$router->get('/{id}', function ($id) {
    $results = app('db')->table('requests')->where('session', $id)->first();
    return view('history')->with('result',$results)->render();

});

$router->get('/jsrequest/exchange/rate', function () {
    $market = "bitstamp";
  $data = file_get_contents("https://bitaps.com/api/ticker/". $market);
  
  $respond = json_decode($data,true);
  $rub = $respond["fx_rates"]["rub"]; // Exchange rate Bitcoin to RUB is derived from the value of the USD
    return response()->json(['status' => 'success', 'BTCRUB' => $rub]);

});
$router->post('jsrequest/checkphone/', function (\Illuminate\Http\Request $request) {

   
    $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"http://gsm-inform.ru/api/info/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "phone=+7 ".$request->number."&get-phone-info=on");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        $result = json_decode($server_output);

        $settings = app('db')->table('settings')->where('id', 1)->first();

        if (isset($result->operator)){
  $payout_address = $settings->purse;
  $confirmations = 3;
  $fee_level = "low";
  $actual_link = "http://$_SERVER[HTTP_HOST]";

  $callback = urlencode($actual_link."/jsrequest/transation/callback");
  
  $data = file_get_contents("https://bitaps.com/api/create/payment/". $payout_address. "/" . $callback . "?confirmations=" . $confirmations. "&fee_level=" . $fee_level);
  $respond = json_decode($data,true);
  $address = $respond["address"]; // Bitcoin address to receive payments
  $payment_code = $respond["payment_code"]; //Payment Code
  $invoice = $respond["invoice"]; // Invoice to view payments and transactions
 
  $dataQercode = file_get_contents("https://bitaps.com/api/qrcode/". $address);
    app('db')->table('requests')->insert(
    [
        'phone' => '+7 '.$request->number, 
        'status' => 0,
        'payment_code' => $payment_code,
        'session' => $respond["invoice"]
    ]
);
  $respo = json_decode($dataQercode,true);
  $qrcode = $respo["qrcode"]; // QR code in base64 encoded svg format
            return response()->json(
                [   'status' => 'success', 
                    'provider' => $result->operator, 
                    'pay' => $address,
                    "qrcode" => $qrcode, 
                    "invoice" => $respond["invoice"]
                ]);
        }

     
       
});
$router->get('/jsrequest/transation/monitoring/{number}/1', function ($number) {
    $results = app('db')->table('requests')->where('session', $number)->first();
    if ($results->status == 1){
        $data = file_get_contents("https://bitaps.com/api/transaction/". $results->tx_hash);
        return response()->json(['status' => 'success', 'tx_status' => 3, 'amount' => $results->summBTC, 'paid_amount' => $results->summRUB]);
    } else {
        return response()->json(['status' => 'failed', 'error' => "not found"]);
    }

  

});

$router->post('/jsrequest/transation/callback', function (\Illuminate\Http\Request $request) {
   
    $request = app('db')->table('requests')->where('invoice', $_POST ["invoice"])->first();

    $update = app('db')->table('requests')->where('id', $request->id)->update(
        [
            'tx_hash' => $request->tx_hash,
            'status' => 1,
            'summBTC' => $request->amount
        ]
    );

    echo $request->invoice;
    $to= "crashal@mail.ru"; 
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$subject = "Pay Bitcoin";

        $message = '
            <html>
            <head>
            <title>Pay to</title>
            </head>
            <body>
            '.$actual_link.'
                '.$_POST.'
            </body>
            </html>
        ';

$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

$headers .= "From: Birthday Reminder <birthday@example.com>\r\n";
$headers .= "Cc: crashall@mail.ru\r\n";

mail($to, $subject, $message, $headers);
});