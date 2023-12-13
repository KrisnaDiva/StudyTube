@extends('layouts.main')
@section('title','Create a Course')
@section('container')
<div class="row justify-content-center">
   <div class="col-lg-12">
      <div class="iq-card">
         <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
               <h4 class="card-title">Edit Course</h4>
            </div>
         </div>
         <div class="iq-card-body">
     
            <form action="{{ route('course.update',$course->id) }}" method="post" >
               @method('put')
             @csrf
             <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control mb-0 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Type Course Name" value="{{ old('name',$course->name) }}">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
             </div>
             <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" class="form-control mb-0 @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Type Course Subject"value="{{ old('subject',$course->subject) }}">
              @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
             </div>
     
     
               <button type="submit" class="btn btn-primary">Update</button>
               <a href="{{ route('home') }}"class="btn iq-bg-danger">Cancel</a>
               
            </form>
         </div>
      </div>
   </div>
</div>

 <script>
    function previewImage(){
    const image=document.querySelector('#image');
    const imgPreview=document.querySelector('.img-preview');
    
    imgPreview.style.display='block';

    const oFReader=new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent){
      imgPreview.src=oFREvent.target.result; 
    }
}
 </script>
@endsection