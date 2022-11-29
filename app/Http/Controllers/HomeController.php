<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    private $post;
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post,User $user)
    {
        //$this->middleware('auth');
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_posts = $this->post->latest()->get();// get all posts inside posts table
        $home_posts = []; //container for later
        $suggested_users  = $this->suggestedUsers();

        foreach($all_posts as $post):
            //filter
            if($post->user->isFollowed() OR $post->user->id === Auth::user()->id):
                $home_posts[] = $post;
            endif;
        endforeach;

        return view('users.home')
        ->with('all_posts',$home_posts)
        ->with('suggested_users',$suggested_users);
    }

    public function suggestedUsers()
    {
        $all_users = $this->user->all()->except(Auth::user()->id); //get all users from user table
        $suggested_users = []; //container for ater

        foreach($all_users as $user):
            if(!$user->isFollowed()):  // if user is NOT (!)followed
                $suggested_users[] =$user;
            endif;
        endforeach;

        return $suggested_users;
    }
}
