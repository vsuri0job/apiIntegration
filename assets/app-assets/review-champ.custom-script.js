toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };

  $(document).on('click', '.rc-social-in-progress', function(){

    toastr["error"]("This is in progress, Please try again later.", "Info");

  });

  /*$(document).on('click', '.btn-outline-facebook', function(){

    toastr["success"]("Facebook reviews/ratings sync successfully.", "Success");

  });*/

  function show_tostr( tostr_class ){
    toastr["warning"]("User cancelled login or did not fully authorize.", "Info!");
  }


window.fbAsyncInit = function() {
      // FB JavaScript SDK configuration and setup
      FB.init({
        appId      : '1532735036966653', // FB App ID
        cookie     : true,  // enable cookies to allow the server to access the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v3.0' // use graph api version 2.8
      });
      
      // Check whether the user already logged in
      FB.getLoginStatus(function(response) {
          if (response.status === 'connected') {
              //display user data
              
              //getFbUserData(); 
              document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
              document.getElementById('fbLink').innerHTML = '<i class="fa fa-plus"></i> Logout & Reconnect FaceBook &nbsp; <i class="fa fa-refresh spinner rc-spinner" style="display: none;"></i>';
          }
      });
  };

  // Load the JavaScript SDK asynchronously
  (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Facebook login with JavaScript SDK
  function fbLogin() {

      $('.rc-spinner').show(500);

      FB.login(function (response) {
          if (response.authResponse) {
              // Get and display the user profile data
              getFbUserData();
          } else {

              $('.rc-spinner').hide(500);

              show_tostr('warning');
              //document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
          }
      }, {scope: 'email, manage_pages, publish_pages, pages_show_list'});
  }

  // Fetch the user profile data from facebook
  function getFbUserData(){
      FB.api('/me', {locale: 'en_US', fields: 'accounts, id,first_name,last_name,email,link,gender,locale,picture'},
      function (response) {

      	var rcSocial_pages_html = '';
		
		console.log (response);

  	  	if (typeof response.error !== 'undefined') {
		    // the array is defined and has at least one element
            rcSocial_pages_html = rcSocial_pages_html + '<div class="alert alert-danger border-0 mt-1 mb-1" role="alert">';
            rcSocial_pages_html = rcSocial_pages_html + '<strong>Error!</strong> '+response.error.message+'.</div>';

            document.getElementById('rcSocial_pages').innerHTML = rcSocial_pages_html;
		    } 
		    else if (typeof response.accounts == 'undefined') {
        // the array is defined and has at least one element
            rcSocial_pages_html = rcSocial_pages_html + '<div class="alert alert-danger border-0 mt-1 mb-1" role="alert">';
            rcSocial_pages_html = rcSocial_pages_html + '<strong>Error!</strong> No pages under your facebook account.</div>';

            document.getElementById('rcSocial_pages').innerHTML = rcSocial_pages_html;
        } 
        else 
    		{
    	      rcSocial_pages_html = '';

            var accounts = response.accounts.data;
            //var accounts = response;
            
            var page_count = 0;

            /* SYNC PAGES TO DATABASE */
            jQuery.ajax({
              
              type : "post",
              dataType : "json",
              url : 'http://reviewchamp.net/login/manage_site/create_social_page',
              statusCode: {
                    
                500: function() {
                    alert(" 500 data still loading");
                    console.log('500 ');
                }
              },
               
              data : {_token: CSRF_TOKEN, _data : accounts},
               
              //if using the form then use this
              //data : serializedData,

              error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
              },
              success: function(response) {

                alert(response.name);  
              },
            }); 
            /* /SYNC PAGES TO DATABASE */

            accounts.forEach(function(item, index){

              console.log(item);

              if (page_count == 0)
              {
              	var _in = 'in';
              	var _status = 'true';
              }
              else
              {
              	var _in = '';
              	var _status = 'false'; 
              }

              rcSocial_pages_html = rcSocial_pages_html + '<div class="p-0-30">';
              rcSocial_pages_html = rcSocial_pages_html + '<div id="heading23-'+index+'" class="card-header">';
    	        rcSocial_pages_html = rcSocial_pages_html +    '<a data-toggle="collapse" href="#accordion23-'+index+'" aria-expanded="'+_status+'" aria-controls="accordion23-'+index+'" class="card-title lead collapsed"><i class="fa fa-facebook-square white font-medium-5"></i>&nbsp;&nbsp;'+item.name+'</a>';
    	        rcSocial_pages_html = rcSocial_pages_html +    '<a  item-id ="'+item.id+'" access-token = "'+item.access_token+'" class="btn btn-social btn-outline-facebook btn-xs pull-right get_fb_reviews"><span class="fa fa-facebook"></span> Fetch the page reviews/ratings</a></div>';
    	        rcSocial_pages_html = rcSocial_pages_html +  '<div id="accordion23-'+index+'" role="tabpanel" aria-labelledby="heading23-'+index+'" class="collapse '+item.id+' '+_in+'" aria-expanded="'+_status+'">';
    	        rcSocial_pages_html = rcSocial_pages_html +    '<div class="card-content">'
    	        rcSocial_pages_html = rcSocial_pages_html +      '<div class="card-body p-0-25 reviews-cards-container" id="'+item.id+'">';
    	        rcSocial_pages_html = rcSocial_pages_html +       '<div class="alert alert-warning border-0 mt-1 mb-1" role="alert">';
    	        rcSocial_pages_html = rcSocial_pages_html +          '<strong>No Reviews!</strong> There no reviews fetched for this page.';
            
              rcSocial_pages_html = rcSocial_pages_html +        '</div></div></div></div></div>';

              page_count++;

            });

            document.getElementById('rcSocial_pages').innerHTML = rcSocial_pages_html;
    		}
      
        document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
        document.getElementById('fbLink').innerHTML = '<i class="fa fa-plus"></i> Logout from FaceBook &nbsp; <i class="fa fa-refresh spinner rc-spinner" style="display: none;"></i>';
            
        $('.rc-spinner').hide(500);

      });
  	}


  	$(document).on('click', '.get_fb_reviews', function(event){

  		event.preventDefault();

  		var item_id = $(this).attr('item-id');
  		var access_token = $(this).attr('access-token');

  		console.log(access_token);

  		//FB.api('/me?access_token=EAACEdEose0cBAE7SN6LFV05zZBuyXKkGbHrJO3lwC1tu1YXOHKobZAWLu73NFfKsFLP6FJb6izGuIN5UZBZBRt36Hi15EZCoszkZA9VMeZCV8ivqz40Nsj5JtBtxxTZAjHiOMT8ZBLmFsElTet28pmlzaM4XvFxZBDKtjyGahuUWHP8aCHsyCelFmFGhjf3mycUsQs1ZChZCczqPWQZDZD', {locale: 'en_US', fields: 'ratings'},
  		
  		FB.api('/me?access_token='+access_token, {locale: 'en_US', fields: 'ratings'},

      	function (response) {

          	//console.log(response);

          	rcSocial_reviews_html = '';

          	if (typeof response.error !== 'undefined') {
			    // the array is defined and has at least one element
	            rcSocial_reviews_html = rcSocial_reviews_html + '<div class="alert alert-danger border-0 mt-1 mb-1" role="alert">';
	            rcSocial_reviews_html = rcSocial_reviews_html + '<strong>Error!</strong> '+response.error.message+'.</div>';

	            document.getElementById( item_id ).innerHTML = rcSocial_reviews_html;
	            $("." +item_id ).addClass('in');
			} 
			else
			{
				rcSocial_reviews_html = '';
				var star_rating = '';
	          	var ratings = response.ratings.data;
	          	ratings.forEach(function(item, index){

	            	console.log(item);

	            	star_rating = '';
	            	for (var star = 1; star <= item.rating; star++) {
	            		star_rating = star_rating+'*';
	            	}

	            	  rcSocial_reviews_html = rcSocial_reviews_html + '<div class="media align-items-stretch reviews-cards mt-1">';
	                rcSocial_reviews_html = rcSocial_reviews_html +   '<div class="bg-warning p-2 media-middle pull-left col-sm-1">';
	                rcSocial_reviews_html = rcSocial_reviews_html +       '<i class="icon-speech font-large-1 white"></i></div>';
	                rcSocial_reviews_html = rcSocial_reviews_html +   '<div class="media-body pull-left col-sm-10">';
	                rcSocial_reviews_html = rcSocial_reviews_html +     '<h4 class="reviewer">Reviewer: '+item.reviewer.name+'</h4>';
	                rcSocial_reviews_html = rcSocial_reviews_html +     '<p>'+item.review_text+'</p></div>';
	                rcSocial_reviews_html = rcSocial_reviews_html + '<div class="media-right p-1 media-middle pull-right col-sm-1"><h4 class="social-rating danger">'+star_rating+'</h4>';
	                rcSocial_reviews_html = rcSocial_reviews_html + '</div></div>';

	            	document.getElementById( item_id ).innerHTML = rcSocial_reviews_html;

	            	$("." +item_id ).addClass('in');
	          	});
	      
	         	$('.rc-spinner').hide(500);
         	}
      	});

  	});
  	
  	// Logout from facebook
  	function fbLogout() {
    
    $('.rc-spinner').show(500);

      	FB.logout(function() {
          document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
          document.getElementById('fbLink').innerHTML = '<i class="fa fa-plus"></i> Connect to FaceBook &nbsp; <i class="fa fa-refresh spinner rc-spinner" style="display: none;"></i>';
          
          //document.getElementById('userData').innerHTML = '';
          //document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
      
          $('.rc-spinner').hide(500);
      	});
  	}


