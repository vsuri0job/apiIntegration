@extends('layouts.main')
@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Customers List</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a> </li>
            <li class="breadcrumb-item"><a href="#">Reviews List</a> </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-body"><!-- Zero configuration table -->
      <section id="file-export">
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="card-body collapse in">
                <div class="card-block card-dashboard cstmr-db"> 
                  <a class="impt-btn" href="{{url('customer/import')}}">
                    <button style="float: right;" type="button" class="btn btn-primary">Import</button>
                  </a>
                  <table class="table table-striped table-bordered" id="table5">
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php  $i=1; @endphp
                    @foreach($ratings as $rating)
                    <tr> @if($rating->email != "")
                      <td>{{$rating->name}}</td>
                      <td>{{$rating->email}}</td>
                      <td>{{$rating->contact}}</td>
                      @endif </tr>
                    @php  $i=$i+1; @endphp
                    @endforeach
                    </tbody>
                  </table>
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
$('#table5').DataTable({
  dom: 'Bfrtip',
  buttons: [
  'csv', 'excel', 'pdf'
  ]
});
</script> 
@endsection 