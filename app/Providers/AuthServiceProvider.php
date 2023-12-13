<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Post;
use App\Models\Reply;
use App\Policies\CommentPolicy;
use App\Policies\CoursePolicy;
use App\Policies\PostPolicy;
use App\Policies\ReplyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Reply::class => ReplyPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
