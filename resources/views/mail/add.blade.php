@extends('layouts.main')



@section('content')
<div class="app-content content container-fluid">
<div class="content-wrapper">
<div class="content-header-left col-md-6 col-xs-12 mb-1">
  <h3 class="content-header-title">Email Template</h3>
</div>
<div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
  <div class="breadcrumb-wrapper col-xs-12">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="#">Email Template</a></li>
    </ol>
  </div>
</div>
<div class="content-body">
<section id="configuration">
<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-body collapse in" >
<div class="card-block card-dashboard">
<div  style="width: 45%!important; float: left;"> </div>
<div class="col-md-12 pd-0" style="margin-top: 0">
<form role="form" method="post" action="{{url('mail/create')}}" enctype="multipart/form-data">
{{ csrf_field() }}

                                                

                                               

                                                    {{ csrf_field() }}
<div class="form-body">
  <div class="form-group">
    <label for="eventRegInput1">Email Title</label>
    <div class="box box-info">
      <input type="text" name="name" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="eventRegInput1">Here Design Your template</label>
    <div class="box box-info">
      <textarea id="editor1" name="message" rows="10" cols="80">Write your message

                                                                </textarea>
    </div>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" > <i class="ft-edit"></i> Submit </button>
  </div>
</div>
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
<script src="{{url('assets')}}/ck/ckeditor.js"></script> 
<script>

  $(function () {

    CKEDITOR.replace('editor1',{

      extraPlugins: 'imageuploader'

    });

    //bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5();





  })

</script> 
@endsection 