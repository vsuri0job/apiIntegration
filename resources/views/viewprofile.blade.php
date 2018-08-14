@extends('layouts.main')
@section('content')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h3 class="content-header-title">View Profile </h3>
        </div>
         <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">View Profile</a>
                </li>
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
                                @if($message = Session::get('success'))
                                 <div class="alert alert-success alert-dismissible fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> Record updated.
                                  </div>
                                  @endif
                                    <div  style="width: 45%!important; float: left;">                                     
                                       <table class="table table-striped table-bordered zero-configuration" id="table2">
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td id="name1">{{$users->name}}</td>
                                            </tr>
                                             <tr>
                                                <td>Email</td>
                                                <td id="email1">{{$users->email}}</td>
                                            </tr>
                                             <tr>
                                                <td>Company Name</td>
                                                <td id="company_name1">{{$users->company_name}}</td>
                                            </tr>
                                            <!-- <tr>
                                                <td>Review Champ</td>
                                                <td id="company_slug1">
                                                 <a href="http://localhost/reviewchamp/web-widget/web-devloper">
                                                    http://localhost/reviewchamp/web-widget/web-devloper
                                                </a>
                                                </td>
                                            </tr> -->
                                            @if( $users->stripe_customer_id && $users->stripe_subscription_id && 
                                            $users->is_subscribed )
                                                <tr>
                                                    <td>Monthly Subscribed</td>
                                                    <td><a href="{{url('cancelSubscription')}}"  class="btn btn-primary"
                                                        >Cancel Subscription</a></td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>Monthly Subscribed</td>
                                                    <td class="text-info">
                                                        <form action="{{ url('reset_subscription') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        @php                                                            
                                                            $end_date = date('d-m-Y' , strtotime( $users->end_date ));
                                                        @endphp
                                                        Your subscrption is going to end on {{ $end_date }}.
                                                        <input type="submit" name="update-subscription" 
                                                            class="btn btn-primary" value="Re-Subscribe" />
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <form role="form" method="post" action="" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="userid" 
                                                            class="form-control round" value="{{$users->id}}" name="userid" >
                                                        <button type="button" class="btn btn-primary" 
                                                                id="editform" style="float: right;">
                                                                <i class="ft-edit"></i> Edit
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                       </table>
                                    </div>
                                    <div style="display:none; width: 50%!important; float: right;" id="edit_display">
                                        <form method="post" action="{{url('editprofile/'.$users->id)}}">{{ csrf_field() }}
                                           <table class="table table-striped table-bordered zero-configuration" >
                                            <tbody>
                                                <tr>
                                                    <td>Name <span class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="text" id="name" class="form-control round" value="{{ old('name') }}" name="name" >
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                     </td>
                                                </tr>
                                                 <tr>
                                                    <td>Email <span class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="text" id="email" class="form-control round" value="{{ old('email') }}" name="email">
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Company Name <span class="text-danger">*</span></td>
                                                    <td>
                                                        <input type="text" id="company_name" class="form-control round" value="{{ old('company_name') }}" name="company_name">
                                                        @if ($errors->has('company_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('company_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Password</td>
                                                    <td>
                                                        <input type="password" id="password" class="form-control round" name="password">
                                                    </td>
                                                </tr>
                                            </tbody>
                                           </table>
                                           <button type="submit" class="btn btn-primary" style="float: right;">
                                                <i class="ft-edit"></i> Submit
                                            </button>
                                         </form>
                                    </div>
                                    @if(Auth::user()->role=='user')
                                        <div class="col-md-12" style="margin-top: 30px">
                                             <form class="form" method="POST" action="{{ url('header/'.$users->id) }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">Upload Company Logo</label>
                                                        <input id="logo" type="file" class="form-control" name="logo">
                                                            <img src="{{ asset('storage/logos/'.$users->logo) }}" width="100px" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">Phone Number</label>
                                                        <input id="phone" type="text" class="form-control" name="phone" value="{{$users->phone}}" placeholder="1-800-758-6282" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">Website</label>
                                                        <input id="website" type="text" class="form-control" name="website" value="{{$users->website}}" placeholder="www.xyz.com" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">Write your message</label>
                                                        <div class="box box-info">
                                                            <textarea id="editor1" name="message" rows="10" cols="80">{{$users->message}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" >
                                                            <i class="ft-edit"></i> Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
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
    <script type="text/javascript">
        $('#editform').click(function() 
        {   $('#edit_display').show();
            var userid= $('#userid').val();
            var name1 = $("#table2 #name1").text();
            var email1=$("#table2 #email1").text();
            var company_name1=$("#table2 #company_name1").text();
            $('#name').val(name1);
            $('#email').val(email1);
            $('#company_name').val(company_name1);
        });
    </script>
    <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
@endsection
