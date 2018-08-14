 @extends('layouts.main')

@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Edit template</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Edit template</a></li>
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
                              <form class="form form-horizontal" method="post" action="{{url('mail/update/'.$template->id)}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-body">
                                  <div class="form-body">
                                    <div class="form-group">
                                      <label for="eventRegInput1">Email Title</label>
                                      <div class="box box-info">
                                        <input type="text" name="name" class="form-control" value="{{$template->name}}">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="eventRegInput1">Here Design Your template</label>
                                      <div class="box box-info">
                                        <textarea id="editor1" name="message" rows="10" cols="80">{{$template->message}}

                                                                </textarea>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary" > <i class="ft-edit"></i> Submit </button>
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
@section('script') 
<script src="{{url('assets')}}/ck/ckeditor.js"></script> 
<script>

  $(function () {

    CKEDITOR.replace('editor1');

    //bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5()

  })

</script> 
@endsection 