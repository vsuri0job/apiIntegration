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
</style>
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar">
  <div class=" container content-body"><!-- Basic form layout section start -->
    <section id="horizontal-form-layouts">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="col-xl-12 col-lg-12">
              <div class="card" style="">
                <div class="card-header">
                  <h4 class="card-title">Widgets</h4>
                </div>
                <div class="card-body">
                  <div class="card-block">
                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="baseIcon-tab11" data-toggle="tab" aria-controls="tabIcon11" href="#tabIcon11" aria-expanded="true"><i class="fa fa-play"></i> Company Reviews</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="baseIcon-tab12" data-toggle="tab" aria-controls="tabIcon12" href="#tabIcon12" aria-expanded="false"><i class="fa fa-flag"></i> Company Reviews</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="baseIcon-tab13" data-toggle="tab" aria-controls="tabIcon13" href="#tabIcon13" aria-expanded="false"><i class="fa fa-cog"></i> Company Reviews</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled"><i class="fa fa-unlink"></i> Company Reviews</a>
                      </li>
                    </ul>
                    
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tabIcon11" aria-expanded="true" aria-labelledby="baseIcon-tab11">
                        <div class="card">
                          <div class="col-md-12" style="margin-top: 30px" >
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <center><img src="{{url('assets')}}/fb.png" width="70px"></center>
                            </div>
                            <div class="col-md-2">
                              <center><img src="{{url('assets')}}/tw.png" width="50px"></center>
                            </div>
                            <div class="col-md-2">
                              <center> <img src="{{url('assets')}}/gm.png" width="50px"></center>
                            </div>
                            <div class="col-md-3"></div>
                          </div>
                          <div class="col-md-12" style="margin-top: 30px">
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                              <input type="text" name="" value="290 Reviews" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                              <input type="text" name="" value="39 Reviews"  class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                              <input type="text" name="" value="60 Reviews"  class="form-control" readonly>
                            </div>
                            <div class="col-md-3"></div>
                          </div>
                          <div class="col-md-2"></div>
                          <div class="col-md-8">
                          <div class="card-body collapse in" style="margin-top: 30px">
                            <div class="card-block">
                              <div class="card-text">
                                <p>  </p></div>
                               
                                <input type="hidden" name="customer_id" value="">
                                <input type="hidden" name="slug" value="">

                                  <div class="form-body">
                                    <div class="form-group row">
                                      <div class="starrating-wrap">
                                        <h1 style=" font-size: 63px;font-style: normal; color: brown;">Sorry......</h1>
                                        <p style=" font-size: 29px;">There is no any Record.</p>
                                      </div>
                                      
                                    </div>
                                 
                                        


                                      
                              
                         
                           
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<script src="{{url('assets')}}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<script src="{{url('assets')}}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{url('assets')}}/app-assets/js/core/app.js" type="text/javascript"></script>

</body>
</html>