<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckReplyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $replyId = $request->route('reply'); // pastikan ini adalah parameter yang tepat dari URL
        $user = Auth::user();

        if ($user->id != $replyId->user->id) {
            // Jika ID pengguna terautentikasi tidak sama dengan ID pengajar kursus
            return abort(404);
        }

        return $next($request);
    }
}
