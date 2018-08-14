<!DOCTYPE html>

<html lang="en" data-textdirection="ltr" class="loading">

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">

    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">

    <meta name="author" content="PIXINVENT">

    <title>ReviewChamp</title>

    <link rel="apple-touch-icon" href="{{url('assets')}}/app-assets/images/ico/apple-icon-120.png">

    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets')}}/app-assets/images/ico/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/feather/style.min.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/flag-icon-css/css/flag-icon.min.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/extensions/pace.css">

    <!-- END VENDOR CSS-->

    <!-- BEGIN STACK CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/bootstrap-extended.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/app.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/colors.css">

    <!-- END STACK CSS-->

    <!-- BEGIN Page Level CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">

    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/style.css">

    <!-- END Custom CSS-->

 </head>

<body>

<div class="content-wrap">

  <div class="container">

    <div class="row">

       <div class="col-md-0 col-sm-3 col-xs-3">

       </div>

      <div class="col-md-0 col-sm-8 col-xs-8">

        <div class="widget-wrap">

          <img class="img-responsive" src="{{ url('assets') }}/review_widget-img.png" alt="logo" > 

          @php

             $review=App\Rating::where('customer_id', Auth::user()->id)->get()->count();
            
        @endphp

          <div class="field"><input type="text" class="reviewwidget" readonly="" value="{{ $review_counts }}"></div>

        </div>

      </div>

    </div>

  </div> 

</div>      



<script src="{{url('assets')}}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

<script src="{{url('assets')}}/app-assets/js/core/app-menu.js" type="text/javascript"></script>

<script src="{{url('assets')}}/app-assets/js/core/app.js" type="text/javascript"></script>



<script type="text/javascript">

  function copyclip()

  {

    var copyText = document.getElementById("projectinput9");

    copyText.select();

    document.execCommand("Copy");

  }

</script>

<script type="text/javascript">

  $(function(){ /* to make sure the script runs after page load */



  $('.item').each(function(event){ /* select all divs with the item class */

  

    var max_length = 150; /* set the max content length before a read more link will be added */

    

    if($(this).html().length > max_length){ /* check for content length */

      

      var short_content   = $(this).html().substr(0,max_length); /* split the content in two parts */

      var long_content  = $(this).html().substr(max_length);

      

      $(this).html(short_content+

             '<a href="#" class="read_more"> Read More</a>'+

             '<span class="more_text" style="display:none;">'+long_content+'</span>'); /* Alter the html to allow the read more functionality */

             

      $(this).find('a.read_more').click(function(event){ /* find the a.read_more element within the new html and bind the following code to it */

 

        event.preventDefault(); /* prevent the a from changing the url */

        $(this).hide(); /* hide the read more button */

        $(this).parents('.item').find('.more_text').show(); /* show the .more_text span */

     

      });

    }

  });

});

  

$('#input-radio-11').click(function(){

// var yes= $('#input-radio-11').val();

    $('.reviews_show').show();

});

$('#input-radio-12').click(function(){

 //var yes= $('#input-radio-12').val();

 $('.reviews_show').hide();

});

</script>

</body>

</html>