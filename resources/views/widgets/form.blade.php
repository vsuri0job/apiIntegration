<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Review Champ</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 

    <link href="bootstrap.min.css" rel="stylesheet">

    <link href="style.css" rel="stylesheet">



    <link rel="apple-touch-icon" href="{{url('assets')}}/app-assets/images/ico/apple-icon-120.png">

    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets')}}/app-assets/images/ico/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/bootstrap.min.css"> 

     <!-- <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/feather/style.min.css"> -->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- END VENDOR CSS-->

    <!-- BEGIN STACK CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/app.css">

    <!-- END STACK CSS-->

    <!-- BEGIN Page Level CSS-->

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">

    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">

    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->

     <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/style.css">

     <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/css/formstyle.css">

    <!-- End Custom CSS -->

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

      <div class="col-md-12 col-sm-12 col-xs-12" >

          <div class="title-section">

            <h5>Thanks for choosing to review us! Please follow the simple steps below to leave your feedback.</h5>

          </div>

      </div>

    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="review-form">

        <form class="form-horizontal" method="post" action="{{url('web-widget/'.$slug->company_slug)}}/rating">

          {{ csrf_field() }}

          <input type="hidden" name="customer_id" value="{{$slug->id}}">

          <input type="hidden" name="slug" value="{{$slug->company_slug}}">

          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">

              <div class="form-group">

                <label for="" class="col-sm-3 control-label">Full Name: </label>

                  <div class="col-sm-9">

                    <input type="text" name="name" class="form-control" id="" placeholder="First Name" value="{{old('name')}}">

                      @if ($errors->has('name'))

                      <span class="form-error">

                        <strong>{{ $errors->first('name') }}</strong>

                      </span>

                      @endif

                  </div>

              </div>

            </div>

            <!-- <div class="col-md-6 col-sm-6 col-xs-12">

                <div class="form-group">

                    <label for="" class="col-sm-2 control-label">Last name:</label>

                    <div class="col-sm-10">

                        <input type="text" name="lastname" class="form-control" id="" placeholder="Last Name">

                        @if ($errors->has('lastname'))

                        <span class="help-block">

                            <strong>{{ $errors->first('lastname') }}</strong>

                        </span>

                      @endif

                    </div>

                </div>

            </div> -->

            <div class="col-md-6 col-sm-6 col-xs-12">

              <div class="form-group">

                <label for="" class="col-sm-3 control-label">Email:</label>

                  <div class="col-sm-9">

                    <input type="email" name="email" class="form-control" id="" placeholder="E-mail" value="{{old('email')}}">

                    @if ($errors->has('email'))

                    <span class="form-error">

                      <strong>{{ $errors->first('email') }}</strong>

                    </span>

                    @endif

                  </div>

              </div>

            </div>

          </div>

        

          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">

              <div class="form-group">

                <label for="" class="col-sm-3 control-label">Phone:</label>

                <div class="col-sm-9">

                  <input type="tel" class="form-control" id="" placeholder="Phone" name="contact" value="{{old('contact')}}">

                  @if ($errors->has('contact'))

                  <span class="form-error">

                    <strong>{{ $errors->first('contact') }}</strong>

                  </span>

                  @endif

                </div>

              </div>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">

              <div class="form-group">

                <label for="" class="col-sm-3 control-label">Rate Us:</label>

                <div class="col-sm-9">

                  <div class="stars">

                    <input class="star star-5" id="star-5" type="radio" name="rating" value="5">

                    <label class="star star-5" for="star-5"></label>

                    <input class="star star-4" id="star-4" type="radio" name="rating" value="4">

                    <label class="star star-4" for="star-4"></label>

                    <input class="star star-3" id="star-3" type="radio" name="rating" value="3">

                    <label class="star star-3" for="star-3"></label>

                    <input class="star star-2" id="star-2" type="radio" name="rating" value="2">

                    <label class="star star-2" for="star-2"></label>

                    <input class="star star-1" id="star-1" type="radio" name="rating" value="1">

                    <label class="star star-1" for="star-1"></label>

                    @if ($errors->has('rating'))

                    <span class="form-error">

                      <strong>{{ $errors->first('rating') }}</strong>

                    </span>

                    @endif

                  </div>

                </div>

              </div>

            </div>

          </div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="form-group">

                <div class="col-md-12 col-sm-12 col-xs-12 form-btn">

                  <button type="submit" class="btn btn-default">Continue</button>

                </div>

                </div>

            </div>

          </div>

        </form>

      </div>

      

      @if($show_review->show_review=='yes')

        @foreach($rating as $rate)

        <div class="col-md-12">

            <div class="col-md-2">

              @if($rate->review_type=='1')

                <img src="{{url('assets')}}/facebook.png" width="100%">

              @endif

              @if($rate->review_type=='')

                <img src="{{url('assets')}}/logo.png" width="100%">

              @endif

            </div>

          <div class="col-md-4"> 

            <h6 style="color:red; margin-top: 11px;">By {{ucfirst($rate->name)}}, on {{date('d/m/Y', strtotime($rate->created))}}</h6>

          </div>

          <div class="col-md-3"></div>

          <div class="col-md-2">

            @if($rate->rating=='5')

            <img src="{{url('assets')}}/fill.png" width="74%" >

            @else

            <img src="{{url('assets')}}/blank.png"  width="74%"  >

            @endif

          </div>

        </div>

      <div class="col-md-12">

        <div class="col-md-12">

          <p> <p class="item">{{$rate->comment}}</p></p><hr style="border-bottom: thin solid rgba(6, 6, 6, 0.1);">

        </div>

      </div>

      @endforeach

      @endif

      </div>

    </div>

  </div>

</div></div>

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









</body>

</html>