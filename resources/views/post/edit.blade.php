@extends('layouts.main')
@section('title','Edit a Post')
@section('container')
<div class="row justify-content-center">
   <div class="col-lg-12">
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
               <h4 class="card-title">Edit a Post</h4>
            </div>
         </div>
         <div class="iq-card-body">
     
            <form action="{{ route('post.update',['post'=>$post->id,'course'=>$course]) }}" method="post" >
                @method('put')
             @csrf
             <button type="submit" class="btn btn-primary" style="position: absolute;right:3%;top:3%">Edit</button>
             <a href="{{ route('course.show',$course->id) }}"class="btn iq-bg-danger" style="position: absolute;right:7%;top:3%">Cancel</a>
             <div class="form-group">
              <label for="title">title</label>
              <input type="text" class="form-control mb-0 @error('title') is-invalid @enderror" id="title" name="title" placeholder="Type Post title"value="{{ old('title',$post->title) }}">
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
             </div>
             

             <div class="form-group">
               <label for="body" >Body</label>
             @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
               <input id="body" type="hidden" name="body" value="{{ old('body',$post->body) }}">
               <trix-editor input="body"></trix-editor>
             </div>
             
             <div class="row" id="divurl" name="link">
               @foreach ($post->links as $link)
               <div class="col-10">
                  <input type="text" class="form-control" placeholder="Enter title " value="{{ $link->title }}" readonly>
                  <input type="text" class="form-control"  placeholder="Enter link " value="{{ $link->url }}" readonly>
               </div>
               <div  class="col-2">
                  @if ($loop->iteration=1)
                  <form></form>
                  @endif
                  <form method="post" action="{{ route('link.destroy',['course'=>$course,'post'=>$post->id,'link'=>$link->id]) }}" >
                     @method('delete')
                     @csrf
                  <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                  
               </div>
               @endforeach
               
             </div>
         
             <div class="row mb-3">
               <div class="col-12">
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                     Add video link
                     </button>
                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalCenterTitle">Video Link</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <input type="text" class="form-control" id="modaltitle" placeholder="Type Video Title Here">
                                 <input type="text" class="form-control" id="modallink" placeholder="Type Video Link Here">
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="createlink()">Add</button>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
             </div>

              
              
            </form>

         </div>
      </div>
   </div>
</div>

<script>
   var number = 1;
   function createlink() {
     var modallink = document.getElementById('modallink');
     var modalTitle = document.getElementById('modaltitle');
     var selectsDiv = document.getElementById("divurl");

     var input = document.createElement("input");
     input.setAttribute("type", "text");
     input.setAttribute("class", "form-control");
     input.setAttribute("name", "link" + number);
     input.setAttribute("id", "link" + number);
     input.setAttribute("placeholder", "Enter link ");
     if(modallink.value.substr(0, 8)!="https://"){
      input.value="https://"+modallink.value;
     }else{
      input.value=modallink.value;
     }
     modallink.value='';
     
     var inputTitle = document.createElement("input");
     inputTitle.setAttribute("type", "text");
     inputTitle.setAttribute("class", "form-control");
     inputTitle.setAttribute("name", "title" + number);
     inputTitle.setAttribute("id", "title" + number);
     inputTitle.setAttribute("placeholder", "Enter title ");
     inputTitle.value=modalTitle.value;
     modalTitle.value='';
     
     var newDiv = document.createElement("div");
     newDiv.setAttribute("name", "div" + number);
     newDiv.setAttribute("id", "div" + number);
     newDiv.setAttribute("class", "col-10");
     newDiv.appendChild(inputTitle);
     newDiv.appendChild(input);

     var newDivx = document.createElement("span");
     newDivx.setAttribute("name", "divx" + number);
     newDivx.setAttribute("id", "divx" + number);
     newDivx.setAttribute("class", "col-2");

     var button=document.createElement("button");
     button.setAttribute("name", "btn" + number);
     button.setAttribute("id", "btn" + number);
     button.setAttribute("class", "btn btn-danger");
     button.innerText="Delete";
     button.addEventListener("click", function () {
        selectsDiv.removeChild(newDiv);
        selectsDiv.removeChild(newDivx);
    });
     newDivx.appendChild(button);

     selectsDiv.appendChild(newDiv);
     selectsDiv.appendChild(newDivx);
     number++;
 }
   </script>
 

@endsection