@extends('layouts.main')
@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Manage Sites</h3>
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
                            <div class="card-block card-pad">
                              <form class="form form-horizontal" method="post" action="{{url('manage_site/update',$social->id)}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-body">
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Social Site</label>
                                    <div class="col-md-9">
                                      <select name="social_id" id="social_id" class="form-control">
                                        <option value="facebook">Select Social Site</option>
                                        @foreach($socialmedia as $social1)
                                        <option value="{{$social1->id}}"
                                          @if($social1->id== $social->social_id)
                                          selected
                                        @endif
                                        >{{$social1->name}}</option>
                                        @endforeach
                                      </select>
                                      @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Page Name</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput1" class="form-control"  name="pagename" value="{{$social->pagename}}">
                                      @if ($errors->has('pagename')) <span class="help-block"> <strong>{{ $errors->first('pagename') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput2">Social Page URL</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput2" class="form-control" Socialurl=" URL" name="socialurl" value="{{ $social->socialurl }}">
                                      @if ($errors->has('socialurl')) <span class="help-block"> <strong>{{ $errors->first('socialurl') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Social page review url</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput1" class="form-control" placeholder="Social page review url" name="socialpage_reviewurl" value="{{$social->social_page_review_url}}">
                                      @if ($errors->has('socialpage_reviewurl')) <span class="help-block"> <strong>{{ $errors->first('socialpage_reviewurl') }}</strong> </span> @endif </div>
                                  </div>
                                  <!-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput2"> URL</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput2" class="form-control" placeholder=" URL" name="url" value="{{$social->url}}">
                                      @if ($errors->has('pagename')) <span class="help-block"> <strong>{{ $errors->first('pagename') }}</strong> </span> @endif </div>
                                  </div> -->
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput3">Enter Api Key</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput3" class="form-control" placeholder="API KEY" name="api" value="{{$social->api}}">
                                      @if ($errors->has('api')) <span class="help-block"> <strong>{{ $errors->first('api') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4" id="labelid">Place ID/Business Key/Secret Key</label>
                                    <div class="col-md-9">
                                      <input type="text" i class="form-control"
                                                                            placeholder="Place ID/Business Key/Secret Key" id="secret" name="secret" value="{{$social->secret}}">
                                      @if ($errors->has('secret')) <span class="help-block"> <strong>{{ $errors->first('secret') }}</strong> </span> @endif </div>
                                  </div>
                                   <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Page Id</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput4" class="form-control" placeholder="Page Id" name="page_id" value="{{$social->page_id}}">
                                      @if ($errors->has('page_id')) <span class="help-block"> <strong>{{ $errors->first('page_id') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Access Token</label>
                                    <div class="col-md-9">
                                      <input type="text" id="projectinput4" class="form-control" placeholder="Access Token" name="access_token" value="{{$social->access_token}}">
                                      @if ($errors->has('access_token')) <span class="help-block"> <strong>{{ $errors->first('access_token') }}</strong> </span> @endif </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4"></label>
                                    <div class="col-md-9">
                                      <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Save </button>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-actions"> </div>
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
<script type="text/javascript">
$(document).ready(function(){
    var name = $('#secret').attr("placeholder");
    var socialid = $('#social_id').val();
    var selected= $("#labelid").text();
    if(socialid == 2) 
    {
      $("#secret").attr("placeholder", "Place id");
      $('#labelid').text("Place Id");
    }
    if(socialid == 1)
    {
      $("#labelid ").text("Secret Id");
    }
   

    $('#social_id').on('change',function()
    {
      var google = $(this).val();
      if(google == "2") 
      {
          $("#secret").attr("placeholder", "Place id");
          $('#labelid').text("Place Id");
       }
      else 
      {
        $("#secret").attr("placeholder", "secrete key");
        $('#labelid').text("Secret Id");
      }
    });
});
</script> 
@endsection 