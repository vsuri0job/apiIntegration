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
  <style>
  </style>
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
<div class="content-wrap">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="title-section">
          <h3>Check Out Our Online Reviews!</h3>
          <p>Thank you for taking time to read our real, unedited customer comments. If you'd like to leave a review of your own, simply click the button below.</p>
          <a href="{{ $url }}" class="btn-lr">Leave a Review</a>
        </div>
        <div class="social-box">
          <ul style="width: 100%";>

            <?php
              $rc_fb_business = 0;
              $rc_google_business = 0;
              $rc_yelp_business = 0;
              $rc_other_business = 0;
            ?>

            @foreach($socialmedia as $media)

            <li> 
              <a target="_blank" href="<?php echo $media->socialurl; ?>">
                <img class="img-responsive" src="{{url('assets/starimg/'.$media->socialname->logo)}}" alt="" />
              </a>
              @php
                $review=App\Rating::where('review_type',$media->social_id)
                        ->where('customer_id', $userid)
                        ->where('review_type','!=', 10)->avg('rating');
                $reivews=App\Rating::where('review_type',$media->social_id)
                        ->where('customer_id', $userid)
                        ->where('review_type','!=', 10)->count('rating');
                $avg = round($review);
              @endphp
              <br>

              <img class="img-responsive" src="{{url('assets')}}/{{$avg}}star.png" width="150px">

              <p>

              <!-- 1 = Facebook, 2 = Google, 3 = Yelp -->

              <?php 

                if ( $media->social_id == 1) { $rc_fb_business = 1; } 
                if ( $media->social_id == 2) { $rc_google_business = 1; } 
                if ( $media->social_id == 3) { $rc_yelp_business = 1; }  

              ?>

                @if($media->socialname->logo=="fb.png")
                  
                	<b><span social='{{ $media->social_id }}' style="color:#285c9e;">Total Reviews {{$reivews=App\Rating::where('review_type',$media->social_id)->where('customer_id', $userid)->count('rating') }}</span></b>
                @elseif($media->socialname->logo=="yelp.png")
                  
                  <b><span social='{{ $media->social_id }}' style="color:#285c9e;">
                    Total Reviews {{ $yelp ? $yelp : $reivews=App\Rating::where('review_type',$media->social_id)->where('customer_id', $userid)->count('rating') }}</span></b>
                @else
                  
                  <b><span social='{{ $media->social_id }}' style="color:#285c9e;">Total Reviews {{ $reivews=App\Rating::where('review_type',$media->social_id)->where('customer_id', $userid)->count('rating') }}</span></b>
                @endif
              </p>

            </li>
            @endforeach

            <?php
            if ( $rc_fb_business == 0) { ?>

              <li> 
                <a>
                  <img class="img-responsive" src="{{ url('assets/starimg') }}/fb.png" alt="">
                </a>
                <br>
                <img class="img-responsive" src="{{ url('assets') }}/5star.png" width="150px">
                <p><b><span social="1" style="color:#285c9e;">Total Reviews 0</span></b></p>
              </li>  
            
            <?php } 

            if ( $rc_google_business == 0) { ?>

              <li> 
                <a>
                  <img class="img-responsive" src="{{ url('assets/starimg') }}/gm.png" alt="">
                </a><br>
                <img class="img-responsive" src="{{ url('assets') }}/5star.png" width="150px">
                <p><b><span social="2" style="color:#285c9e;">Total Reviews 0</span></b></p>
              </li>  
            
            <?php } 

            if ( $rc_yelp_business == 0) { ?>

              <li> 
                <a>
                  <img class="img-responsive" src="{{ url('assets/starimg') }}/yelp.png" alt="">
                </a><br>
                <img class="img-responsive" src="{{ url('assets') }}/5star.png" width="150px">
                <p><b><span social="3" style="color:#285c9e;">Total Reviews 0</span></b></p>
              </li>

            <?php } ?>

          </ul>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body collapse in">
        <div class="card-block card-dashboard">
          <section id="stats-icon-subtitle-bg">
            <div class="row"><div class="col-md-12"></div>
              @foreach($rating as $rate)
             
                <div class="col-md-12"><hr></div>
                <div class="col-md-12 str-rate" style="margin-bottom: 2%">
                    <img src="{{url('assets')}}/{{$rate->rating}}star.png">
                </div>
                <div class="col-md-10" style="margin-top 20px;">
                    <p class="item">{{$rate->comment}} </p>
                    <h6 style="color:red;">By {{ucfirst($rate->name)}}, on {{date('m/d/Y', strtotime($rate->created_at))}}</h6>
                </div>
                <div class="col-md-2 tar">
                    <img src="{{url('assets/'.$rate->social->logo)}}" width="55%">
                </div>
             @endforeach
            </div>
          </section>
        </div>
        <h4>{{ $rating->links() }}</h4>
      </div>
    </div>
  </div>
</div>
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
