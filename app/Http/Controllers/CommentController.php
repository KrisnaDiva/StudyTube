<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Course;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request,Course $course,Post $post)
    {
        $this->authorize('view', $course);
        $validatedData=$request->validate([
            'body'=>'required|max:255'
        ]);
        $validatedData['user_id']=Auth::id();
        $validatedData['post_id']=$post->id;
        Comment::create($validatedData);
        return redirect()->route('post.show',['course'=>$course->id,'post'=>$post->id]);
    }
    public function update(Request $request,Course $course, Post $post,Comment $comment)
    {
        $this->authorize('update', $comment);
        $validatedData=$request->validate([
            'body'=>'required|max:255'
        ]);
        
        $comment->update($validatedData);
        return redirect()->route('post.show',['course'=>$course->id,'post'=>$post->id]);
    }
    public function destroy(Course $course,Post $post,Comment $comment){
        $this->authorize('delete', $comment);
        foreach ($comment->replies as $reply) {   
            Reply::destroy($reply->id);
        }
        Comment::destroy($comment->id);
        return redirect()->route('post.show',['course'=>$course->id,'post'=>$post->id]);
    }
}
