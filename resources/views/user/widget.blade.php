@extends('layouts.main')
@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Feedback Page</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Widgets</a></li>
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
                <div class="card-block card-dashboard"> @if ($message = Session::get('success'))
                  <div class="alert alert-success" role="alert"> {{ Session::get('success') }} </div>
                  @endif
                  <div class="form-body">
                    <div class="userwigt-head">
                      <button type="button" class="btn btn-primary" id="editform" style="float: right;"> <i class="ft-edit"></i> Edit </button>
                      <h4 class="form-section"><i class="ft-user"></i>Feedback Page</h4>
                    </div>
                    <div class="userwigt-col">
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">Customer Feedback Page</label>
                        <div class="col-md-9"> <a href="{{$url}}">{{$url}}</a> </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">Full Review Page</label>
                        <div class="col-md-9"> <a href="{{$url3}}">{{$url3}}</a> </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput2">Widget Code</label>
                        <div class="col-md-9">
                          <textarea class="form-control" cols="5" rows="15" readonly=""><script>var companySlug='{{$slug}}';(function(){var couponHtml = document.createElement('div'); couponHtml.id = 'coupon'; var domain='reviewchamp';var domainExtn='net';var midPath='login/widgetcode';var fileName='coupon'; var completeDomain=domain+'.'+domainExtn;var completeUrl='/'+midPath+'/'+fileName; var coupon = document.createElement('script'); coupon.type = 'text/javascript'; coupon.async = true;coupon.src = 'http://'+completeDomain+completeUrl+'.js';var thisScript = document.currentScript;var parent = thisScript.parentElement;parent.insertBefore(couponHtml, thisScript);parent.replaceChild(coupon, thisScript);})();</script></textarea>
                        </div>
                      </div>
                      <!--<div class="form-group row">
                      <label class="col-md-3 label-control" for="projectinput2">Show All Customer Reviews</label>
                      <div class="col-md-9">
                        <form method="post" action="{{url('showreview')}}">{{ csrf_field() }}
                          <div class="col-md-2">
                            <fieldset>
                              <input type="radio" class="review_show" name="review_show" id="input-radio-11" value="yes" @if($show_review =='yes') {{"checked"}} @endif required="">
                               <label for="input-radio-11">YES</label>
                             </fieldset>
                           </div>
                           <div class="col-md-2">
                            <fieldset>
                              <input type="radio" class="review_show" name="review_show" id="input-radio-12" value="no" @if($show_review=='no') {{"checked"}} @endif required="">
                               <label for="input-radio-12">NO</label>
                             </fieldset>
                            </div>
                            <div class="col-md-2">
                              <button type="submit" class="btn btn-primary">Enable/Disable</button>
                            </div>
                          </form>
                      </div>
                    </div>-->
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput3">Preview</label>
                        <div class="col-md-9">
                          <iframe width="100%" height="315" src="{{$url2}}" frameborder="0" allowfullscreen></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="form-actions"><center>
                  <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check-square-o"></i> Save
                    </button></center>
                </div> --> 
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