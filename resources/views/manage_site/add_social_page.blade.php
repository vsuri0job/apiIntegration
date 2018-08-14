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
            <li class="breadcrumb-item call_to_ajax"><a href="#">Manage Sites 1</a></li>
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
                <div class="card-block card-dashboard"><a href="{{url('manage_site')}}">
                  <button type="button" class="btn btn-primary btn-min-width ml-1 mb-1" style="float: right;"><i class="fa fa-arrow-left"></i> Back</button>
                  </a>
                  <section id="horizontal-form-layouts" class="clr">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-header card-empty"></div>
                          <div class="card-body collapse in">
                            <div class="card-block card-pad">
                              <form class="form form-horizontal" method="post" action="{{url('manage_site/create_social_page')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-body">
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Social Site</label>
                                    <div class="col-md-9">
                                      <select name="social_id" class="form-control" id="social_id">
                                        <option value="facebook">Select Social Site</option>
                                        @foreach($socialmedia as $social)
                                        <option value="{{$social->id}}">{{ucfirst($social->name)}}</option>
                                        @endforeach
                                      </select>
                                      @if ($errors->has('social_id')) <span class="help-block"> <strong>{{ $errors->first('social_id') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Page Name</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput1" class="form-control" placeholder="Page Name" name="pagename" value="{{old('pagename')}}">
                                      @if ($errors->has('pagename')) <span class="help-block"> <strong>{{ $errors->first('pagename') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Social Page URL</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput1" class="form-control" placeholder="Social Page url" name="socialurl" value="{{old('socialurl')}}">
                                      @if ($errors->has('socialurl')) <span class="help-block"> <strong>{{ $errors->first('socialurl') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Social page review url</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput1" class="form-control" placeholder="Social page review url" name="socialpage_reviewurl" value="{{old('socialpage_reviewurl')}}">
                                      @if ($errors->has('socialpage_reviewurl')) <span class="help-block"> <strong>{{ $errors->first('socialpage_reviewurl') }}</strong> </span> @endif </div>
                                  </div>
                                  <!-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput2"> URL</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput2" class="form-control" placeholder=" URL" name="url">
                                      @if ($errors->has('url')) <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span> @endif </div>
                                  </div> -->
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput3">Api Key</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput3" class="form-control" placeholder="API KEY" name="api" value="{{old('api')}}">
                                      @if ($errors->has('api')) <span class="help-block"> <strong>{{ $errors->first('api') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4" id="labelid">Place ID/Business Key/Secret Key</label>
                                    <div class="col-md-9">
                                      <input type="text" id="secret" class="form-control" placeholder="Secret Key" name="secret" value="{{old('secret')}}">
                                      @if ($errors->has('secret')) <span class="help-block"> <strong>{{ $errors->first('secret') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Page Id</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput4" class="form-control" placeholder="Page Id" name="page_id" value="{{old('page_id')}}">
                                      @if ($errors->has('page_id')) <span class="help-block"> <strong>{{ $errors->first('page_id') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Access Token</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput4" class="form-control" placeholder="Access Token" name="access_token" value="{{old('access_token')}}">
                                      @if ($errors->has('access_token')) <span class="help-block"> <strong>{{ $errors->first('access_token') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4"></label>
                                    <div class="col-md-9">
                                      <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Save </button>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-actions"></div>
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
<script>
$(document).ready(function(){
  var selected= $("#labelid").text();
  var selected= $("#labelid").text();
  var getvalues = $(this).val();
   if(getvalues == ''){
       $("#secret").attr("placeholder", "Place ID/Business Key/Secret Key");
    }
  $("#social_id").change(function(){
    var getvalue = $(this).val();
    if(getvalue == 1){
        $("#divfield1").css("display", "block");
        $("#divfield2").css("display", "block");
        $("#labelid").text("Secret Key");
        $("#secret").attr("placeholder", "Secret Key");
    }else if(getvalue == 2){
        $("#labelid").text("Place Id");
        $("#secret").attr("placeholder", "Place id");
    }else{
        $("#divfield1").css("display", "none");
        $("#divfield2").css("display", "none");
        $("#labelid").text("Place ID/Business Key/Secret Key");
        $("#secret").attr("placeholder", "Place ID/Business Key/Secret Key");
    }
   });
});
</script>
@endsection 