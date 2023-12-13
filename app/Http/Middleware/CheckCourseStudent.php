<?php

namespace App\Http\Middleware;

use App\Models\Mycourse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCourseStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $courseId = $request->route('course');
        $user = Auth::user();
        $cek=Mycourse::where('user_id', $user->id)->where('course_id',$courseId->id)->firstOrFail();
        if (!$cek){
           
            return abort(404);
        }
    
        return $next($request);
    }
}
