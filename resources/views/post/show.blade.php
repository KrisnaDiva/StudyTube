@extends('layouts.main')
@section('title','Class')
@section('container')
<div class="row justify-content-center">     
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
                    
                        <div class="col-lg-12">
                            <h1>{{ $link->title }}</h1>
                            <iframe id="videoIframe" style="width: 100%; height:100vh" src="{{ $link->url }}" title="YouTube video" allowfullscreen></iframe>
                      </div>
                     
              
                    
                        
                    @endforeach
                    
                </div>
             </div>
             </div>
            
          </div>
        
     </div>
</div>
<hr class="border border-dark">
    <u> @if ($post->comments->count()>0)
        {{ $post->comments->count() }}
        @if ($post->comments->count()==1)
         Comment
         @else
         Comments
        @endif
        @else
        Comments
        @endif</u>  

<div class="comment mb-5 mt-3">
    @foreach ($post->comments as $comment)
    <div class="row  " >
    <div class="col-md-1 col-2 d-flex align-items-center justify-content-end">
        <img src={{$comment->user->image ? asset('storage/'.$comment->user->image) : asset('images/user/user.png') }} class="img-fluid rounded mr-3" style="border:2px solid #1E3D73;height:50px" alt="user">
    </div> 
    <div class="col-md-10 col-8">
        <div class="row align-items-center justify-content-between">
          <b class="text-dark">{{ $comment->user->name }} 
            <small class="text-muted mx-1">
            @if ($comment->created_at->diffInDays()>0)
            {{ $comment->created_at->format('d-M-Y') }}
            @else
            {{ $comment->created_at->format('H:i') }}
            @endif
            @if ($comment->created_at!=$comment->updated_at)
            &#40; edited
                @if ($comment->updated_at->diffInDays()>0)
                {{$comment->updated_at->format('d-M-Y')}}
                @else
                {{$comment->updated_at->format('H:i')}}
                @endif &#41;
            @endif</small></b>     
        </div>
        <div class="row align-items-center ">
            <form action="{{ route('comment.update',['course'=>$post->course_id,'post'=>$post->id,'comment'=>$comment->id]) }}" style="width: 100%" method="post">
                @method('put')
                @csrf
            <input class="text-dark form-control bg-light" name="body"  id="comment-{{ $comment->id }}" style="padding: 0 ;border:0px" value=" {{ $comment->body }}" disabled>
            <div style="display: none" id="button-{{ $comment->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn iq-bg-danger" onclick="disableInput({{ $comment->id }})">Cancel</button>
            </div>
        </form>
        <small class="mx-1 font-weight-bold" onclick="reply({{ $comment->id }})" style="cursor: pointer">Balas</small>
        @if ($comment->replies->count())
        <small id="show-{{ $comment->id }}" class="mx-3" style="cursor: pointer" onclick="seeReply({{ $comment->id }})">LIhat {{ $comment->replies->count() }} Balasan</small>
        <small id="hide-{{ $comment->id }}" class="mx-3"style="cursor: pointer;display:none" onclick="hideReply({{ $comment->id }})">Sembunyikan Balasan</small>
        @endif
       
        </div>
    </div>
    <div class="col-md-1 col-2 d-flex justify-content-end">
        @if ($comment->user_id==Auth::id())
            <div class="text-nowrap">
                <button  class="badge bg-primary" onclick="enableInput({{ $comment->id }})"><i class="ri-pencil-line "></i></button>
                <form action="{{ route('comment.destroy',['course'=>$post->course_id,'post'=>$post->id,'comment'=>$comment->id]) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button  class="badge bg-danger" ><i class="ri-delete-bin-line "></i></button>
                </form>
            </div>
        @endif
    </div>
    
   
</div>
<div style="display: none" id="replies-{{ $comment->id }}">
    @foreach ($comment->replies as $reply)
<div class="row justify-content-end">
    
<div class="col-md-11 col-10">
    <hr class="border border-dark">
    <div class="row">
        <b class="text-dark mx-3">{{ $reply->user->name }} 
            <small class="text-muted mx-1">
            @if ($reply->created_at->diffInDays()>0)
            {{ $reply->created_at->format('d-M-Y') }}
            @else
            {{ $reply->created_at->format('H:i') }}
            @endif
            @if ($reply->created_at!=$reply->updated_at)
            &#40; edited
                @if ($reply->updated_at->diffInDays()>0)
                {{$reply->updated_at->format('d-M-Y')}}
                @else
                {{$reply->updated_at->format('H:i')}}
                @endif &#41;
            @endif</small></b>   
    </div>
