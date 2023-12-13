@extends('layouts.main')
@section('title','Class Person')
@section('container')
@include('course.layouts.tab')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <ul class="list-group list-group-flush">
            <li class="list-group-item iq-secondary" style="border-bottom:2px solid #1E3D73"><h3>Teacher</h3></li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-lg-1">
                        <img src={{$course->teacher->image ? asset('storage/'.$course->teacher->image) : asset('images/user/user.png') }} class="img-fluid rounded mr-3" style="border:2px solid #1E3D73;height:50px" alt="user">
                    </div>
                    <div class="col lg-11 d-flex align-items-center">
                        <h4>{{ $course->teacher->name }}</h4>
                    </div>
                </div>
                </li>
         </ul>
        <ul class="list-group list-group-flush mt-5">
            <li class="list-group-item iq-secondary" style="border-bottom:2px solid #1E3D73"><h3>Students</h3></li>

            @foreach ($course->students()->get() as $student)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-lg-1">
                        <img src={{$student->image ? asset('storage/'.$student->image) : asset('images/user/user.png') }} class="img-fluid rounded mr-3" style="border:2px solid #1E3D73;height:50px" alt="user">
                    </div>
                    <div class="col lg-11 d-flex align-items-center">
                        <h4>{{ $student->name }}</h4>
                    </div>
                </div>
                </li>
                
            @endforeach
         </ul>
     </div>
</div>
@endsection