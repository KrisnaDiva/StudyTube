<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Link;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $this->authorize('view', $course);
        $user=auth()->user();
        return view('post.create',[
            'user'=>$user,
            'course'=>$course
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Course $course)
    {
        $this->authorize('view', $course);     
        $validatedData=$request->validate([
            'title'=>'required|max:255',
            'body'=>'required'
        ]);
        $validatedData['user_id']=Auth::id();
        $validatedData['course_id']=$course->id;
        $post=Post::create($validatedData);

     
    $linkInputs = array_filter($request->input(), function ($key) {
        return strpos($key, 'link') === 0;
    }, ARRAY_FILTER_USE_KEY);

    foreach ($linkInputs as $key => $linkValue) {
        $index = substr($key, 4);
        $linkName = 'link' . $index;
        $titleName = 'title' . $index;
        Link::create([
            'post_id'=>$post->id,
            'url'=>$request->$linkName,
            'title'=>$request->$titleName,
        ]);
    }

        return redirect()->route('course.show',$course->id)->with('success','New Post Have Been Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course,Post $post)
    {
        $this->authorize('view', $course);
        $user=auth()->user();
        return view('post.show',[
            'user'=>$user,
            'post'=>$post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course,Post $post)
    {
        $this->authorize('update', $post); 
        $user=auth()->user();
        return view('post.edit',[
            'user'=>$user,
            'post'=>$post,
            'course'=>$course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    //routenya course dulu baru post jadi urutannya begitu
    public function update(Request $request,Course $course, Post $post)
    {
        $this->authorize('update', $post); 
        $validatedData=$request->validate([
            'title'=>'required|max:255',
            'body'=>'required'
        ]);
        
        $post->update($validatedData);    

        $linkInputs = array_filter($request->input(), function ($key) {
            return strpos($key, 'link') === 0;
        }, ARRAY_FILTER_USE_KEY);
    
        foreach ($linkInputs as $key => $linkValue) {
            $index = substr($key, 4);
            $linkName = 'link' . $index;
            $titleName = 'title' . $index;
            Link::create([
                'post_id'=>$post->id,
                'url'=>$request->$linkName,
                'title'=>$request->$titleName,
            ]);
        }
        return redirect()->route('course.show',$course->id)->with('success','Post Has Been Edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course,Post $post){
        $this->authorize('delete', $post); 
        foreach ($post->comments as $comment) {
            foreach ($comment->replies as $reply) {
               Reply::destroy($reply->id);
            }
            Comment::destroy($comment->id);
        }
        foreach ($post->links as $link) {
            Link::destroy($link->id);
        }
       
        return redirect()->route('course.show',$course->id)->with('success','Post Has Been Deleted');
    }
}