<div class="row">
 <div class="col-md-1 col-2">
    <img src={{$reply->user->image ? asset('storage/'.$reply->user->image) : asset('images/user/user.png') }} class="img-fluid rounded mx-3" style="border:2px solid #1E3D73;height:50px" alt="user">
 </div>
 

    <div class="col-md-10 col-8">
        <form action="{{ route('reply.update',['course'=>$post->course_id,'post'=>$post->id,'comment'=>$comment->id,'reply'=>$reply->id]) }}" style="width: 100%" method="post">
            @method('put')
            @csrf
        <input class="text-dark form-control bg-light" name="body"  id="r-{{ $reply->id }}" style="padding: 0 ;border:0px" value=" {{ $reply->body }}" disabled>
        <div style="display: none" id="btn-{{ $reply->id }}">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn iq-bg-danger" onclick="disableReplyInput({{ $reply->id }})">Cancel</button>
        </div>
    </form>
    </div>
    <div class="col-md-1 col-2 d-flex justify-content-end">
        @if ($reply->user_id==Auth::id())
            <div class="text-nowrap">
                <button  class="badge bg-primary" onclick="enableReplyInput({{ $reply->id }})"><i class="ri-pencil-line "></i></button>
                <form action="{{ route('reply.destroy',['course'=>$post->course_id,'post'=>$post->id,'comment'=>$comment->id,'reply'=>$reply->id]) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button  class="badge bg-danger" ><i class="ri-delete-bin-line "></i></button>
                </form>
            </div>
        @endif
    </div>
</div>
    
   
</div>
</div>

@endforeach

</div>
<div class="row justify-content-end " >

    <div class=" col-md-11 mt-4 col-10" style="display: none" id="reply-{{ $comment->id }}">
        <form action="{{ route('reply.store',['course'=>$post->course_id,'post'=>$post->id,'comment'=>$comment->id]) }}" method="post">
            @csrf
            <div class="row ">
                <small style="position: absolute; left:0.5%; top:-15%; cursor: pointer" class="font-weight-bold" onclick="disableReply({{ $comment->id }})">x</small>
            <div class="form-group col-md-11  col-10">
                
               <input type="body" class="form-control border border-secondary" id="body" name="body" placeholder="Tambahkan Balasan...">
            </div>
            <div class="col-md-1  col-2 ">
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
         </form>
         
    </div>
    
</div>

<hr class="border border-dark">
    @endforeach
</div>

<div class="row">
    <div class="col-md-1  col-2 d-flex justify-content-end">
        <img src={{$user->image ? asset('storage/'.$user->image) : asset('images/user/user.png') }} class="img-fluid rounded mr-3" style="border:2px solid #1E3D73;height:50px" alt="user">
    </div>
    <div class="col-md-11  col-10">
        <form action="{{ route('comment.store',['course'=>$post->course_id,'post'=>$post->id]) }}" method="post">
            @csrf
            <div class="row ">
            <div class="form-group col-md-11  col-8">
               <input type="body" class="form-control border border-secondary" id="body" name="body" placeholder="Tambahkan Komentar...">
            </div>
            <div class="col-md-1  col-4 ">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
         </form>
    </div>
</div>
<script>
    function enableInput(commentId) {
        var inputField = document.getElementById('comment-' + commentId);
        inputField.disabled = false;
        inputField.style.border='1px solid black'
        var buttonGroup = document.getElementById('button-' + commentId);
        buttonGroup.style.display='block'
    }
    function disableInput(commentId) {
        var inputField = document.getElementById('comment-' + commentId);
        inputField.disabled = true;
        inputField.style.border='0px'
        var buttonGroup = document.getElementById('button-' + commentId);
        buttonGroup.style.display='none'
    }
    function enableReplyInput(replyId) {
        var inputField = document.getElementById('r-' + replyId);
        inputField.disabled = false;
        inputField.style.border='1px solid black'
        var buttonGroup = document.getElementById('btn-' + replyId);
        buttonGroup.style.display='block'
    }
    function disableReplyInput(replyId) {
        var inputField = document.getElementById('r-' + replyId);
        inputField.disabled = true;
        inputField.style.border='0px'
        var buttonGroup = document.getElementById('btn-' + replyId);
        buttonGroup.style.display='none'
    }
    function reply(commentId) {
        var replyGroup = document.getElementById('reply-' + commentId);
        replyGroup.style.display='block'
    }
    function seeReply(commentId) {
        var replyGroup = document.getElementById('replies-' + commentId);
        replyGroup.style.display='block'
        document.getElementById('hide-' + commentId).style.display='block'
        document.getElementById('show-' + commentId).style.display='none'
    }
    function hideReply(commentId) {
        var replyGroup = document.getElementById('replies-' + commentId);
        replyGroup.style.display='none'
        document.getElementById('hide-' + commentId).style.display='none'
        document.getElementById('show-' + commentId).style.display='block'
    }
    function disableReply(commentId) {
        var replyGroup = document.getElementById('reply-' + commentId);
        replyGroup.style.display='none'
    }
</script>
@endsection