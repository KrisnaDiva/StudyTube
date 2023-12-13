@extends('layouts.main')
@section('title','Edit Profile')
@section('container')
<div class="row justify-content-center">
   <div class="col-lg-12">
      <div class="iq-card">
         <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
               <h4 class="card-title">Edit Profile</h4>
            </div>
         </div>
         <div class="iq-card-body">
            <form action="{{ route('profile.update',$user->id) }}" method="post" enctype="multipart/form-data">
             @method('PUT')
             @csrf
               <div class="form-group">
                  <label for="image">Profile Image:</label>
                  <br>
                  @if ($user->image)
                  <img src="{{ asset('storage/'.$user->image) }}" class="img-preview img-fluid rounded" style="width: 10%">
                  @else
                  <img class="img-preview img-fluid rounded" style="width: 10%">
                  @endif
                  <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ $user->image }}" onchange="previewImage()">
                  @error('image')
                 <div class="invalid-feedback">
                   {{ $message }}
                 </div>
                 @enderror
               </div>
               <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name',$user->name)  }}">
                  @error('name')
                 <div class="invalid-feedback">
                   {{ $message }}
                 </div>
                 @enderror
               </div>
               <div class="form-group">
                  <label for="email">Email address:</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$user->email) }}">
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
               </div>
     
               <button type="submit" class="btn btn-primary">Update</button>
               <a href="{{ route('profile.index') }}"class="btn iq-bg-danger">Cancel</a>
               
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