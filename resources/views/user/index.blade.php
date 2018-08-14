@extends('layouts.main')

@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Customer List</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a> </li>
            <li class="breadcrumb-item"><a href="#">Customer List</a> </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-body"><!-- Zero configuration table -->
      
      <section id="configuration">
        <div class="row">
          <div class="col-xs-12">
            <div class="card"> @if ($message = Session::get('success'))
              <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
              @endif
              <div class="card-body collapse in">
                <div class="card-block card-dashboard"> <a href="{{url('user/add')}}"  class="btn btn-primary btn-min-width ml-1 mb-1" style="float: right;"> <i class="fa fa-plus"></i> Add Customer</a>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered zero-configuration" id="table1">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company Name</th>
                        <th>Company Slug</th>
                        <th>Activate</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($users as $user)
                    <tr>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->company_name}}</td>
                      <td>{{$user->company_slug}}</td>
                      <td> @if($user->active=='1') <a href="{{ url('user/inactive/'.$user->id) }}" >
                        <div class="col-md-2 fonticon-container">
                          <div class="fonticon-wrap"> <i class="ft-check" data-placement="top" title="" data-original-title="Active"></i> </div>
                        </div>
                        </a> @else <a href="{{ url('user/active/'.$user->id) }}">
                        <div class="col-md-2 fonticon-container">
                          <div class="fonticon-wrap"> <i class="ft-x" style="color: red"  data-placement="top" title="" data-original-title="Inactive"></i> </div>
                        </div>
                        </a> @endif </td>
                      <td><a href="{{url('user/edit/'.$user->id)}}">
                        <div class="col-md-3 fonticon-container">
                          <div class="fonticon-wrap"> <i class="ft-edit"></i> </div>
                        </div>
                        </a> <a href="{{url('user/show/'.$user->id)}}"  >
                        <div class="col-md-2 fonticon-container">
                          <div class="fonticon-wrap"> <i class="ft-eye" data-placement="top" title="" data-original-title="View"></i> </div>
                        </div>
                        </a> 
                        
                        <a href="{{url('user/delete/'.$user->id)}}" onclick="return confirm('  “Are you sure you want to delete? “')">

                                                        <div class="col-md-3 fonticon-container">

                                                            <div class="fonticon-wrap">

                                                                <i class="ft-trash-2"></i>

                                                            </div>

                                                        </div>

                                                    </a> </td>
                    </tr>
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