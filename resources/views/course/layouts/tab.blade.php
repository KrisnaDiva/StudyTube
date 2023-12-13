    <ul class="nav nav-tabs justify-content-center mt-n4" id="myTab-2" role="tablist">
          <li class="nav-item">
             <a class="nav-link {{ Route::currentRouteName()=='course.show'?'active' : ''}} "  href="{{ route('course.show',$course->id) }}" role="tab" aria-controls="home" aria-selected="true">Forum</a>
          </li>
          <li class="nav-item ">
             <a class="nav-link {{ Route::currentRouteName()=='course.showperson'?'active' : ''}}"  href="{{ route('course.showperson',$course->id) }}" role="tab" aria-controls="profile" aria-selected="false">Person</a>
   
          </li>
       </ul>
