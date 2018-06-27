<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="./История платежей_files/style.css">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="theme-color" content="#1478E2">
    <link href="https://btcphone.ru/static/favicon.png" rel="shortcut icon">
    <style>
    html, body {
    margin: 0;
    height: 100%;
    }
    body {
    color:#666;
    min-width: 480px;
    min-height:100%;
    background-color:whitesmoke;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    }
    .blue {
    color: #fff;
    background-color: #009cde;
    background-image: radial-gradient(circle farthest-side at center bottom, #009cde, #003087 125%);
    }
    </style>
 
    <title id="title">История платежей</title>
  <script type="text/javascript"></script></head>
  
  <body class="blue">
  
    <div class="wrapper" style="">
      <!-- <div class = "block_container content"> -->
      <!-- <div class="separator"></div> -->
      
      <div style="padding:2em;box-sizing: border-box;  overflow: hidden;">
        <div style="max-width:70em;overflow: hidden;margin:0px auto;">
          <a href="/"> <big style="color:white;font-family: xxc;">BTC Phone</big></a>
          <div style="float:right;">
            support@btcphone.ru
          </div>
          
          <div id="header" style="transition:0.6s;padding:1em;text-align: center;margin-top: 1em;margin-bottom: 4em;">
            <big id="xx" style="font-size: 1em;">Биткоин адрес для оплаты</big><br><br>
            <a style="color:white;" href="bitcoin:1Jz5irBp2hbaJpTEKSbem5k7eo5qPx4Xas" <big="" id="xx">  {{$result->session}}</a><br><br><br>
            <big id="xx" style="font-size: 1em;">История платежей для телефона</big><br>
            <br>
            <big id="xx" style="font-size: 1.5em;">{{$result->phone}}</big><br><br>
          </div>
          
          <div class="text-center" style="margin-top: 1em;font-size: 1.1em;">
            
            <table class="table">
              
          </table>
          
          
          
        </div>
      </div>
    </div>
    
    
  </div>
  
  


</body></html>