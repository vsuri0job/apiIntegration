<nav class="container header-navbar navbar navbar-with-menu navbar-fixed-top navbar-light navbar-border">
  <div class="navbar-wrapper">
    <div class="navbar-header">
      <ul class="nav navbar-nav">
        <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu font-large-1"></i></a></li>
        <li class="nav-item"><a href="{{url('/')}}" class="navbar-brand">
        @php 
            $title=App\Settings::where('set_type','logo')->first();
        @endphp
          <img src="{{url('storage/images/'.$title->set_value)}}" width="100%">
               <!--  <h2 class="brand-text">Review</h2></a></li> -->
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="fa fa-ellipsis-v"></i></a></li>
      </ul>
      </div>
      <div class="navbar-container content container-fluid">
        <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
          <ul class="nav navbar-nav float-xs-right">
            <li class="nav-item "><a href="{{ route('login') }}" class="nav-link "> Login</a></li> 
            <li class="nav-item "><a href="{{ route('register') }}" class="nav-link "> Register</a></li> 
          </ul>
        </div>
      </div>
    </div>
  </nav>