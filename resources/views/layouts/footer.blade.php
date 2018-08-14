 <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2017 <a href="#" target="_blank" class="text-bold-800 grey darken-2">Review </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block hidden-md-down"> </span></p>
    </footer>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/extensions/unslider-min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/js/core/app.js" type="text/javascript"></script>
   <script src="{{url('assets')}}/app-assets/js/scripts/pages/dashboard-fitness.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
    
    <script src="{{url('assets')}}/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
    <script src="{{url('assets')}}/app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>


    <script src="{{url('assets')}}/app-assets/vendors/js/extensions/toastr.min.js" type="text/javascript"></script>
    
    <?php if( !empty($include_js) ){

        if ($include_js == 'custom') {
          # code...
    ?>
      <script async defer src="https://apis.google.com/js/api.js" 
      onload="this.onload=function(){};HandleGoogleApiLibrary()" 
      onreadystatechange="if (this.readyState === 'complete') this.onload()"></script>
      <script src="{{url('assets')}}/app-assets/review-champ.custom-script.js" type="text/javascript"></script>

      <script async defer src="https://apis.google.com/js/api.js"
        onload="this.onload=function(){};handleClientLoad()"
        onreadystatechange="if (this.readyState === 'complete') this.onload()">
      </script>

    <?php        
        }

      } ?>

      <script>
      $(document).ready(function(){
          $('#select1').select2();
       });
      
    </script>
    
    