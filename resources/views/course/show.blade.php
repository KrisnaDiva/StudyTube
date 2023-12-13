@extends('layouts.main')
@section('title','Class')
@section('container')
@include('course.layouts.tab')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card iq-mb-3 border border-primary">
           <div class="card-body">
            <div class="col-12 d-flex justify-content-between mb-5">
                <small>Course Code : {{ $course->code }}</small>
                @if ($course->teacher->id==Auth::id())
                <div class="row">
                    <a href="{{ route('course.edit',$course->id) }}" class="badge bg-primary d-flex align-items-center mx-2"><i class="ri-pencil-line "></i></a>
                    <form action="{{ route('course.destroy',$course->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button  class="badge bg-danger" ><i class="ri-delete-bin-line \"></i></button>
                    </form>
                </div>
              
                @endif
            </div>
            <div class="col-12">
                <h4 class="card-title">{{ $course->name }}</h4>
            </div>
                <div class="col-12 d-flex justify-content-between align-items-end">
                    <p class="card-text">{{ $course->subject }}</p>
                    <a class="button" data-toggle="popover" data-trigger="hover" data-content="Crated At : {{ date('d-m-Y') }}"><i class="ri-information-line"></i></a>
                </div>
                
           </div>
        </div>    
        <div class="col-12 d-flex justify-content-end mb-5">
            <a href="{{ route('post.create',$course->id) }}" class="btn btn-primary">Create New Post</a>
        </div>
        <div class="col-lg-12">
            @if (session()->has('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="color:black">x</span>
                      </button>
                  </div>
                  @endif   
         </div>
     </div>
     @foreach ($course->posts->sortByDesc('created_at') as $post)
        
     <div class="col-lg-12">
     
         <div class="card iq-mb-3 border border-primary myBox">
             <div class="card-header">
                <div class="col-lg-12 d-flex justify-content-between">
                    <p>{{ $post->user->name }} - 
                        @if ($post->course->user_id==$post->user_id)
                        <small class="text-danger"> Teacher </small> 
                        @else
                        <small class=""> Student </small> 
                        @endif   
                     </p>    
                     @if ($post->user_id==Auth::id())
                     <div class="text-nowrap">
                         <a href="{{ route('post.edit',['course'=>$post->course_id,'post'=>$post->id] )}}" class="badge bg-primary"><i class="ri-pencil-line "></i></a>
                         <form action="{{ route('post.destroy',['course'=>$post->course_id,'post'=>$post->id]) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button  class="badge bg-danger" ><i class="ri-delete-bin-line "></i></button>
                        </form>
                     </div>
                 @endif
                </div>
             <div class="col-lg-12">
                <p class="text-muted">
                @if ($post->created_at->diffInDays()>0)
                {{ $post->created_at->format('d-M-Y') }}
                @else
                {{ $post->created_at->format('H:i') }}
                @endif
                @if ($post->created_at!=$post->updated_at)
                &#40; edited
                    @if ($post->updated_at->diffInDays()>0)
                    {{$post->updated_at->format('d-M-Y')}}
                    @else
                    {{$post->updated_at->format('H:i')}}
                    @endif &#41;
                @endif
               </p>
             </div>
                
             </div>
             <div class="card-body">
                <h4 class="card-title">{{ $post->title }}</h4>
                <p class="card-text">{!! $post->body !!}</p>
                <div class="row justify-content-center">
                    @foreach ($post->links as $link)
                    <div class="col-4">
                        <a href="{{ route('post.show',['course'=>$post->course_id,'post'=>$post->id]) }}" class="d-inline-block" style="border:1px solid black;padding:50px 160px">
                            <i class="ri-play-line"></i>
                            {{ $link->title }}
                        </a>
                    </div>
                    @endforeach
                    
                </div>
             </div>
             <div class="card-footer d-flex justify-content-between">
                <span>
                @if ($post->comments->count()>0)
                {{ $post->comments->count() }}
                @if ($post->comments->count()==1)
                 Comment
                 @else
                 Comments
                @endif
                @endif
            </span>
                <a href="{{ route('post.show',['course'=>$post->course_id,'post'=>$post->id]) }}" class="btn btn-primary float-right">See</a>
             </div>
          </div>
        
     </div>
 
     @endforeach
</div>

@endsection