<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPostAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $postId = $request->route('post'); // pastikan ini adalah parameter yang tepat dari URL
        $linkId = $request->route('link'); // pastikan ini adalah parameter yang tepat dari URL
        $user = Auth::user();

        if ($linkId->post_id != $postId) {
            // Jika ID pengguna terautentikasi tidak sama dengan ID pengajar kursus
            return abort(404);
        }

        return $next($request);
    }
}
