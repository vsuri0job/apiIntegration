@extends('layouts.main')

@section('content')
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-1">
        <h3 class="content-header-title">Request Feedback</h3>
      </div>
      <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
        <div class="breadcrumb-wrapper col-xs-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a> </li>
            <li class="breadcrumb-item"><a href="#">Request Feedback</a> </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-body"><!-- Zero configuration table -->
      
      <section id="configuration">
        <div class="row">
          <div class="col-xs-12">
            <div class="card"> @if(session()->has('message'))
              <div class="alert alert-info alert-dismissible"> {{ session()->get('message') }} </div>
              @endif
              <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                  <form class="form form-horizontal" method="post" action="{{url('feedback/send')}}">
                    {{ csrf_field() }}
                    <div class="form-body">
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">Select Customer</label>
                        <div class="col-md-9 slctspan">
                          <select class="select2 form-control block" id="select1" name="ratingid[]" multiple="multiple" required>
                            @foreach($rating as $rate)
							@if($rate->email !== "")

                            <option value="{{$rate->email}}"> {{$rate->email}} </option>
                            	@endif
								@endforeach
							</select>
                          <a href="javascript:void(0)" class="emails">
                          <p style="margin:0;">Enter another customer email</p>
                          </a> </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">Template</label>
                        <div class="col-md-9">
                          	<select class=" form-control block" id="template" name="templateid" required>
                            	<option value="">Select Email Template</option>
                            	@foreach($templates as $template)
								<option value="{{$template->id}}"> {{$template->name}}</option>
                            	@endforeach
							</select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput3">View Template</label>
                        <div class="col-md-9">
                        	<div class="viewtemp-field">
                          		<div id="viewtemp" style="background-color: white;padding: 1%"></div>
                         	</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput3"></label>
                        <div class="col-md-9">
                          <button type="submit" class="btn btn-primary ">Send Email</button>
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
<div class="modal fade addpara" id="addpara" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Customer Email</h4>
      </div>
      <div class="modal-body">
        <form class="form" id="configform" enctype="multipart/form-data" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <div class="form-body">
                <div class="form-group">
                  <label for="eventInput1">Email Address</label>
                  <input type="text"  class="form-control name12" placeholder="Customer Email" name="emailid" id="email" value="">
                  <div class="alert alert-warning" id="msg" style="display: none;"></div>
                </div>
                <div class="form-group">
                  <label for="eventInput1"></label>
                  <button type="button" id="addemail" name="button" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> Add </button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script') 
<script type="text/javascript">

    $('#template').change(function(){

        var tempid= $('#template').val();

        $.ajax({

            url: '{{url("gettemplate")}}/'+tempid,

            type:'get',

            success:function(data){

              //  alert(data);

                $('#viewtemp').html(data);

            }

        });

    });

    $('.emails').click(function(){

       $('.addpara').modal('show');

    });

</script> 
<script type="text/javascript">

    $(document).ready(function(){

        $('#addemail').click(function(){

            emails = [];

            $('input[name^=emailid]').each(function(){

                emails.push($(this).val());

            });

            var mySelect = $('#select1');

            $.each(emails, function(val, text)

            {

                $('#email').val('');

                mySelect.append($('<option selected></option>').val(emails).html(text));

            });

            //alert(emails);

            $('.addpara').modal('hide');

            $('#email').val('');

        });

    });

</script> 
@endsection 