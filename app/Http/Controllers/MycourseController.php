<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mycourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MycourseController extends Controller
{
    public function create()
    {
        $user=auth()->user();
        return view('mycourse.create',[
            'user'=>$user
        ]);
    }
    public function store(Request $request)
    {
        $course=Course::where('code', $request->code)->first();
        
        $request->validate([
            'code'=>'required|between:6,8',
        ]);
        if($course!=null){
            $mycourse=Mycourse::where('user_id', Auth::id())->where('course_id',$course->id)->first();
            if($course->teacher->id!=Auth::id()){
                if($mycourse==null){
                    $course->students()->attach(Auth::id());
                    return redirect()->route('home')->with('success','Successfully Joined The Course');
                }
                else{
                    return redirect()->route('mycourse.create')->with('error','You Already Joined This Course');
                }
            }
            else{
                return redirect()->route('mycourse.create')->with('error',"Unable To Join Course");
            }
        }
        else{
            return redirect()->route('mycourse.create')->with('error',"Course Code Not Found");
        }
       
    }
    public function destroy(Course $course){
        $this->authorize('view', $course); 
        $course->students()->attach(Auth::id());
        return redirect()->route('home')->with('success','You Have Left Course');
    }
}
