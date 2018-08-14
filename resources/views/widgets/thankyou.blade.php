<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review Champ</title>
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
    
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/assets/css/style.css">
    <!-- END Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/reviews-efx.css"> 
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/reviews-efx-style.css">
</head>
<body>
  
<header>
    <div class="header-cnt">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <img class="img-responsive" src="{{ url('storage/logos/'. $logo) }}" alt="" />
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
             <center>
            <span style="font-weight: bold; font-size: 18px; text-align: center;"><p><?php echo  $message; ?></p></span>
            <span style="text-align: center;font-size: 30px; font-weight: bold; color: #3a85bd;"><a href="tel:"><?php echo $phone; ?></a></span>
            <p class="rc-website-link">Visit Our Website: <a href="<?php echo $website; ?>" style="font-weight: bold; font-size: 18px; text-align: center;"><?php echo $website; ?></a></p>
           </center>
          </div>
            </div>
          </div>
        </div>
        <div class="header-border">
        </div>
</header> 

@if(Session::get('message') =='yes')
<div class="content-wrap">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="title-section">
            <h3>Just One More Step!</h3>
              <p>Thank you for your favorable review. Rest assured you can expect the same high-quality service the next time you need our services.</p>
              <p>Now, we invite you to share your review - and perhaps a brief comment - on one of the public review sites featured below. To proceed, simply click on the review website link of your choice.</p>
        </div>
          <div class="social-box">
            <ul style="width: 100%">

            <?php
            
              //1 = Facebook, 2 = Google, 3 = Yelp

              $rc_fb_business = 0;
              $rc_google_business = 0;
              $rc_yelp_business = 0;
              $rc_other_business = 0;
            ?>

            @foreach($socialmedia as $media)

              <?php 

                if ( $media->social_id == 1) { $rc_fb_business = 1; } 
                if ( $media->social_id == 2) { $rc_google_business = 1; } 
                if ( $media->social_id == 3) { $rc_yelp_business = 1; }  
              ?>

              <li> 
                <a target="_blank" href="<?php echo $media->social_page_review_url; ?>">
                  <img class="img-responsive" src="@if($media->socialname->logo != 'review.png') {{url('assets/'.$media->socialname->logo)}} @endif" alt="" />
                </a>
                @php
                $review=App\Rating::where('review_type',$media->social_id)->get()->count();
                @endphp
              </li>

            @endforeach


              <?php 

                if ( $rc_fb_business == 0) { ?>

                  <li>
                    <a>
                      <img class="img-responsive" src="{{ url('assets/starimg') }}/fb.png" alt="" />
                    </a>
                  </li>

                <?php } ?>
                
              <?php  if ( $rc_google_business == 0) { ?>

                  <li>
                    <a>
                      <img class="img-responsive" src="{{ url('assets/starimg') }}/gm.png" alt="" />
                    </a>
                  </li>

              <?php }

                if ( $rc_yelp_business == 0) { ?>

                  <li>
                    <a>
                      <img class="img-responsive" src="{{ url('assets/starimg') }}/yelp.png" />
                    </a>
                  </li>

              <?php } ?>

          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@else
<div class="content-wrap">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="title-section">
          <h5>Looks like we missed the mark.</h5>
            <p>We're sorry to hear that you're disappointed in our recent performance.  A member of our team will contact you shortly to see what we can do to make matters right. We won't be satisfied until we do.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endif



<footer class="share-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-9 col-xs-12 foo-copy">
        <p>Copyright © 2018 – Review Champ – All rights reserved</p>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 foo-img">
        <img class="img-responsive" src="{{ url('assets') }}/assets/img/footer-logo.jpg" alt="" />
      </div>
    </div>
  </div>
</footer> 
    
<script src="{{url('assets')}}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<script src="{{url('assets')}}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{url('assets')}}/app-assets/js/core/app.js" type="text/javascript"></script>
<script type="text/javascript">
  function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  }
</script>
</body>
</html>