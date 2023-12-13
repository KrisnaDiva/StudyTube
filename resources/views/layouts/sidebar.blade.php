<div class="iq-sidebar">
    <div class="iq-navbar-logo d-flex justify-content-start">
       <div class="iq-menu-bt align-self-center">
          <div class="wrapper-menu">
             <div class="main-circle"><i class="ri-menu-line"></i></div>
             <div class="hover-circle"><i class="ri-menu-line"></i></div>
          </div>
       </div>
       <a href="index.html" class="">
          <span>StudyTube</span>
       </a>
    </div>
    <div id="sidebar-scrollbar">
       <nav class="iq-sidebar-menu">
          <ul id="iq-sidebar-toggle" class="iq-menu">
             <li class="{{ Route::currentRouteName()=='home' ? 'active' : ''}}">
                <a href="{{ route('home') }}" class="iq-waves-effect"><span class="ripple rippleEffect"></span><i
                      class="las la-home iq-arrow-left"></i><span>Home Page</span></a>
             </li>
             <li >
                <a href="#teach" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span
                      class="ripple rippleEffect"></span><i
                      class="las la-user-tie iq-arrow-left"></i><span>Teach</span><i
                      class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="teach" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
                  @foreach ($user->courses as $course)
                  <li class="{{ Request::is("course/$course->id") ? ' active active-menu' : ''}} "><a href="{{ route('course.show',$course->id) }}"><i class="las la-id-card-alt"></i>{{ $course->name }}</a></li>
                  @endforeach
                </ul>
             </li>
             <hr>
             <li>
                <a href="#registered" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span
                      class="ripple rippleEffect"></span><i
                      class="las la-user-tie iq-arrow-left"></i><span>Registered</span><i
                      class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="registered" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
                  @foreach ($user->mycourses()->get() as $course)
                  <li class="{{ Request::is("course/$course->id/*") ? ' active active-menu' : ''}} "><a href="{{ route('course.show',$course->id) }}"><i class="las la-id-card-alt"></i>{{ $course->name }}</a></li>
                  @endforeach
                </ul>
             </li>
          </ul>
       </nav>
       <div class="p-3"></div>
    </div>
 </div>