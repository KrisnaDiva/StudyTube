<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Link;
use App\Models\Post;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function destroy(Course $course,Post $post,Link $link){
        $this->authorize('link', [$post,$link]); 
        Link::destroy($link->id);
        $user=auth()->user();
        return view('post.edit',[
            'user'=>$user,
            'post'=>$post,
            'course'=>$course,
        ])->with('success','Link Has Been Deleted!');
    }
}
