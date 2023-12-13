
@extends('layouts.main')
@section('title','Profile')
@section('container')

      <div class="row justify-content-center">
       
         <div class="col-lg-8">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" style="color:black">x</span>
                </button>
            </div>
            @endif
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Personal Data</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <p class="m-0"><a href="{{ route('profile.edit',$user->id) }}"> Edit </a></p>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="row ">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <img src={{$user->image ? asset('storage/'.$user->image) : asset('images/user/user.png') }} style="width:20%" class="img-fluid rounded mr-3"  alt="user">
                     </div>
                     <div class="col-lg-12 ">
                        <p class="text-center">Nama : {{ $user->name }}</p>
                        <p class="text-center">Email : {{ $user->email }}</p>
                       
                     </div>

                  </div>
               </div>
            </div>
         </div>
     
         
      </div>

@endsection