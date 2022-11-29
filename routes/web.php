<?php

use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Comment;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/category',[CategoryController::class,'store']);

Route::group(['prefix' => 'admin', 'as' => 'admin.'],function(){
    //USERS
    Route::get('/users',[UsersController::class,'index'])->name('users');
    Route::delete('users/{id}/deactivate',[UsersController::class,'deactivate'])->name('users.deactivate');
    Route::patch('users/{id}/activate',[UsersController::class,'activate'])->name('users.activate');
    Route::get('/posts',[PostsController::class,'index'])->name('posts');
    Route::delete('posts/{id}/deactivate',[PostsController::class,'deactivate'])->name('posts.deactivate');
    Route::patch('posts/{id}/activate',[PostsController::class,'activate'])->name('posts.activate');
});


Route::group(['middleware'=>'auth'],function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::resource('/post',PostController::class);
    Route::resource('/comment',CommentController::class);
    Route::resource('/profile',ProfileController::class);
    Route::resource('/like',LikeController::class);
    Route::resource('/follow',FollowController::class);

});



//Route::group(['prefix'=>'post','as'=>'post.'],function(){
   // Route::get('/create',[PostController::class,'create'])->name('create');
   // Route::post('/store',[PostController::class,'store'])->name('store');
//});
