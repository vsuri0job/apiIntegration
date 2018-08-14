 @extends('layouts.main')

@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Reviews LisT</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Reviews List</a></li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-body"><!-- Zero configuration table -->
      
      <section id="configuration">
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="row" style="padding: 4% 15px;">
                <div class="col-md-8 reviewslct">
                  <div class="col-md-3">
                    <label class="label-control">
                    <h5>Filter by source </h5>
                    </label>
                  </div>
                  <div class="col-md-7">
                    <select class="form-control" name="social" id="social">
                      <option value="all" >All</option>
                      @foreach($socilamedia as $social)
                      <option value="{{$social->social_id}}" >{{$social->socialname->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button type="button" id="search" class="btn btn-primary" >Search</button>
                  </div>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="card-body collapse in">
                <div class="card-block card-dashboard"> @if ($message = Session::get('success'))
                  <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
                  @endif
                  <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="rating">
                    <thead>
                      <tr>
                        <th>Customer Name </th>
                        <th>Review Type</th>
                        <th>Review</th>
                        <th width="13%">Date</th>
                        <th>Stars</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php  $i=1; @endphp
                    @foreach($ratings as $rating)
                    <tr>
                      <td>{{ $rating->name }} </td>
                      <td><img src="{{url('assets/'.$rating->social['logo'])}}" width="100%"></td>
                      <td>{{$rating->comment}}</td>
                      <td> {{$rating->created}} </td>
                      <td><img src="{{url('assets')}}/{{$rating->rating}}star.png" width="100px"></td>
                    </tr>
                    @php  $i=$i+1; @endphp
                    @endforeach
                      </tbody>
                   </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection

@section('script') 
<script type="text/javascript">

    $('#rating').DataTable({

      

    });



    $('#search').click(function()

    { 

        var social= $('#social').val();

        window.location = '{{url("/review")}}/'+social;

    });

</script> 
@endsection 