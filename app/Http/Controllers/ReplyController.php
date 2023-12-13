<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request,Course $course,Post $post,Comment $comment)
    {
        $this->authorize('view', $course);
        $validatedData=$request->validate([
            'body'=>'required|max:255'
        ]);
        $validatedData['user_id']=Auth::id();
        $validatedData['comment_id']=$comment->id;
        Reply::create($validatedData);
        return redirect()->route('post.show',['course'=>$course->id,'post'=>$post->id]);
    }
    public function update(Request $request,Course $course,Post $post,Comment $comment,Reply $reply)
    {
        $this->authorize('update', $reply);
        $validatedData=$request->validate([
            'body'=>'required|max:255'
        ]);
        
        $reply->update($validatedData);
        return redirect()->route('post.show',['course'=>$course->id,'post'=>$post->id]);
    }
    public function destroy(Course $course,Post $post,Comment $comment,Reply $reply){
        $this->authorize('delete', $reply);
        Reply::destroy($reply->id);
        return redirect()->route('post.show',['course'=>$course->id,'post'=>$post->id]);
    }
}

