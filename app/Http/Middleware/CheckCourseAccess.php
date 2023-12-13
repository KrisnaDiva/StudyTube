<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCourseAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $courseId = $request->route('course'); // pastikan ini adalah parameter yang tepat dari URL
        $user = Auth::user();

        if ($user->id != $courseId->teacher->id) {
            // Jika ID pengguna terautentikasi tidak sama dengan ID pengajar kursus
            return abort(404);
        }

        return $next($request);
    }
    }