jQuery(document).ready( function() {

  jQuery(".call_to_ajax").click( function(event) {

    event.preventDefault();

      post_id = 20;

        //if using the form the serialize the form data
        //var serializedData = jQuery("#bt_create_tx_escrow").serialize();

        jQuery.ajax({
          
          type : "post",
          dataType : "json",
          url : 'http://reviewchamp.net/login/manage_site/create_social_page',
          statusCode: {
                
            500: function() {
                alert(" 500 data still loading");
                console.log('500 ');
            }
          },
           
          data : {_token: CSRF_TOKEN},
           
          //if using the form then use this
          //data : serializedData,

          error: function(xhr, status, error) {
              var err = eval("(" + xhr.responseText + ")");
              alert(err.Message);
          },
          success: function(response) {

            alert(response.name);  
          },
        }); 

     });

  });



/* ##### YELP API ##### */
  
  $(document).on('click', '.get_yelp_reviews', function(event){

    var item_id = $(this).attr('item-id');

    if (item_id == '') {
      
      toastr["warning"]("Invalid business ID.", "Error");
      return false;
    }

    jQuery.ajax({
          
      type : "post",
      dataType : "json",
      url : BASE_URL+'/yelp-fusion-api',
      statusCode: {
            
        500: function() {
            alert(" 500 data still loading");
            console.log('500 ');
        }
      },
       
      data : {_token: CSRF_TOKEN, yelp_business_id: item_id, yelp_api: 'reviews', action: 'any', DB_ID: 0 },
       
      //if using the form then use this
      //data : serializedData,

      error: function(xhr, status, error) {
          
          console.log(error);
      },
      success: function(response) {
        
        if ( response.res_status == 'success')
        {
          toastr["success"]( response.res_message, "Success");
          $('#'+item_id).html(response.res_yelp_reviews);
          console.log(response.res_yelp_reviews);
        }
        else
        {
          toastr["warning"]( response.res_message, "Error");
        }
      },

    });

  });

  
  $(document).on('click', '#yelp_add_business_btn', function(event){

    event.preventDefault();

    var yelp_business_id = jQuery("#yelp_add_business_form #yelp_business_id").val();
    var action = jQuery("#yelp_add_business_form #action").val();
    var DB_ID = jQuery("#yelp_add_business_form #DB_ID").val();
    
    if (yelp_business_id == '') {
      $('.yelp-alert').show();
      $('.yelp-alert').removeClass('alert-success alert-info alert-warning');
      $('.yelp-alert').addClass('alert-warning');
      $('.yelp-alert .yelp-message-type').html('Error!');
      $('.yelp-alert .yelp-message').html('Please enter the business ID');
      return false;
    } else {
      $('.yelp-alert').hide();
    }

    jQuery.ajax({
          
      type : "post",
      dataType : "json",
      url : BASE_URL+'/yelp-fusion-api',
      statusCode: {
            
        500: function() {
            alert(" 500 data still loading");
            console.log('500 ');
        }
      },
       
      data : {_token: CSRF_TOKEN, yelp_business_id: yelp_business_id, yelp_api: 'businesses', action: action, DB_ID: DB_ID },
       
      //if using the form then use this
      //data : serializedData,

      error: function(xhr, status, error) {
          
          console.log(error);
      },
      success: function(response) {

        console.log(response);

        $('.yelp-alert').show();
        $('.yelp-alert').removeClass('alert-success alert-info alert-warning');
        $('.yelp-alert').addClass('alert-warning');
        $('.yelp-alert .yelp-message-type').html('Error!');
        $('.yelp-alert .yelp-message').html(response.res_message);
        
        if ( response.res_status == 'success')
        {
          $('.yelp-alert').addClass('alert-success');
          $('.yelp-alert .yelp-message-type').html('Success!');
          $('.yelp-alert .yelp-message').html(response.res_message);
          $("#rcSocial_pages_yelp").html(response.res_yelp_businesses);

          $('#yelp_add_business_modal').modal('hide');

          $('.yelp-add-edit-btn').html('<i class="fa fa-edit"></i><img src="/login/assets/app-assets/images/yelp-business-logo.png" style="width: 50px;margin-top: -5px;"> Edit business')

          //console.log(response.res_data);
        }
      },

    }); 
  
  });

