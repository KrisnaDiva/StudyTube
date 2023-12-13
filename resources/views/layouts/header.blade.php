<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
       <nav class="navbar navbar-expand-lg navbar-light p-0">
          <div class="iq-menu-bt d-flex align-items-center">
             <div class="wrapper-menu">
                <div class="main-circle"><i class="ri-menu-line"></i></div>
                <div class="hover-circle"><i class="ri-menu-line"></i></div>
             </div>
             <div class="iq-navbar-logo d-flex justify-content-between ml-3">
                <a href="index.html" class="header-logo">
                   <span>StudyTube</span>
                </a>
             </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
             aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
             <i class="ri-menu-3-line"></i>
          </button>
          <div class="collapse navbar-collapse" style="z-index: 0;" id="navbarSupportedContent">
             <ul class="navbar-nav ml-auto navbar-list">
                <li class="nav-item nav-icon dropdown">
                   <a href="#" class="search-toggle iq-waves-effect bg-primary rounded">
                      <i class="ri-add-line"></i>
                      
                   </a>
                   <div class="iq-sub-dropdown" style="width: 150px;">
                      <div class="iq-card shadow-none m-0">
                         <div class="iq-card-body p-0 ">

                            <a href="{{ route('mycourse.create') }}" class="iq-sub-card">
                            
                                     <h6 class="mb-0 ">Join course</h6>
                                   
                            </a>
                            <a href="{{ route('course.create') }}" class="iq-sub-card">
                              <h6 class="mb-0 ">Create a course</h6>
                            </a>
                         </div>
                      </div>
                   </div>
                </li>
             </ul>
          </div>
          <ul class="navbar-list">
             <li class="line-height">
                <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                   <img src={{$user->image ? asset('storage/'.$user->image) : asset('images/user/user.png') }} class="img-fluid rounded mr-3" style="border:2px solid #1E3D73" alt="user">
                   
                </a>
                <div class="iq-sub-dropdown iq-user-dropdown">
                   <div class="iq-card shadow-none m-0">
                      <div class="iq-card-body p-0 ">
                         <div class="bg-primary p-3">
                            <h5 class="mb-0 text-white line-height">Hello {{ $user->name }}</h5>
                         </div>
                         <a href="{{ route('profile.index') }}" class="iq-sub-card iq-bg-primary-hover">
                            <div class="media align-items-center">
                               <div class="rounded iq-card-icon iq-bg-primary">
                                  <i class="ri-file-user-line"></i>
                               </div>
                               <div class="media-body ml-3">
                                  <h6 class="mb-0 ">My Profile</h6>
                                  <p class="mb-0 font-size-12">View personal profile details.</p>
                               </div>
                            </div>
                         </a>
                         <a href="{{ route('password.edit',$user->id) }}" class="iq-sub-card iq-bg-primary-hover">
                            <div class="media align-items-center">
                               <div class="rounded iq-card-icon iq-bg-primary">
                                  <i class="ri-profile-line"></i>
                               </div>
                               <div class="media-body ml-3">
                                  <h6 class="mb-0 ">Change Password</h6>
                                  <p class="mb-0 font-size-12">Change your password.</p>
                               </div>
                            </div>
                         </a>

                         <div class="d-inline-block w-100 text-center p-3">
                           <form action="{{ route('logout') }}" method="post">
                              @csrf
                              <button type="submit" class="bg-primary iq-sign-btn">Logout<i class="ri-login-box-line ml-1"></i></button>
                            </form>  
                         </div>

                         

                      </div>
                   </div>
                </div>
             </li>
          </ul>
       </nav>
    </div>
 </div>