@extends('layouts.main')
@section('content')
 <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h3 class="content-header-title">Company List</h3>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Company List</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                            
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <a href="{{url('web_widget/add')}}">
                                        <button type="button" class="btn btn-primary btn-min-width mr-1 mb-1" style="float: right;"><i class="fa fa-plus"></i> Add Company</button>
                                    </a>
                                   
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
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="{{url('assets')}}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>
@endsection
