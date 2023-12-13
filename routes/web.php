<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MycourseController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
    Route::get('/profile/{user}/edit',[ProfileController::class,'edit'])->name('profile.edit');
    Route::put('/profile/{user}',[ProfileController::class,'update'])->name('profile.update');

    Route::get('/change-password/{user}/edit',[PasswordController::class,'edit'])->name('password.edit');
    Route::put('/change-password/{user}',[PasswordController::class,'update'])->name('password.update');
    Route::get('/logout', fn()=> redirect()->route('login'));
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');

    Route::resource('course', CourseController::class)->except(['index']);
    Route::get('/course/{course}/person', [CourseController::class,'showperson'])->name('course.showperson');

    Route::get('/course/{course}/post/{post}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::put('/course/{course}/post/{post}',[PostController::class,'update'])->name('post.update');
    Route::delete('/course/{course}/post/{post}',[PostController::class,'destroy'])->name('post.destroy');
    Route::get('/course/{course}/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/course/{course}/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/course/{course}/post/{post}',[PostController::class,'show'])->name('post.show');

    Route::post('/course/{course}/post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::put('/course/{course}/post/{post}/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/course/{course}/post/{post}/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');  

    Route::post('/course/{course}/post/{post}/comment/{comment}', [ReplyController::class, 'store'])->name('reply.store');
    Route::put('/course/{course}/post/{post}/comment/{comment}/reply/{reply}', [ReplyController::class, 'update'])->name('reply.update');
    Route::delete('/course/{course}/post/{post}/comment/{comment}/reply/{reply}', [ReplyController::class, 'destroy'])->name('reply.destroy');

    Route::delete('/course/{course}/post/{post}/link/{link}',[LinkController::class,'destroy'])->name('link.destroy');   
    
    Route::get('/join-course',[MycourseController::class,'create'])->name('mycourse.create');
    Route::post('/join-course',[MycourseController::class,'store'])->name('mycourse.store');
    Route::delete('/leave-course/{course}',[MycourseController::class,'destroy'])->name('mycourse.destroy');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login',[LoginController::class,'auth'])->name('login.auth');
    Route::get('/register',[RegisterController::class,'index'])->name('register');
    Route::post('/register',[RegisterController::class,'store'])->name('register.store');
});



