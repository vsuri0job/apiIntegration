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
                <div class="card-block card-dashboard"> <a href="{{url('manage_site')}}">
                  <button type="button" class="btn btn-primary btn-min-width ml-1 mb-1" style="float: right;"><i class="fa fa-arrow-left"></i> Back</button>
                  </a>
                  <section id="horizontal-form-layouts" class="clr">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-header card-empty"></div>
                          <div class="card-body collapse in">
                            <div class="card-block card-pad labelbold">
                              <form class="form form-horizontal" method="post" action="{{url('manage_site/create')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-body">
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Social Site</label>
                                    <div class="col-md-9">
                                      <label class="label-control" for="projectinput1">{{ $social->socialname->name }}</label>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Page Name</label>
                                    <div class="col-md-9">
                                      <label class="label-control" for="projectinput1">{{$social->pagename}}</label>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Page Name</label>
                                    <div class="col-md-9">
                                      <label class="label-control" for="projectinput1">{{$social->social_page_review_url}}</label>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput2"> URL</label>
                                    <div class="col-md-9">
                                      <label class="label-control" for="projectinput1">{{$social->url}}</label>
                                    </div>
                                  </div> -->
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput3">API id</label>
                                    <div class="col-md-9">
                                      <label class="label-control" for="projectinput1">{{$social->api}}</label>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Secret Id</label>
                                    <div class="col-md-9">
                                      <label class="label-control" for="projectinput1">{{$social->secret}}</label>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Page Id</label>
                                    <div class="col-md-9">
                                      <label class="label-control" for="projectinput1">{{$social->page_id}}</label>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Access Token</label>
                                    <div class="col-md-9">
                                      <label class="label-control" for="projectinput1">{{$social->access_token}}</label>
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