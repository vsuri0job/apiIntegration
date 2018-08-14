@extends('layouts.main')
@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
  	<div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
          <h3 class="content-header-title">Dashboard</h3>
          @if($yelptotal===0 && $status)
               <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $status; ?>!123</strong>
              </div>
          @endif

        </div>
        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Dashboard</a> </li>
            </ol>
          </div>
        </div>
    </div>
    @if(Auth::user()->role=='admin')
    <div class="content-body">
    	<div class="row">
      		<div class="col-xs-12">
        		<div class="card">
          			<div class="card-body collapse in">
            			<div class="card-block card-dashboard"></div>
          			</div>
        		</div>
      		</div>
      	</div>
    </div>
    @else
    <div class="content-body">
    <div class="row">
      <div class="col-xs-12">
        <section id="stats-icon-subtitle-bg">
          <div class="row"> 

            @foreach($socials as $name)

            @php
            //echo "<pre>"; print_r($name->id); echo "</pre>";
            @endphp

            <div class="col-md-4">
              <div class="card">
                <div class="card-body">

                  <div class="media">
                    
                    <div style="background-color:@if($name->names == 'Facebook')#3b5998!important; 
                      @elseif($name->name=='Google')#d24a39!important;
                        @elseif($name->name=='Yelp')#ad1d1d!important; @endif" class="sreviews p-2 text-xs-center bg-primary media-left media-middle"> @if($name->name=='Facebook') <i class="icon-social-facebook font-large-2 white"></i> @elseif($name->name=='Google') <i class="fa fa-google-plus font-large-2 white"></i> @elseif($name->name=='Yelp') <i class="fa fa-yelp font-large-2 white"></i> @endif 
                    </div>
                    
                    <div class="p-2 media-body">
                      <h5 class="primary" style="color: #3b5998!important;">{{$name->name}}</h5>
                        @if($name->name=="Yelp")
                        {{ $yelptotal }}
                        <!-- {{App\Rating::where('review_type', $name->id)->where('customer_id', $user_id)->count('rating')}} -->
                        @else
                        {{App\Rating::where('review_type', $name->id)->where('customer_id', $user_id)->count('rating')}}
                        @endif
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            @endforeach 
        </div>

        </section>
        <div class="card">
          <div class="card-body collapse in">
            <div class="card-block card-dashboard">
              <section id="stats-icon-subtitle-bg">
                <div class="row">
                  <div class="col-md-12">
                    <h4>Latest Review</h4>
                  </div>
                  @foreach($rating as $rate)
                  <div class="col-md-12">
                    <hr>
                  </div>
                  <div class="col-md-12" style="margin-bottom: 2%"> <img src="{{url('assets')}}/{{$rate->rating}}star.png" width="12%"> </div>
                  <div class="col-md-10" style="margin-top 20px;">
                    <p class="item">{{$rate->comment}} </p>                    
                    <h6 style="color:red;">By {{ucfirst($rate->name)}}, on {{date('m/d/Y', strtotime($rate->created))}}</h6>
                  </div>
                  <div class="col-md-2 tar lreview"> <img src="{{url('assets')}}/{{$rate->social->name}}.png" width="55%"> </div>
                  @endforeach </div>
              </section>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    @endif </div>
</div>
@endsection

@section('script') 
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



</script> 
@endsection 
