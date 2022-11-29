<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use  HasApiTokens, HasFactory, Notifiable,  SoftDeletes;




    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed(); //owner of the post
    }
    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);  //select * from likes where post_id = ???
    }

    public function isLiked()
    {
        return $this->likes()->where('user_id',Auth::user()->id)->exists();
        // select * from likes where user_id = ??? // true or false
    }
}
