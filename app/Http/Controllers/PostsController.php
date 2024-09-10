<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
class PostsController extends Controller
{
   

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::all()]);
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
       session()->flash('status','The blog post was changed');
       return redirect()->route('posts.show',['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       // abort_if(!isset($this->posts[$id]), 404);
             return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
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
