<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Link;
use App\Models\Mycourse;
use App\Models\Post;
use App\Models\Reply;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $user=auth()->user();
        return view('course.create',[
            'user'=>$user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'name'=>'required|max:255',
            'subject'=>'required|max:255'
        ]);
        $validatedData['user_id']=Auth::id();
        Course::create($validatedData);
        return redirect()->route('home')->with('success','New Course Have Been Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $this->authorize('view', $course);
        $user=auth()->user();
        return view('course.show',[
            'user'=>$user,
            'course'=>$course
        ]);
    }
    public function showperson(Course $course)
    {
        $this->authorize('view', $course);
        $user=auth()->user();
        return view('course.person.index',[
            'user'=>$user,
            'course'=>$course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $this->authorize('update', $course);   
        $user=auth()->user();
        return view('course.edit',[
            'user'=>$user,
            'course'=>$course
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);   
        $validatedData=$request->validate([
            'name'=>'required|max:255',
            'subject'=>'required|max:255'
        ]);
        
        $course->update($validatedData);
        return redirect()->route('home')->with('success','Course Has Been Edited');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course){
        $this->authorize('delete', $course);   
        try {
            DB::beginTransaction();
            foreach ($course->posts as $post) {  
                foreach ($post->comments as $comment) {
                    foreach ($comment->replies as $reply) {
                       Reply::destroy($reply->id);
                    }
                    Comment::destroy($comment->id);
                }
                foreach ($post->links as $link) {
                    Link::destroy($link->id);
                }
                Post::destroy($post->id);
            }
            foreach ($course->students()->get() as $student) {
                $course->students()->detach();
            }    
        
                Course::destroy($course->id);
            DB::commit();
        } catch (QueryException $error) {
            DB::rollBack();
        }       
        return redirect()->route('home')->with('success','Course Has Been Deleted');
    }
}
