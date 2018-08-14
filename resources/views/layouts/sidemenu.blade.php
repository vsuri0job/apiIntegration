<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion">
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
         
          <li class=" nav-item" @if(Request::is('home')) style="background: #2f7ac2;" @endif ><a href="{{ url('home') }}"><i class="ft-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
          </li>

            @if(Auth::user()->role=='admin')
              <li class="nav-item @if(Request::is('user') || Request::is('user/*')){{'menu-active'}}@endif" ><a href="{{url('user')}}"><i class="ft-user"></i><span data-i18n="" class="menu-title">Customers</span></a>
              </li>
               <li class=" nav-item" @if(Request::is('settings')) style="background: #2f7ac2;" @endif ><a href="{{url('settings')}}"><i class="ft-settings"></i><span data-i18n="" class="menu-title">Settings</span></a>
              </li>
                <li class=" nav-item" @if(Request::is('mail')) style="background: #2f7ac2;" @endif ><a href="{{url('mail')}}"><i class="ft-mail"></i><span data-i18n="" class="menu-title">Create Email Template</span></a>
              </li>
            @else
           
            <li class=" nav-item" @if(Request::is('request-feedback')) style="background: #2f7ac2;"  @endif ><a href="{{url('request-feedback')}}"><i class="ft-message-square"></i><span data-i18n="" class="menu-title">Customer Feedback</span></a>
            </li>
            <li class=" nav-item" 
              @if(Request::is('list-feedback') || Request::is('ask-feedback/*')) style="background: #2f7ac2;"  @endif >
              <a href="{{url('list-feedback')}}">
                <i class="ft-message-square"></i><span data-i18n="" class="menu-title">Customer All Reveiws
                </span></a>
            </li>
             <li class=" nav-item" @if(Request::is('review')) style="background: #2f7ac2;" @endif ><a href="{{url('review')}}"><i class="ft-list"></i><span data-i18n="" class="menu-title">View all Reviews</span></a>
            </li>

            <!-- <li class="nav-item " @if(Request::is('manage_site')) style="background: #2f7ac2;" @endif ><a href="{{url('manage_site')}}"><i class="ft-layers"></i><span data-i18n="" class="menu-title">My Review Services</span></a>
            <ul class="menu-content" style="">
              <li class=""><a href="{{url('facebook')}}" class="menu-item">Facebook</a>
              </li>
              <li class=""><a href="{{url('google')}}" class="menu-item">Google</a>
              </li>
              
            </ul>
            </li> -->

            <li class=" nav-item" @if(Request::is('manage/connect-social-pages')) style="background: #2f7ac2;" @endif >
              <a href="{{url('manage/connect-social-pages')}}"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Connect social pages</span></a>
            </li>

             <li class=" nav-item" @if(Request::is('user/widget')) style="background: #2f7ac2;" @endif ><a href="{{url('user/widget')}}"><i class="ft-sun"></i><span data-i18n="" class="menu-title">Widget Manager</span></a>

            </li>
            <li class=" nav-item" @if(Request::is('customer')) style="background: #2f7ac2;" @endif ><a href="{{url('customer')}}"><i class="ft-user"></i><span data-i18n="" class="menu-title">Customer List</span></a>
            </li>
            <li class=" nav-item" @if(Request::is('mail')) style="background: #2f7ac2;" @endif  ><a href="{{url('mail')}}"><i class="ft-mail"></i><span data-i18n="" class="menu-title">Email Templates</span></a>
            </li>
              <li class=" nav-item" @if(Request::is('viewprofile')) style="background: #2f7ac2;" @endif><a href="{{url('viewprofile')}}"><i class="ft-user"></i><span data-i18n="" class="menu-title">Company Profile </span></a>
            </li>

          @endif
       
        
          
          
         </ul>
      </div>
    </div>