<!DOCTYPE html>

<html lang="en" data-textdirection="ltr" class="loading">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@php 

            $title=App\Settings::where('set_type','title')->first();

        @endphp

        {{$title->set_value}}</title>
<link rel="apple-touch-icon" href="{{url('assets')}}/app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

<!-- BEGIN VENDOR CSS-->

<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/custom.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/feather/style.min.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/extensions/pace.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/forms/icheck/custom.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/{{url('assets')}}/app-assets/vendors/css/charts/morris.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/extensions/unslider.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/weather-icons/climacons.min.css">

<!-- END VENDOR CSS-->

<!-- BEGIN STACK CSS-->

<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/colors.css">

<!-- END STACK CSS-->

<!-- BEGIN Page Level CSS-->

<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/colors/palette-climacon.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/meteocons/style.min.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/pages/users.css">

<!-- END Page Level CSS-->

<!-- BEGIN Custom CSS-->

<link rel="stylesheet" type="text/css" href="{{url('assets')}}/assets/css/style.css">

<!-- END Custom CSS-->

<link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/style.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/karma-political-blue.css">
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/css/mobile.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

</head>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" style="background-color: white!important;">
<header role="banner" id="header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" class=""> <a href="#tt-mobile-menu-list" id="tt-mobile-menu-button"><span>Main Menu</span></a>
  <div id="tt-mobile-menu-wrap">
    <ul class="sf-menu sf-js-enabled sf-arrows" id="tt-mobile-menu-list" style="display: none;">
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10246 current_page_item" id="menu-item-11383"><a href="http://www.reviewchamp.net/"><span><strong>Home</strong></span></a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11352"><a href="http://www.reviewchamp.net/about/"><span><strong>About</strong></span></a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children" id="menu-item-11353"><a href="http://www.reviewchamp.net/benefits/" class="sf-with-ul"><span><strong>Benefits</strong></span></a>
        <ul class="sub-menu" style="display: none;">
          <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11356"><a href="http://www.reviewchamp.net/benefits/reputation-management/"><span>Reputation Management</span></a></li>
          <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11357"><a href="http://www.reviewchamp.net/benefits/employee-performance-tracking/"><span>Employee Performance Tracking</span></a></li>
          <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11364"><a href="http://www.reviewchamp.net/benefits/building-favorable-public-review/"><span>Building Favorable Public Review</span></a></li>
          <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11365"><a href="http://www.reviewchamp.net/benefits/managing-customer-expectations/"><span>Managing Customer Expectations</span></a></li>
        </ul>
        <i class="fa fa-chevron-down"></i></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11354"><a href="http://www.reviewchamp.net/how-it-works/"><span><strong>How it Works</strong></span></a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children" id="menu-item-11355"><a href="http://www.reviewchamp.net/what-you-get/" class="sf-with-ul"><span><strong>What You Get</strong></span></a>
        <ul class="sub-menu" style="display: none;">
          <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11369"><a href="http://www.reviewchamp.net/what-you-get/custom-emails/"><span>Custom Emails</span></a></li>
          <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11368"><a href="http://www.reviewchamp.net/what-you-get/user-friendly-dashboard/"><span>User-friendly Dashboard</span></a></li>
          <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11367"><a href="http://www.reviewchamp.net/what-you-get/website-widget/"><span>Website widget</span></a></li>
          <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11366"><a href="http://www.reviewchamp.net/what-you-get/customer-e-list/"><span>Customer E-List</span></a></li>
        </ul>
        <i class="fa fa-chevron-down"></i></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11348"><a href="http://www.reviewchamp.net/subscribe-online/"><span><strong>Subscribe Online</strong></span></a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page" id="menu-item-11347"><a href="http://www.reviewchamp.net/contact/"><span><strong>Contact</strong></span></a></li>
    </ul>
  </div>
  <div class="header-holder ">
    <div class="header-overlay">
      <div class="header-area"> <a href="http://www.reviewchamp.net" class="logo"><img src="http://www.reviewchamp.net/wp-content/uploads/2017/12/site-logo-1.png" alt="Review Champ" class="tt-retina-logo" width="200" height="71"></a>
        <div class="header-right">
          <div class="header-call">
            <div class="textwidget">
              <p><a href="tel:860 316 2541">860.316.2541</a> Call Us Today!</p>
            </div>
          </div>
          <div class="header-login">
            <div class="textwidget">
              <p><a href="#"><i class="fa fa-lock"></i>Client Login</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="header-menu">
        <div class="headermenu-inner">
          <div class="header-area">
            <nav role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
              <ul id="menu-main-nav" class="sf-menu sf-js-enabled sf-arrows" style="touch-action: pan-y;">
                <li id="menu-item-11383" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10246 current_page_item"><a href="http://www.reviewchamp.net/"><span><strong>Home</strong></span></a> </li>
                <li id="menu-item-11352" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/about/"><span><strong>About</strong></span></a></li>
                <li id="menu-item-11353" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children parent"><a href="http://www.reviewchamp.net/benefits/" class="sf-with-ul"><span><strong>Benefits</strong></span></a>
                  <ul class="sub-menu" style="display: none;">
                    <li id="menu-item-11356" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/benefits/reputation-management/"><span>Reputation Management</span></a></li>
                    <li id="menu-item-11357" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/benefits/employee-performance-tracking/"><span>Employee Performance Tracking</span></a></li>
                    <li id="menu-item-11364" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/benefits/building-favorable-public-review/"><span>Building Favorable Public Review</span></a></li>
                    <li id="menu-item-11365" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/benefits/managing-customer-expectations/"><span>Managing Customer Expectations</span></a></li>
                  </ul>
                </li>
                <li id="menu-item-11354" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/how-it-works/"><span><strong>How it Works</strong></span></a></li>
                <li id="menu-item-11355" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children parent"><a href="http://www.reviewchamp.net/what-you-get/" class="sf-with-ul"><span><strong>What You Get</strong></span></a>
                  <ul class="sub-menu" style="display: none;">
                    <li id="menu-item-11369" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/what-you-get/custom-emails/"><span>Custom Emails</span></a></li>
                    <li id="menu-item-11368" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/what-you-get/user-friendly-dashboard/"><span>User-friendly Dashboard</span></a></li>
                    <li id="menu-item-11367" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/what-you-get/website-widget/"><span>Website widget</span></a></li>
                    <li id="menu-item-11366" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/what-you-get/customer-e-list/"><span>Customer E-List</span></a></li>
                  </ul>
                </li>
                <li id="menu-item-11348" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/subscribe-online/"><span><strong>Subscribe Online</strong></span></a></li>
                <li id="menu-item-11347" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/contact/"><span><strong>Contact</strong></span></a></li>
                @if(isset(Auth::user()->id))
                <li id="menu-item-11347" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="{{ url('logout') }}"><span><strong>Logout</strong></span></a></li>
                @endif
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- END header-area --> 
    
  </div>
  <!-- END header-overlay --> 
  