/* ##### /YELP API ##### */
  
$(document).on('click', '.facebook_add_page_form_btn', function(event){

  event.preventDefault();

    post_id = 20;

    //if using the form the serialize the form data
    var form_action = jQuery("#facebook_add_page_form").attr('action');
    var serializedData = jQuery("#facebook_add_page_form").serialize();

    jQuery.ajax({
       type : "post",
       dataType : "json",
       url : form_action,
       statusCode: {
            500: function() {
                alert(" 500 data still loading");
                console.log('500 ');
            }
        },
       
       //data : {action: "my_function", post_id : post_id},
       
       //if using the form then use this
       data : serializedData,

       error: function(xhr, status, error) {
          console.log(xhr);
          console.log(status);
          console.log(error);
      },
       success: function(response) {

          console.log(response.res_message);
          
          if ( response.res_validation_error == 1 ) {
            $.each(response.res_message, function( index, value ) {
              //alert( index + ": " + value );
              toastr["warning"]( value, "Error");
            });

            return false;
          }

          if ( response.res_status == 'error' ) {
            toastr["error"]( response.res_message, "error");
          }

          if ( response.res_status == 'success' ) {
            jQuery("#facebook_add_page_modal").modal('hide');
            toastr["success"]( response.res_message, "success");

            setTimeout(function(){ window.location.reload(); }, 2000);
          }
      },
    }); 
});


$(document).on('click', '.get_google_reviews', function( event ){
    jQuery.ajax({
      
      type : "get",
      dataType : "json",
      url : 'http://reviewchamp.net/login/manage/update-google-reviews',
      statusCode: {            
        500: function() {
            alert(" 500 data still loading");
            console.log('500 ');
        }
      },
       
      data : {_token: CSRF_TOKEN},
       
      //if using the form then use this
      //data : serializedData,

      error: function(xhr, status, error) {
          var err = eval("(" + xhr.responseText + ")");
          alert(err.Message);
      },
      success: function(response) {
        alert(response.msg);  
      },
    }); 
  event.preventDefault();
});