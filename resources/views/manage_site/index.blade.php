@extends('layouts.main')
@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Manage Social Sites</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Manage Social Sites</a></li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-body"><!-- Zero configuration table -->
      <section id="configuration">
        <div class="row">
          <div class="col-xs-12">
          @if($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
            <strong>{{$errors->first()}}</strong>
          </div>
          @endif
          @if($message = Session::get('success'))
          <div class="alert alert-success alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{Session::get('success')}}
          </div>
          @endif
            <div class="card"> 
              <div class="card-body collapse in">
                <div class="card-block card-dashboard"> 
                  <a href="{{url('manage_site/add')}}">
                  <button type="button" class="btn btn-min-width ml-1 mb-1" style="float: right; color:#ffffff; background: #307bc4"> 
                    <i class="fa fa-plus"></i> Add Social Sites 
                  </button>
                  </a>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration" id="table1">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Page name</th>
                        <th>URl</th>
                        <th>Action</th>
                        <th>Fetch</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=1 @endphp
                      @foreach($social as $soc)
                      <tr>
                        <td>{{ ucfirst($soc->socialname->name) }} </td>
                        <td>{{$soc->pagename}}</td>
                        <td>{{$soc->socialurl}}</td>
                        <td class="action-td">
                          <a href="{{url('manage_site/show/'.$soc->id)}}" >
                            <div class="fonticon-container">
                              <div class="fonticon-wrap"> 
                                <i class="ft-eye" data-placement="top" title="" data-original-title="View"></i> 
                              </div>
                            </div>
                          </a> 
                          <a href="{{url('manage_site/edit/'.$soc->id)}}">
                            <div class="fonticon-container">
                              <div class="fonticon-wrap"> <i class="ft-edit" data-placement="top" title="" data-original-title="Edit"></i> 
                              </div>
                            </div>
                          </a> 
                         <!-- <a href="{{url('manage_site/delete/'.$soc->id)}}" onclick="return confirm('  “Are you sure you want to delete? “')">
                        <div class="col-md-2 fonticon-container">
                          <div class="fonticon-wrap">
                            <i class="ft-trash-2" data-placement="top" title="" data-original-title="Delete"></i>
                          </div>
                        </div>
                        </a> --> 
                          @if($soc->active=='yes') <a href="{{url('manage_site/active/'.$soc->id)}}" >
                            <div class="fonticon-container">
                              <div class="fonticon-wrap"> <i class="ft-check" data-placement="top" title="" data-original-title="Active"></i> </div>
                            </div>
                            </a> @else <a href="{{url('manage_site/inactive/'.$soc->id)}}">
                            <div class="fonticon-container">
                              <div class="fonticon-wrap"> <i class="ft-x" style="color: red" data-toggle="tooltip" data-placement="top" title="" data-original-title="Inactive"></i> </div>
                            </div>
                            </a> 
                          @endif 
                        </td>
                        <td> 
                          @if($soc->socialname->name == 'Facebook') 
                          <a href="{{ url('facebookReview/'. Auth::id()) }}" class="btn btn-primary">Fetch</a> 
                          @elseif($soc->socialname->name == 'Google') 
                          <a href="{{ url('googlereview') }}" class="btn btn-primary">Fetch</a>
                          @elseif($soc->socialname->name == 'Yelp') 
                          <a href="{{ url('yelpreview') }}" class="btn btn-primary">Fetch</a> 
                          @else <a href="#" class="btn btn-primary">Fetch</a> 
                          @endif
                        </td>
                      </tr>
                      @php $i++ @endphp 
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