</header>
@yield('content') 

<!--  <footer class="footer footer-static footer-light navbar-border" style="margin-left: 0px">

      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2017 <a href="#" target="_blank" class="text-bold-800 grey darken-2">Review </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block hidden-md-down"> <i class="ft-heart pink"></i></span></p>

    </footer> -->

<footer role="contentinfo" id="footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
  <div class="container">
    <div class="footer-logo"> <a href="http://www.reviewchamp.net/"><img width="239" height="84" src="http://www.reviewchamp.net/wp-content/uploads/2018/02/footer-logo.jpg" class="image wp-image-11408  attachment-full size-full" alt="" style="max-width: 100%; height: auto;"></a> </div>
    <div class="footer-copyright">
      <div class="textwidget">
        <p>Copyright © 2018 – Review Champ – All rights reserved</p>
      </div>
    </div>
    <div class="footer-menu">
      <ul>
        <li id="menu-item-11410" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10246 current_page_item"><a href="http://www.reviewchamp.net/"><span><strong>Home</strong></span></a></li>
        <li id="menu-item-11411" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/about/"><span><strong>About</strong></span></a></li>
        <li id="menu-item-11412" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/benefits/"><span><strong>Benefits</strong></span></a></li>
        <li id="menu-item-11413" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/how-it-works/"><span><strong>How it Works</strong></span></a></li>
        <li id="menu-item-11414" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/what-you-get/"><span><strong>What You Get</strong></span></a></li>
        <li id="menu-item-11415" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/subscribe-online/"><span><strong>Subscribe Online</strong></span></a></li>
        <li id="menu-item-11409" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="http://www.reviewchamp.net/contact/"><span><strong>Contact</strong></span></a></li>
      </ul>
    </div>
  </div>
