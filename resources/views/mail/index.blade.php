@extends('layouts.main')

@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Manage Email Templates</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a> </li>
            <li class="breadcrumb-item"><a href="#">Email Template</a> </li>
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
                <div class="card-block card-dashboard emailtable"><a href="{{url('mail/add')}}">
                  <button type="button" class="btn btn-primary btn-min-width ml-1 mb-1" style="float: right;"><i class="fa fa-plus"></i> Create Template</button>
                  </a>
                  <div class="table-responsive">
                  <table class="table table-striped table-bordered zero-configuration" id="table1">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Content</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    
                    @foreach($templates as $template)
                    <tr>
                      <td>{{$template->name}}</td>
                      <td> {!! $template->message !!}</td>
                      <td><a href="{{url('mail/edit/'.$template->id)}}">
                        <div class="col-md-3 fonticon-container">
                          <div class="fonticon-wrap"> <i class="ft-edit"></i> </div>
                        </div>
                        </a></td>
                    </tr>
                    @php $i=$i+1; @endphp
                    
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
<link rel="stylesheet" type="text/css" href="{{url('assets')}}/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
<script src="{{url('assets')}}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script> 
@endsection 