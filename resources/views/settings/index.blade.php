@extends('layouts.main')



@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header-left col-md-6 col-xs-12 mb-1">
      <h3 class="content-header-title">Settings</h3>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
      <div class="breadcrumb-wrapper col-xs-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Dashboard</a> </li>
          <li class="breadcrumb-item"><a href="#">Settings</a> </li>
        </ol>
      </div>
    </div>
    <div class="content-body">
      <div class="col-xs-12">
        <div class="card">
          <div class="card-body collapse in">
            <div class="card-block card-dashboard"> @if(session()->has('message'))
              <div class="alert alert-info alert-dismissible"> {{ session()->get('message') }} </div>
              @endif
              
              @if(session()->has('message2'))
              <div class="alert alert-info alert-dismissible"> {{ session()->get('message2') }} </div>
              @endif
              
              @if(session()->has('message3'))
              <div class="alert alert-danger alert-dismissible"> {{ session()->get('message3') }} </div>
              @endif
              <div class="row setform-row">
                <div class="col-md-3">Title Text</div>
                <div class="col-md-7" id="title_old">@php $title=App\Settings::where('set_type','title')->first();@endphp {{$title->set_value}}</div>
                <div class="col-md-2 tar">
                  <button type="button" class="ml-1 mb-1 btn btn-outline-secondary btn-min-width" id="title">Update</button>
                </div>
              </div>
              <div class="col-md-12 setform-wrap" style="display: none;" id="display_title">
                
                <div class="setform">
                  <form method="post" action="{{url('settings/title')}}">
                    {{ csrf_field() }}
                    <div class="col-md-10">
                      <input type="text" name="title_new" value="" id="title_new" class="form-control">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Save </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body collapse in">
            <div class="card-block card-dashboard">
              <div class="row setform-row">
                <div class="col-md-3">Header Title Text</div>
                <div class="col-md-7" id="headertitle_old">@php $title=App\Settings::where('set_type','headertitle')->first();@endphp {{$title->set_value}}</div>
                <div class="col-md-2 tar">
                  <button type="button" class="ml-1 mb-1 btn btn-outline-secondary btn-min-width" id="headertitle">Update</button>
                </div>
              </div>
              <div class="col-md-12 setform-wrap" style="display: none;" id="headerdisplay_title">
                <div class="setform">
                  <form method="post" action="{{url('settings/headertitle')}}">
                    {{ csrf_field() }}
                    <div class="col-md-10">
                      <input type="text" name="headertitle_new" value="" id="headertitle_new" class="form-control">
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Save </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body collapse in">
            <div class="card-block card-dashboard">
              <div class="row setform-row">
                <div class="col-md-3">Frontend Logo</div>
                <div class="col-md-7">@php $title3=App\Settings::where('set_type','logo')->first();@endphp <img src="storage\images/{{$title3->set_value}}" width="60%"> </div>
                <div class="col-md-2 tar">
                  <button id="logo12" type="button" class="ml-1 mb-1 btn btn-outline-secondary btn-min-width"> Update</button>
                </div>
              </div>
              <div class="col-md-12 setform-wrap" id="display_logo" style="display: none;">
                <div class="setform">
                  <form method="post" action="{{url('settings/logo')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-10">
                    	<input type="file" id="file" class="form-control" name="image">
                    </div>
                    <div class="col-md-2">
                    	<button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Save </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script') 
<script type="text/javascript">

        $('#title').click(function()

        {   

            $('#display_title').show();

            $('#headerdisplay_title').hide();

            $('#display_logo').hide();

            var a=$('#title_old').text();

            $('#title_new').val(a);

        });

        $('#headertitle').click(function()

        {   

            $('#headerdisplay_title').show();

             $('#display_title').hide();

             $('#display_logo').hide();

            var a=$('#headertitle_old').text();

            $('#headertitle_new').val(a);

        });



        $('#logo12').click(function()

        {   

            $('#headerdisplay_title').hide();

            $('#display_title').hide();

            $('#display_logo').show();

        });





    </script> 
@endsection 