</footer>

<!-- Scripts --> 

<script src="{{url('assets')}}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script> 

<!-- BEGIN VENDOR JS--> 

<!-- BEGIN PAGE VENDOR JS--> 

<script src="{{url('assets')}}/app-assets/vendors/js/charts/gmaps.min.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/app-assets/vendors/js/extensions/jquery.knob.min.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/app-assets/vendors/js/charts/jquery.sparkline.min.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/app-assets/vendors/js/extensions/unslider-min.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/app-assets/vendors/js/charts/echarts/echarts.js" type="text/javascript"></script> 

<!-- END PAGE VENDOR JS--> 

<!-- BEGIN STACK JS--> 

<script src="{{url('assets')}}/app-assets/js/core/app-menu.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/app-assets/js/core/app.js" type="text/javascript"></script> 

<!-- END STACK JS--> 

<!-- BEGIN PAGE LEVEL JS--> 

<script src="{{url('assets')}}/app-assets/js/scripts/pages/dashboard-fitness.js" type="text/javascript"></script> 

<!-- END PAGE LEVEL JS--> 

    <script>
        jQuery(document).ready(function(){
            if (jQuery(window).width() < 767){
                jQuery('#tt-mobile-menu-button').click(function () {
                    jQuery('#tt-mobile-menu-list').slideToggle('2000', function () {
                      // Animation complete.
                    });
                 });
            }
        });

        jQuery(document).ready(function(){
            if (jQuery(window).width() < 767){
                jQuery('.menu-item-has-children i.fa').click(function () {
                    jQuery('#tt-mobile-menu-list .sub-menu').slideToggle('2000', function () {
                        // Animation complete.
                    });
                 });
            }
        });

    </script>

    <!-- 
    <script>if (window.Stripe) $("#example-form").show()</script>
    -->
    
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
      
      /* ##### Card Elements ##### */
      var stripe_key = Stripe('pk_test_tjyBrfNsPo7kmYKfouTywDf6');
      var elements = stripe_key.elements();

      // Custom styling can be passed to options when creating an Element.
      // (Note that this demo uses a wider set of styles than the guide below.)
      var style = {
        base: {
          color: '#32325d',
          lineHeight: '18px',
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
            color: '#aab7c4'
          }
        },
        invalid: {
          color: '#fa755a',
          iconColor: '#fa755a'
        }
      };

      // Create an instance of the card Element.
      var card = elements.create('card', {style: style});

      // Add an instance of the card Element into the `card-element` <div>.
      card.mount('#card-element');

      // Handle real-time validation errors from the card Element.
      card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });

      // Handle form submission.
      var form = document.getElementById('submit_register');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        $('.form-in-process').show(700);

        stripe_key.createToken(card).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;

            $('.form-in-process').hide(700);

          } else {
            // Send the token to your server.
            
            //stripeTokenHandler(result.token);
            
            var token = result.token.id;

            // insert the stripe token
            var input = $("<input name='stripeToken' value='" + token + "' style='display:none;' />");
            form.appendChild(input[0]);
            // and submit            
            console.log(result);

            form.submit();
          }
        });
      });
      /* ##### /CARD ELEMENTS ##### */
    </script>

  </body>

</html>
