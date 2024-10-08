<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
//use Illuminate\Support\Facades\DB;
use App\Http\Controllers\filePath;
class PostsController extends Controller
{
   

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DB::connection()->enableQuerylog();

        // $posts = BlogPost::with('comments')->get();

        // foreach($posts as $post){
        //     foreach($post->comments as $comment){
        //         echo $comment->content;
        //     }
        // }
        // dd(DB::getQuerylog());

        //comment_count

        return view(
            'posts.index',
             ['posts' => BlogPost::withCount('comments')->get()]);
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {
       $validated = $request->validated();
       $post = BlogPost::create($validated);
       session()->flash('status','The blog post was created');

       return redirect()->route('posts.show',['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       // abort_if(!isset($this->posts[$id]), 404);
             return view('posts.show', [
             'post' => BlogPost::with('comments')->findOrFail($id)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePost $request, string $id) 
    {
        $post = BlogPost::findOrFail($id);
        $validated = $request->validated();
        $post->fill($validated);
        $post->save();
        session()->flash('status','The blog post was updated');
        return redirect()->route('posts.show', ['post'=> $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id )
    {
        $post =BlogPost::findOrFail($id);
        $post->delete();
        session()->flash('ststus', 'Blog post was deleted!');
        return redirect()->route('posts.index');
    }
}
