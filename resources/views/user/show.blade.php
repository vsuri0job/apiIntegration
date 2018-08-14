@extends('layouts.main')
@section('content')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h3 class="content-header-title"> Manage Sites</h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#"> Manage Sites</a></li>
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
	                                <a href="{{url('user')}}" class="btn btn-primary btn-min-width mr-1 mb-1" style="float: right;">
	                                   <i class="fa fa-arrow-left"></i> Back
	                                </a>
                                    <section id="horizontal-form-layouts">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header"></div>
                                                    <div class="card-body collapse in">
                                                        <div class="card-block">
                                                            <form class="form form-horizontal" method="post" action="#" enctype="multipart/form-data">{{ csrf_field() }}
                                                                <div class="form-body">
                                                                   <div class="form-group row">
                                                                     <label class="col-md-3 label-control" for="projectinput1">Name</label>
                                                                     <div class="col-md-9">
                                                                        <label class="label-control" for="projectinput1">{{$user->name}}</label> 
                                                                     </div>
                                                                   </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                                                        <div class="col-md-9">
                                                                            <label class="label-control" for="projectinput1">{{$user->email}}</label> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-3 label-control" for="projectinput2">Company name</label>
                                                                        <div class="col-md-9">
                                                                            <label class="label-control" for="projectinput1">{{$user->company_name}}</label> 
                                                                           
                                                                        </div>
                                                                    </div>
																	
                                                                   
                                                                    <div class="form-group row">
                                                                        <label class="col-md-3 label-control" for="projectinput4">Logo</label>
                                                                        <div class="col-md-9">
                                                                            <label class="label-control" for="projectinput1">
                                                                            	 <img src="{{url('storage/logos/'.$user->logo)}}" width="60%">
                                                                            </label> 
                                                                        </div>
                                                                    </div>
																</div>
															</form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
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
