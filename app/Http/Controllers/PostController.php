<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    private $post;
    private $category;

    public function __construct(Post $post,Category $category,User $user, Like $like)
    {
        $this->post     = $post;
        $this->category = $category;
        $this->user     = $user;
        $this->like    = $like;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_categories = Category::all();


        //Category::all() is same $this->category->all()
        //if use Category ,i dont need to use constuct and private
        return view('users.posts.create')
        ->with('all_categories',$all_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
             'category'   => 'required|array|between:1,3',
             'description' => 'required|max:1000',
             'image'       => 'required|mimes:jpg,jpeg,png,gif|max:1048'

        ]);

        $this->post->user_id = Auth::user()->id;

        $this->post->description  = $request->description;
        $this->post->image   = $this->saveImage($request);

        $this->post->save();

        #save in category_post table
        //createing an array for selected categories
        foreach($request->category as $category_id):
            $category_post[] = ["category_id"=>$category_id];
        endforeach;
        $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');

    }


    public function saveImage($request)
    {
        $image_name = time() .".". $request->image->extension();

        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = $this->post->findOrFail($id);

        return view('users.posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post =$this->post->findOrFail($id);
        if($post->user->id != Auth::user()->id){
            return redirect()->route('index');
        }

        $all_categories = Category::all();
        $selected_categories = [];
        foreach($post->categoryPost as $category_post):
            $selected_categories[] = $category_post->category_id;
        endforeach;

        return view('users.posts.edit')
        ->with('post',$post)
        ->with('all_categories',$all_categories)
        ->with('selected_categories',$selected_categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            'category'   => 'required|array|between:1,3',
            'description' => 'required|max:1000',
            'image'       => 'required|mimes:jpg,jpeg,png,gif|max:1048'

       ]);

       $post = $this->post->findOrFail($id);
        $post->description  = $request->description;

        if($request->image):
            $this->deleteImage($post->image);

            $post->image = $this->saveImage($request);
        endif;

        $post->save();
        #categories
        #delete the old selected caegories
        $post->categoryPost()->delete();
        #ave the new one

        foreach($request->category as $category_id):
            $category_post[] = ["category_id"=>$category_id];
        endforeach;
        $post->categoryPost()->createMany($category_post);

        return redirect()->route('post.show',$id);
    }

    public function deleteImage($image_name)
    {
        $image_path =self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->post->destroy($id);

        return redirect()->route('index');
    }
}
