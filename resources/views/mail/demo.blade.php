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
    <!-- END Custom CSS-->
    <style>
@import url(http://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);



.cont {
  width: 93%;
  max-width: 350px;
  text-align: center;
  margin: 4% auto;
  padding: 30px 0;
  background: #111;
  color: #EEE;
  border-radius: 5px;
  border: thin solid #444;
  overflow: hidden;
}

hr {
  margin: 20px;
  border: none;
  border-bottom: thin solid rgba(255,255,255,.1);
}

div.title { font-size: 2em; }

h1 span {
  font-weight: 300;
  color: #Fd4;
}

.starrating-wrap {text-align: center;}
.starrating-inner {display: inline-block;}

div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
html body
{
    background-color: #c78250!important;
}
</style>
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar">
  <div class=" container content-body"><!-- Basic form layout section start -->
    <section id="horizontal-form-layouts">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="col-xl-12 col-lg-12" style="padding-left: 10%;padding-right: 10%;">
                <div class="card"><hr style="margin: 20px;height: -16px;border: none;border: 1px solid #f5f7fa;/* width: 100%; */height: 5px; background: #f5f7fa; margin: 0px">
                    <div class="card-header" style="border-bottom: 3px solid #f5f7fa;     padding: 10px 4px 12px 0px; box-shadow: 0px 1px 8px #888888;">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <img src="{{url('storage/logos/'.$slug->logo)}}" width="100px">
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                              {!! $slug->message !!}

                          </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 " style="margin-top: 30px" >
                            @foreach($socialmedia as $media)
                            <a href="{{$media->socialname->link}}" target="_blank">
                                <div class="col-md-4"><center><img src="{{url('assets/'.$media->socialname->logo)}}"></center>
                                 </div>
                            </a>
                            @endforeach 
                        </div>
                        <div class="col-md-12" style="width: 100%; height: 2px;background-color: #f5f7fa; margin-top: 50px"></div>
                        <div class="col-md-12"><h2 style="text-align: center;     font-size: 13px;margin-top: 20px">Thank you for allowing us to serve you. Below you can leave your review based on your experieince with our company.</h2></div>
                        <div class="col-md-12" > 
                          <div class="col-md-2"></div>
                          <div class="col-md-8">
                          <div class="card-body collapse in" style="margin-top: 30px">
                            <div class="card-block">
                                <div class="card-text">
                                <p>  </p></div>
                                <form class="form form-horizontal" method="post" action="{{url('web-widget/'.$slug->company_slug)}}/rating">
                                {{ csrf_field() }}
                                    <input type="hidden" name="customer_id" value="{{$slug->id}}">
                                    <input type="hidden" name="slug" value="{{$slug->company_slug}}">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <div class="starrating-wrap">
                                                <div class="starrating-inner"> 
                                                  <input class="star star-5" id="star-5" type="radio" name="rating" value="5"/>
                                                  <label class="star star-5" for="star-5"></label>
                                                  <input class="star star-4" id="star-4" type="radio" name="rating"  value="4"/>
                                                  <label class="star star-4" for="star-4"></label>
                                                  <input class="star star-3" id="star-3" type="radio" name="rating"  value="3"/>
                                                  <label class="star star-3" for="star-3"></label>
                                                  <input class="star star-2" id="star-2" type="radio" name="rating"  value="2"/>
                                                  <label class="star star-2" for="star-2"></label>
                                                  <input class="star star-1" id="star-1" type="radio" name="rating"  value="1"/>
                                                  <label class="star star-1" for="star-1"></label>
                                                </div>
                                                @if ($errors->has('rating'))
                                                    <center><span class="help-block">
                                                  <strong>{{ $errors->first('rating') }}</strong>
                                                    </span></center>
                                                @endif
                                            </div>
                                        </div>
                                        <div id="hidden_form" class="hidden_form">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="projectinput9">Write Your Review</label>
                                                <div class="col-md-9" style=" position:relative;">
                                                    <textarea id="projectinput9" rows="5" class="form-control" name="comment" placeholder="Write Your Review" onchange="copyclip()" >{{old('comment')}}</textarea>
                                                    <i style="position: absolute; bottom: 0px; right: 21px;top: 5px;" class="ft-copy"  onclick="copyclip()"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput5">Name</label>
                                            <div class="col-md-9">
                                                <input type="text" id="projectinput5" class="form-control" placeholder=" Name" name="name" value="{{old('name')}}">
                                                @if ($errors->has('name'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('name') }}</strong>
                                                  </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput3">E-mail</label>
                                            <div class="col-md-9">
                                                <input type="text" id="projectinput3" class="form-control" placeholder="E-mail" name="email" value="{{old('email')}}">
                                                @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="projectinput4">Contact</label>
                                            <div class="col-md-9">
                                                <input type="text" id="projectinput4" class="form-control" placeholder="Phone" name="contact" value="{{old('contact')}}">
                                                @if ($errors->has('contact'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                              <center>
                                            <button type="submit" class="btn btn-primary" style="float: right;    margin: 22px 204px 0 0;">
                                                <i class="fa fa-check-square-o"></i> Review Submit
                                            </button></center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12"><hr style="border-bottom: 2px solid #eff0f3;"></div>
                        @foreach($rating as $rate)
                        <div class="col-md-12">
                            <div class="col-md-2"><img src="{{url('assets')}}/fb1.png" width="100%" ></div>
                            <div class="col-md-4"> <h6 style="color:red;    margin-top: 11px;">By {{ucfirst($rate->name)}}, on {{date('d/m/Y', strtotime($rate->created))}}</h6>
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
                        <div class="col-md-12"><div class="col-md-12">
                        <p> <p>{{$rate->comment}}</p></p><hr style="    border-bottom: thin solid rgba(6, 6, 6, 0.1);">
                        </div></div>
                        @endforeach
                      </div>
                    <div class="row">
                           
                            
                       </div>
                   </div></div>
            </div>
          </div>
        </div>
       </div>
  </section>
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
    //alert("Copied the text: " + copyText.value);
  }
  // $('#star-1').click(function(){
  //     $('#hidden_form').hide();
  // })
  //  $('#star-2').click(function(){
  //     $('#hidden_form').hide();
  // })
  //   $('#star-3').click(function(){
  //     $('#hidden_form').hide();
  // })
  //    $('#star-4').click(function(){
  //     $('#hidden_form').show();
  // })
  //     $('#star-5').click(function(){
  //     $('#hidden_form').show();
  // })
</script>
</body>
</html>