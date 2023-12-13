@extends('layouts.main')
@section('title','Home')
@section('container')

@if($user->mycourses()->get()->isEmpty()&&$user->courses->isEmpty())
<h1 class="text-center align-middle">You Dont have any course,Create/Join Course Now</h1>
@endif
<div class="row">
   <div class="col-lg-12">
      @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" style="color:black">x</span>
                </button>
            </div>
            @endif   
   </div>
   @if ($user->courses->count())
   <h4 class="col-12 mb-3">Teach</h4>
   @endif
  
   @foreach ($user->courses as $course)
   <div class="col-lg-4 ">
      <div class="card iq-mb-3 border border-primary">
         <div class="card-header">
            <div class="row">
               <div class="col-10 mb-3">
                  <p style="margin-bottom:-5px">{{ $course->name }}</p>
                  <small >{{ $course->subject }}</small>
               </div>
               <div class="col-2">
                  <div class="row">
                  <a href="{{ route('course.edit',$course->id) }}" class="badge bg-primary d-flex align-items-center mx-2"><i class="ri-pencil-line "></i></a>
                  <form action="{{ route('course.destroy',$course->id) }}" method="POST">
                     @method('delete')
                     @csrf
                     <button  class="badge bg-danger" ><i class="ri-delete-bin-line "></i></button>
                 </form>
               </div>
               </div>
            </div>
            <small><b>{{ $course->students()->count() }} Students</b></small> <br>
         </div>
         <div class="card-body">
            <img src={{$course->teacher->image ? asset('storage/'.$course->teacher->image) : asset('images/user/user.png') }} style="width:20%;margin-top:-60px;" class="img-fluid rounded float-right border border-primary"  alt="user" >
            <a href="{{ route('course.show',$course->id) }}" class="btn btn-primary mt-4">View</a>
         </div>
      </div>
   </div>
   @endforeach
   @if ($user->mycourses()->get()->count())
   <h4 class="col-12 mb-3">Registered</h4>
   @endif
  
   @foreach ($user->mycourses()->get() as $course)
   <div class="col-lg-4 ">
      <div class="card iq-mb-3 border border-primary">
         <div class="card-header">
            <div class="row mb-3">
               <div class="col-10">
                  <p style="margin-bottom:-5px">{{ $course->name }}</p>
                  <small >{{ $course->subject }}</small>
               </div>
               <div class="col-2">
                  <form action="{{ route('mycourse.destroy',$course->id) }}" method="POST">
                     @method('delete')
                     @csrf
                     <button  class="badge bg-danger" >Leave<i class="ri-arrow-right-line"></i></button>
                 </form>
               </div>
            </div>
            <small><b>{{ $course->teacher->name }}</b></small> <br>
         </div>
         <div class="card-body">
            
            <img src={{$course->teacher->image ? asset('storage/'.$course->teacher->image) : asset('images/user/user.png') }} style="width:20%;margin-top:-50px;" class="img-fluid rounded float-right border border-primary"  alt="user" >
            
            <a href="{{ route('course.show',$course->id) }}" class="btn btn-primary mt-4">View</a>
         </div>
      </div>
   </div>
   @endforeach
</div>
@endsection