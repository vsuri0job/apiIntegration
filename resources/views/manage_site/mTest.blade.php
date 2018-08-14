<?php 
use App\Socialmedia;
use App\Rating;

$user_id=Auth::user()->id;

// {{url('assets')}}/app-assets/img/any-img.png

?>

@extends('layouts.main')
@section('content')


<style type="text/css">
  footer.footer { margin-left: 0px !important; }
</style>


<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Manage Social Pages</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Manage Social Pages</a></li>
          </ol>
        </div>
      </div>
    </div>

    <div class="content-body"><!-- Zero configuration table -->

      <section id="configuration">
        <div class="row">
          <div class="col-xs-12">
            
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
              <strong>{{$errors->first()}}</strong>
            </div>
            @endif
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{Session::get('success')}}
            </div>
            @endif

          </div>
        </div>
      </section>

      <!-- Facebook -->
      <div id="accordionWrap-fb" role="tablist" aria-multiselectable="true">
        <div class="card-header bg-fb p-1">
          
          <h3 class="card-title social-title pull-left mt-0">Connected FaceBook pages</h3>
          
          	<?php if(count($social_fb) == 0) { ?>

	          <a data-toggle="modal" data-target="#facebook_add_page_modal" style="background: #fff;color: #2f7ac2;" class="btn btn-social btn-outline-facebook btn-xs pull-right"><span class="fa fa-facebook"></span> Add Page Manually</a> &nbsp; 
	          <a style="background: #fff;color: #2f7ac2;font-size: 10px;padding: 3px 3px;margin: 3px 5px 0 5px;" class="btn btn-outline-facebook btn-xs pull-right"> OR</a> &nbsp; 

		      <a style="background: #fff;color: #2f7ac2;" onclick="fbLogin()" id="fbLink" class="btn btn-social btn-outline-facebook btn-xs pull-right"><span class="fa fa-facebook"></span> Connect to FaceBook</a> &nbsp; 

          	<?php } else { ?>

	          <a data-toggle="modal" data-target="#facebook_add_page_modal" style="background: #fff;color: #2f7ac2;" class="btn btn-social btn-outline-facebook btn-xs pull-right"><span class="fa fa-facebook"></span> Edit Page Manually</a> &nbsp;

          	<?php } ?>
        
        </div>

        <div class="card collapse-icon accordion-icon-rotate left rc-social-reviews" id="rcSocial_pages">

          @php $i=1 @endphp
          @php $page_count=0 @endphp
          


          @foreach($social_fb as $soc)

            <!--  -->
            <?php if ($page_count == 0)
              {
                $_in = 'in';
                $_status = 'true';
              }
              else
              {
                $_in = '';
                $_status = 'false'; 
              } 

            ?>

              <div class='p-0-30'>
                
                <div id="heading23-{{ $page_count }}" class="card-header">
                  
                  <a data-toggle="collapse" href="#accordion23-{{ $page_count }}" aria-expanded="{{ $_status }}" aria-controls="accordion23-{{ $page_count }}" class="card-title lead collapsed">
                    <i class="fa fa-facebook-square white font-medium-5"></i>&nbsp;&nbsp;{{$soc->pagename}}
                  </a>
                  
                  <a  item-id ="{{ $soc->page_id }}" access-token = "{{ $soc->access_token }}" class="btn btn-social btn-outline-facebook btn-xs pull-right get_fb_reviews"><span class="fa fa-facebook"></span> Fetch the page reviews/ratings
                  </a>
                </div>
                    
                <div id="accordion23-{{ $page_count }}" role="tabpanel" aria-labelledby="heading23-{{ $page_count }}" class="collapse {{ $soc->page_id }} {{ $_in }}" aria-expanded="{{ $_status }}">
                  <div class="card-content">

                    <div class="card-body p-0-25 reviews-cards-container" id="{{ $soc->page_id }}">
                      <div class="alert alert-warning border-0 mt-1 mb-1" role="alert">
                        <strong>No Reviews!</strong> There no reviews fetched for this page.
                      </div>
                    </div>

                  </div>
                </div>

              </div>

              <?php $page_count++; ?>
            <!--  -->
          @php $i++ @endphp 
          @endforeach

      </div>
    </div>
    <!-- /Facebook -->


    <!-- Google -->
    <div id="accordionWrap-google" role="tablist" aria-multiselectable="true">

        <div class="card-header bg-google p-1">
          <h3 class="card-title social-title pull-left mt-0-5">Connected Google pages <a class="google-api" api='asd'>API</a> </h3>

          <?php if(count($social_google) == 0) { ?>

	          <button data-toggle="modal" data-target="#google_add_page_modal" type="button" class="btn btn-min-width ml-1 pull-right" style="color:#ff6275; background: #fff"> 
	            <i class="fa fa-plus"></i> Add My Business Listing Manually
	          </button>

	          <button id="authorize-button" type="button" class="btn btn-min-width ml-1 pull-right" style="color:#ff6275; background: #fff"> 
	            <i class="fa fa-plus"></i> Connect to Google+
	          </button>

	          <button id="accounts-button" style="display: none;" type="button" class="btn btn-min-width ml-1 pull-right" style="color:#ff6275; background: #fff;"><i class="fa fa-plus"></i> Get My Businesses
	          </button>

          <?php } else { ?>

            <button onclick="signOutGoogle()" id="signout-button" type="button" class="btn btn-min-width ml-1 pull-right" style="color:#ff6275; background: #fff;"><i class="fa fa-plus"></i> Logout from Google+
            </button>

	          <button data-toggle="modal" data-target="#google_add_page_modal" type="button" class="btn btn-min-width ml-1 pull-right" style="color:#ff6275; background: #fff"> 
	            <i class="fa fa-edit"></i> Edit My Business Listing Manually
	          </button>

          <?php } ?>


          <button id="admins-button" style="display:none;"> Get Admins </button>
          <button id="locations-button" style="display:none;"> Get Locations </button>

        </div>

        <div class="card collapse-icon accordion-icon-rotate left rc-social-reviews" id="rcSocial_pages_google">

          <div id="dynamic-content"> </div>

          @php $i=1 @endphp
          @php $page_count=0 @endphp
          @foreach($social_google as $soc)

            <!--  -->
            <?php if ($page_count == 0)
              {
                $_in = 'in';
                $_status = 'true';
              }
              else
              {
                $_in = '';
                $_status = 'false'; 
              } 

            ?>
            <div class='p-0-30'>
              <div id="heading_google_{{ $page_count }}" class="card-header">
                
                <a data-toggle="collapse" href="#accordion_google_{{ $page_count }}" aria-expanded="{{ $_status }}" aria-controls="accordion_google_{{ $page_count }}" class="card-title lead collapsed">
                  <i class="fa fa-google white font-medium-5"></i>&nbsp;&nbsp;{{$soc->pagename}}
                </a>
                
                <a  item-id ="{{ $soc->page_id }}" access-token = "{{ $soc->access_token }}" class="btn btn-social btn-outline-facebook btn-xs pull-right get_fb_reviews"><span class="fa fa-google"></span> Fetch the page reviews/ratings
                </a>

              </div>
                  
              <div id="accordion_google_{{ $page_count }}" role="tabpanel" aria-labelledby="heading_google_{{ $page_count }}" class="collapse {{ $soc->page_id }} {{ $_in }}" aria-expanded="{{ $_status }}">
                <div class="card-content">
                  <div class="card-body p-0-25 reviews-cards-container" id="{{ $soc->page_id }}">
                    <div class="alert alert-warning border-0 mt-1 mb-1" role="alert">
                      <strong>No Reviews!</strong> There no reviews fetched for this page.
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <?php $page_count++; ?>
            <!--  -->
          @php $i++ @endphp 
          @endforeach

        </div>
    </div>
    <!-- /Google -->

    
    <!-- yelp -->
    <div id="accordionWrap-yelp" role="tablist" aria-multiselectable="true">

        <div class="card-header bg-yelp p-1">
          <h3 class="card-title social-title pull-left mt-0-5">Connected Yelp businesses</h3>
          
          <?php if(count($social_yelp) == 0) { ?>

            <button data-toggle="modal" data-target="#yelp_add_business_modal" type="button" class="yelp-add-edit-btn btn btn-min-width ml-1 pull-right" style="color:rgba(24, 24, 24, 1); background: #ffffff"> 
              <i class="fa fa-plus"></i> <img src="{{ url('assets/app-assets/images') }}/yelp-business-logo.png" style="width: 50px;margin-top: -5px;"> Connect business
            </button>

          <?php } else { ?>

            <button data-toggle="modal" data-target="#yelp_add_business_modal" type="button" class="yelp-add-edit-btn btn btn-min-width ml-1 pull-right" style="color:rgba(24, 24, 24, 1); background: #ffffff"> 
              <i class="fa fa-edit"></i> <img src="{{ url('assets/app-assets/images') }}/yelp-business-logo.png" style="width: 50px;margin-top: -5px;"> Edit business
            </button>

          <?php } ?>

        </div>

        <div class="card collapse-icon accordion-icon-rotate left rc-social-reviews" id="rcSocial_pages_yelp">

          @php $i=1 @endphp
          @php $page_count=0 @endphp
          @foreach($social_yelp as $soc)

            <!--  -->
            <?php if ($page_count == 0)
              {
                $_in = 'in';
                $_status = 'true';
              }
              else
              {
                $_in = '';
                $_status = 'false'; 
              } 

            ?>
            <div class='p-0-30'>
              <div id="heading_yelp_{{ $page_count }}" class="card-header">
                
                <a data-toggle="collapse" href="#accordion_yelp_{{ $page_count }}" aria-expanded="{{ $_status }}" aria-controls="accordion_yelp_{{ $page_count }}" class="card-title lead collapsed">
                  <i class="fa fa-home white font-medium-5"></i>&nbsp;&nbsp;{{$soc->pagename}}
                </a>
                
                <!-- <button type="button" class="btn btn-icon btn-danger delete-social-page"><i class="fa fa-trash"></i></button> -->

                <a  item-id ="{{ $soc->page_id }}" class="btn btn-social btn-xs pull-right get_yelp_reviews"><span class="fa fa-home"></span>Fetch the business reviews/ratings
                </a>
              </div>
                  
              <div id="accordion_yelp_{{ $page_count }}" role="tabpanel" aria-labelledby="heading_yelp_{{ $page_count }}" class="collapse {{ $soc->page_id }} {{ $_in }}" aria-expanded="{{ $_status }}">
                <div class="card-content">
                  <div class="card-body p-0-25 reviews-cards-container" id="{{ $soc->page_id }}">

                    <?php 
                    $Socialmedia_id=Socialmedia::where('name', 'Yelp')->value('id');
                    $ratings = Rating::where('customer_id', $user_id)->where('review_type', $Socialmedia_id)->where('yelp_business_id', $soc->page_id)->orderBy('id','DESC')->get();

                    //dd($ratings);

                    if (  count($ratings) > 0 ) {
                      # code...

                      foreach ($ratings as $rating) {

                        echo '<div class="media align-items-stretch reviews-cards mt-1">
                            <div class="bg-warning p-2 media-middle pull-left col-sm-1">
                                <i class="icon-speech font-large-1 white"></i>
                            </div>
                            
                            <div class="media-body pull-left col-sm-10">
                                <h4 class="reviewer">Reviewer: '.$rating->name.'</h4>
                                <p>'.$rating->comment.'</p>
                            </div>
                            <div class="media-right p-1 media-middle pull-right col-sm-1">
                              <h4 class="social-rating danger">'.$rating->rating.'*</h4>
                            </div>
                          </div>';
                      }

                    } else { ?>

                    <div class="alert alert-warning border-0 mt-1 mb-1" role="alert">
                      <strong>No Reviews!</strong> There no reviews fetched for this page.
                    </div>

                  <?php } ?>
                  
                  </div>
                </div>
              </div>
              </div>
              <?php $page_count++; ?>
            <!--  -->
          @php $i++ @endphp 
          @endforeach

        </div>
    </div>
    <!-- yelp -->


    <!-- home advisor -->
    <div id="accordionWrap-home-advisor" role="tablist" aria-multiselectable="true">

        <div class="card-header bg-home-advisor p-1">
          <h3 class="card-title social-title pull-left mt-0-5">Connected Home Advisor pages</h3>
          <button type="button" class="btn btn-min-width ml-1 rc-social-in-progress pull-right" style="color:#ff976a; background: #ffffff"> 
            <i class="fa fa-plus"></i> Connect to <img src="https://cdn1.homeadvisor.com/images/consumer/designmine/designmine-header-logo-updated.png" style="width: 124px;">
          </button>
        </div>

        <div class="card collapse-icon accordion-icon-rotate left rc-social-reviews" id="rcSocial_pages_google">

          @php $i=1 @endphp
          @php $page_count=0 @endphp
          @foreach($social_home_advisor as $soc)

            <!--  -->
            <?php if ($page_count == 0)
              {
                $_in = 'in';
                $_status = 'true';
              }
              else
              {
                $_in = '';
                $_status = 'false'; 
              } 

            ?>
            <div class='p-0-30'>
              <div id="heading_home_advisor_{{ $page_count }}" class="card-header">
                
                <a data-toggle="collapse" href="#accordion_home_advisor_{{ $page_count }}" aria-expanded="{{ $_status }}" aria-controls="accordion_home_advisor_{{ $page_count }}" class="card-title lead collapsed">
                  <i class="fa fa-home white font-medium-5"></i>&nbsp;&nbsp;{{$soc->pagename}}
                </a>
                
                <a  item-id ="{{ $soc->page_id }}" access-token = "{{ $soc->access_token }}" class="btn btn-social btn-outline-facebook btn-xs pull-right get_fb_reviews"><span class="fa fa-home"></span> Fetch the page reviews/ratings
                </a>
              </div>
                  
              <div id="accordion_home_advisor_{{ $page_count }}" role="tabpanel" aria-labelledby="heading_home_advisor_{{ $page_count }}" class="collapse {{ $soc->page_id }} {{ $_in }}" aria-expanded="{{ $_status }}">
                <div class="card-content">
                  <div class="card-body p-0-25 reviews-cards-container" id="{{ $soc->page_id }}">

                    <div class="alert alert-warning border-0 mt-1 mb-1" role="alert">
                      <strong>No Reviews!</strong> There no reviews fetched for this page.
                    </div>
                  
                  </div>
                </div>
              </div>
              </div>
              <?php $page_count++; ?>
            <!--  -->
          @php $i++ @endphp 
          @endforeach

        </div>

    </div>
    <!-- /home advisor -->


    <!-- YELP MODAL -->
    <div class="modal fade text-left" id="yelp_add_business_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h4 class="modal-title text-center" id="myModalLabel2"><i class="fa fa-road2"></i> Yelp Add/Edit Business</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">

            <h5><i class="fa fa-lightbulb-o"></i> Finding Your Yelp Business ID</h5>
            <p>You can find the Yelp Business ID in the URL for the listing. The ID appears after <url>www.yelp.com/biz/</url> in the address bar, and is generally composed of the name and location of the Practice separated by dashes. For example, the ID in the following URL is "<url>dentistry-for-kids-and-adults-canyon-country</url>":  <url>www.yelp.com/biz/dentistry-for-kids-and-adults-canyon-country</url></p>

            <hr>

            <h5><i class="fa fa-arrow-right"></i> Add Business</h5>
           
            <form id="yelp_add_business_form">
              <div class="modal-body">
                <label>Business ID: </label>
                <div class="form-group position-relative has-icon-left">

                <?php if(count($social_yelp) != 0) {

                  $yelp_business_id = $social_yelp[0]->page_id;
                  $action = 'edit';
                  $DB_ID = $social_yelp[0]->id;

                } else {

                  $yelp_business_id = '';
                  $action = 'add';
                  $DB_ID = '';

                } ?>

                  <input type="hidden" name="DB_ID" id="DB_ID" value="{{ $DB_ID }}">
                  <input type="hidden" name="action" id="action" value="{{ $action }}">
                  <input type="text" name="yelp_business_id" id="yelp_business_id" placeholder="Business ID" class="form-control" value="{{ $yelp_business_id }}">
                  
                  <div class="form-control-position">
                    <i class="fa fa-th-list font-medium-5 line-height-1 text-muted icon-align"></i>
                  </div>
                
                </div>
              </div>
            </form>

            <div class="yelp-alert alert alert-success display-none" role="alert">
              <span class="text-bold-600 yelp-message-type">Well done!</span> <span class="yelp-message">You successfully read this important alert message.</span>
            </div>
          
          </div>

          <div class="modal-footer">
            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-outline-primary" id="yelp_add_business_btn">Add Business</button>
          </div>

        </div>
      </div>
    </div>
    <!-- /YELP MODAL -->

    <!-- Facebook MODAL -->
    <div class="modal fade text-left" id="facebook_add_page_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h4 class="modal-title text-center" id="myModalLabel2"><i class="fa fa-road2"></i> Facebook Add/Edit Business</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">

            <h5><i class="fa fa-lightbulb-o"></i> Finding your facebook page details</h5>
            <p>You can find the Facebook page ID in the URL for the listing. The ID appears after <url>https://www.facebook.com/imsadvertising/</url> in the address bar. For example, the ID in the following URL is "<url>imsadvertising</url>":  <url>https://www.facebook.com/imsadvertising/</url></p>
            <p>To find the review url please check this link for <a href="https://www.facebook.com/help/548274415377576?helpref=faq_content">Facebook review page url</a></p>

            <hr>

            <h5><i class="fa fa-arrow-right"></i> Add/Edit Facebook Page</h5>
           
            <form id="facebook_add_page_form" action="{{ url('manage/add-facebook-page-manually') }}">
              
              {{ csrf_field() }}

              <div class="modal-body">


                <?php if(count($social_fb) != 0) {

                  $pagename = $social_fb[0]->pagename;
                  $socialurl = $social_fb[0]->socialurl;
                  $social_page_review_url = $social_fb[0]->social_page_review_url;
                  
                  $action = 'edit';
                  $DB_ID = $social_fb[0]->id;

                } else {

                  $pagename = '';
                  $socialurl = '';
                  $social_page_review_url = '';

                  $action = 'add';
                  $DB_ID = '';

                } ?>

                <label>Facebook Page Name: </label>
                <div class="form-group position-relative has-icon-left">
                  <input type="text" name="pagename" id="pagename" placeholder="perthplumber" class="form-control" value="{{ $pagename }}" required>
                  <div class="form-control-position">
                    <i class="fa fa-th-list font-medium-5 line-height-1 text-muted icon-align"></i>
                  </div>
                </div>

                <label>Facebook Page URL: </label>
                <div class="form-group position-relative has-icon-left">
                  <input type="text" name="socialurl" id="socialurl" placeholder="https://www.facebook.com/perthplumber/" class="form-control" value="{{ $socialurl }}" required>
                  <div class="form-control-position">
                    <i class="fa fa-th-list font-medium-5 line-height-1 text-muted icon-align"></i>
                  </div>
                </div>

                <label>Facebook page review URL: </label>
                <div class="form-group position-relative has-icon-left">
                  <input type="text" name="social_page_review_url" id="social_page_review_url" placeholder="https://www.facebook.com/perthplumber/reviews/" class="form-control" value="{{ $social_page_review_url }}" required>
                  <div class="form-control-position">
                    <i class="fa fa-th-list font-medium-5 line-height-1 text-muted icon-align"></i>
                  </div>
                </div>

              </div>


	          	<input type="hidden" name="DB_ID" value="{{ $DB_ID }}">
	          	<input type="hidden" name="action" value="{{ $action }}">

            </form>

            <!-- <div class="yelp-alert alert alert-success" role="alert">
              <span class="text-bold-600 yelp-message-type">Well done!</span> <span class="yelp-message">You successfully read this important alert message.</span>
            </div> -->
          
          </div>

          <div class="modal-footer">

            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-outline-primary facebook_add_page_form_btn" value="Submit Facebook Page">
          
          </div>

           </form>

        </div>
      </div>
    </div>
    <!-- /Facebook MODAL -->



    <!-- Google MODAL -->
    <div class="modal fade text-left" id="google_add_page_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h4 class="modal-title text-center" id="myModalLabel2"><i class="fa fa-road2"></i> Google Add/Edit Business</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">

            <!-- <h5><i class="fa fa-lightbulb-o"></i> Finding your Google page details</h5>
            <p>You can find the Facebook page ID in the URL for the listing. The ID appears after <url>https://www.facebook.com/imsadvertising/</url> in the address bar. For example, the ID in the following URL is "<url>imsadvertising</url>":  <url>https://www.facebook.com/imsadvertising/</url></p>
            <p>To find the review url please check this link for <a href="https://www.facebook.com/help/548274415377576?helpref=faq_content">Facebook review page url</a></p>

            <hr> -->

            <h5><i class="fa fa-arrow-right"></i> Add/Edit Google Business</h5>
           
            <form id="google_add_page_form" action="{{ url('manage/add-google-page-manually') }}">
              
              {{ csrf_field() }}

              <div class="modal-body">


                <?php if(count($social_google) != 0) {

                  $pagename = $social_google[0]->pagename;
                  $socialurl = $social_google[0]->socialurl;
                  $social_page_review_url = $social_google[0]->social_page_review_url;
                  
                  $action = 'edit';
                  $DB_ID = $social_google[0]->id;

                } else {

                  $pagename = '';
                  $socialurl = '';
                  $social_page_review_url = '';

                  $action = 'add';
                  $DB_ID = '';

                } ?>

                <label>Google Business Name: </label>
                <div class="form-group position-relative has-icon-left">
                  <input type="text" name="pagename" id="pagename" placeholder="perthplumber" class="form-control" value="{{ $pagename }}" required>
                  <div class="form-control-position">
                    <i class="fa fa-th-list font-medium-5 line-height-1 text-muted icon-align"></i>
                  </div>
                </div>

                <label>Google Business URL: </label>
                <div class="form-group position-relative has-icon-left">
                  <input type="text" name="socialurl" id="socialurl" placeholder="Google Business URL" class="form-control" value="{{ $socialurl }}" required>
                  <div class="form-control-position">
                    <i class="fa fa-th-list font-medium-5 line-height-1 text-muted icon-align"></i>
                  </div>
                </div>

                <label>Google Business review URL: </label>
                <div class="form-group position-relative has-icon-left">
                  <input type="text" name="social_page_review_url" id="social_page_review_url" placeholder="Google Business review URL" class="form-control" value="{{ $social_page_review_url }}" required>
                  <div class="form-control-position">
                    <i class="fa fa-th-list font-medium-5 line-height-1 text-muted icon-align"></i>
                  </div>
                </div>

              </div>


	          	<input type="hidden" name="DB_ID" value="{{ $DB_ID }}">
	          	<input type="hidden" name="action" value="{{ $action }}">
	          	
            </form>

            <!-- <div class="yelp-alert alert alert-success" role="alert">
              <span class="text-bold-600 yelp-message-type">Well done!</span> <span class="yelp-message">You successfully read this important alert message.</span>
            </div> -->
          
          </div>

          <div class="modal-footer">

            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-outline-primary google_add_page_form_btn" value="Submit Google Page">
          
          </div>

           </form>

        </div>
      </div>
    </div>
    <!-- /Google MODAL -->

  </div>
</div>

@endsection 