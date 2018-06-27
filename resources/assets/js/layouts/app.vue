<template>
  <div class="">
     <div class="main">
      <child/>
      <footer class="ui-footer bg-dark-gray">
            <div class="container pt-6 pb-6">
                <div class="row">
                <div class="col-md-4 col-sm-6 footer-about footer-col center-on-sm">
                        <img class="logo-transparent" src="https://geolocation.mobi/assets/img/logo/geo-logo-footer.svg" alt="Определить местоположение мобильного телефона" style="max-width: 300px;">
                        <p class="mt-1">
                            <!-- Text for footer -->
                        </p>
                    </div>
                    <div class="col-md-3 col-md-offset-2 col-xs-6 footer-col">
                        <h6 class="heading footer-heading">Наши услуги</h6>
                        <ul class="footer-nav">
                            <li><a href="#" data-scrollto="ventajas"><span class="fa fa-star"></span> Преимущества</a></li>
                            <li><a href="#" data-scrollto="pricing"><span class="fa fa-credit-card-alt"></span> цена</a></li>
                            <li><a href="#" data-scrollto="funcionamiento"><span class="fa fa-cogs"></span> Функционирование</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-6 footer-col">
                        <h6 class="heading footer-heading">Узнать больше</h6>
                        <ul class="footer-nav">
                            <li><a href="/cancel"><span class="fa fa-times"></span>Отказаться от подписки</a></li>
                            <li><a href="/contact"><span class="fa fa-commenting"></span> Контактная информация</a></li>
                            <li><a href="/terms_conditions"><span class="fa fa-file"></span> Правила и условия</a></li>
                            <li><a href="/politica_privacidad"><span class="fa fa-user-secret"></span> Политика конфиденциальности</a></li>
                            <li><a href="/politica_cookies"><span class="fa fa-bookmark"></span> Политика в отношении файлов cookie</a></li>
                        </ul>
                    </div>
                </div><!-- .row -->
            </div><!-- .container -->
            
            <!-- Footer Copyright -->
        <div class="footer-copyright bg-gray">
          <div class="container">
          <div class="row">
            <!-- Copyright -->
            <div class="col-sm-6 center-on-sm">
              <p>
                © 2016 - 2017 - Geolocation.mobi
              </p>
            </div>
   
          </div>
          </div><!-- .container -->
        </div><!-- .footer-copyright -->
            
      </footer>
    </div>
  </div>
</template>

<script>

export default {
  name: 'app-layout',

}
</script>
