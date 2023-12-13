@extends('layouts.main')
@section('title','Edit Password')
@section('container')
<div class="row justify-content-center">
   <div class="col-lg-12">
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" style="color:black">x</span>
                </button>
      </div>
      @endif
      @if (session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" style="color:black">x</span>
                </button>
      </div>
      @endif
      <div class="iq-card">
         <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
               <h4 class="card-title">Edit Password</h4>
            </div>
         </div>
         <div class="iq-card-body">
     
            <form action="{{ route('password.update',$user->id) }}" method="post" >
             @method('PUT')
             @csrf
             <div class="form-group">
              <label for="old">Old Password</label>
              <input type="text" class="form-control mb-0 @error('old') is-invalid @enderror" id="old" name="old" placeholder="Type Old Password">
              @error('old')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
             </div>
             <div class="form-group">
              <label for="password">New Password</label>
              <input type="text" class="form-control mb-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Type New Password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
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