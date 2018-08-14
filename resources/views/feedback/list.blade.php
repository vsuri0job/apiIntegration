@extends('layouts.main')

@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Request Feedback</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a> </li>
            <li class="breadcrumb-item"><a href="#">Request Feedback</a> </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-body"><!-- Zero configuration table -->
      
      <section id="configuration">
        <div class="row">
          <div class="col-xs-12">
              @if(session()->has('message'))
                <div class="alert alert-info alert-dismissible"> {{ session()->get('message') }} </div>
              @endif
              <div class="col-xs-12">
                <form class="form-inline" method="get" action="">
                  <label class="sr-only" for="date-range-from">Date Range From</label>
                      <input  type="text" name="date_start" class="form-control mb-2 mr-sm-2" 
                              id="date-range-from" placeholder="Starting Date">
                  <label class="sr-only" for="date-range-end">Date Range From</label>
                      <input type="text" name="date_end" class="form-control mb-2 mr-sm-2" 
                              id="date-range-end" placeholder="End Date">                  
                  <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="reviews">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Rating</th>                      
                      <th>Feedback</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach( $rating as $item )
                    <tr>
                      <th>{{ $item->name }}</th>
                      <th>{{ $item->email }}</th>
                      <th>
                        @php
                          $redloop = $item->rating == 1 ? 1 : 0;
                          $goldloop = $item->rating > 1 ? $item->rating: 0;
                          $whiteloop = 5 - ( $redloop + $goldloop);                          
                        @endphp
                        @for($i = 1; $i <= $redloop; $i++)
                          <span class="fa fa-star danger"></span>
                        @endfor
                        @for($i = 1; $i <= $goldloop; $i++)
                          <span class="fa fa-star warning"></span>
                        @endfor
                        @for($i = 1; $i <= $whiteloop; $i++)
                          <span class="fa fa-star-o"></span>
                        @endfor                        
                      </th>
                      <th>
                        <a class="btn btn-primary" 
                          href="{{ url('ask-feedback/'.$social_id.'/'.$item->id) }}">Ask for feedback</a>
                      </th>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('script') 
<script type="text/javascript">
  $('#reviews').DataTable({});
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">    
    $(document).ready(function(){
        var dateFormat = "mm/dd/yy",
          from = $( "#date-range-from" )
            .datepicker({
              defaultDate: "+1w",
              changeMonth: true,
              numberOfMonths: 1
            })
            .on( "change", function() {
              to.datepicker( "option", "minDate", getDate( this ) );
            }),
          to = $( "#date-range-end" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1
          })
          .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
          });

        function getDate( element ) {
          var date;
          try {
            date = $.datepicker.parseDate( dateFormat, element.value );
          } catch( error ) {
            date = null;
          }
          return date;
        }
    });

</script> 
@endsection 
