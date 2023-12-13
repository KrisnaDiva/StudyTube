@extends('layouts.main')
@section('title','Join a Course')
@section('container')
<div class="row justify-content-center">
   <div class="col-lg-12">
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
               <h4 class="card-title">Join a Course</h4>
            </div>
         </div>
         <div class="iq-card-body">
     
            <form action="{{ route('mycourse.store') }}" method="post" >
             @csrf
             <div class="form-group">
              <label for="code">Course Code</label>
              <input type="text" class="form-control mb-0 @error('code') is-invalid @enderror" id="code" name="code" placeholder="Type Course code"value="{{ old('code') }}">
              @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
             </div>
     
     
               <button type="submit" class="btn btn-primary">Create</button>
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