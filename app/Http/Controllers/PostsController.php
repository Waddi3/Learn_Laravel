<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\filePath;
use App\Models\Image;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter; 
use Illuminate\Contracts\Filesystem\Filesystem;

// [
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete',
// ]



class PostsController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth')
    ->only(['create', 'store' , 'edit' , 'update' , 'destroy']);
   }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view(
            'posts.index',
             ['posts' => BlogPost::latestWithRelations()->get(),
          
             ]);
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create(BlogPost $post)
    {
    
    //   $this->authorize('posts.create', $post);
       return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {
       $validated = $request->validated();
       $validated['user_id'] = auth()->id();
       $blogPost = BlogPost::create($validated);

    //    $hasFile = $request->hasFile('thumbnail');
    //    dump($hasFile);

       if($request->file('thumbnail')){ 
        $path = $request->file('thumbnail')->store('thumnails');
        $blogPost->image()->save(
            Image::make([
             'blog_post_id' => $blogPost->id,
             'path' => $path,])
        );


        // dump($file);
        // dump($file->getClientMimeType());
        // dump($file->getClientOriginalExtension());

        // dump($file->store('thumbnails'));
        // $fileSystem = Storage::putFile('thumbnails', $file);
        // dump($fileSystem);

        // $blogPost = new BlogPost();
        // $name1 = $file->storeAs('thumbnails', $post->id . '.' . $file->guessExtension());
        // $name2 = Storage::disk('local')->putFileAs('thumbnails', $file, $post->id . '.' . $file->guessExtension());

        // dump(Storage::url($name1));
        // dump(Storage::disk('local')->url($name2));

       }
   

       session()->flash('status','The blog post was created');

       return redirect()->route('posts.show',['post' => $blogPost->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       // abort_if(!isset($this->posts[$id]), 404);
            //  return view('posts.show', [
            //  'post' => BlogPost::with(['comments' => function($query){
            //     return $query->latest();
            //  }])->findOrFail($id)
            // ]);
            
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function() use($id){
            return BlogPost::with('comments', 'tags' , 'user' ,'comments.user')
            ->findOrFail($id);
        });

        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post{$id}-users";
        
        $users = Cache::tags(['blog-post'])->get($usersKey, []);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();

        foreach($users as $session => $lastVisit){
            if($now->diffInMinutes($lastVisit)>=1){
                $diffrence--;
            }
            else{
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(
            !array_key_exists($sessionId, $users)
            || $now->diffInMinutes($users[$sessionId]) >= 1
        ) {
            $diffrence++;
        }
        
        $usersUpdate[$sessionId] = $now;
        Cache::tags(['blog-post'])->forever($usersKey, $usersUpdate);
        if(!Cache::tags(['blog-post'])->has($counterKey)){
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else{
            Cache::tags(['blog-post'])->increment($counterKey, $diffrence);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);    
        
            return view('posts.show', [
                'post' => $blogPost,
                'counter' =>$counter,
               ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = BlogPost::findOrFail($id);

        // if(Gate::denies('update-post', $post)){
        //     abort(403, "You cant edit this blog post");
        // }
        $this->authorize($post);

        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePost $request, string $id) 
    {
         $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        $validated = $request->validated();
        $post->fill($validated);

        if($request->file('thumbnail')){ 
            $path = $request->file('thumbnail')->store('thumnails');
            if($post->image){
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            }
            else{
                $post->image()->save(
                    Image::make(['path' => $path])
                );
            }
            $post->image()->save(
                Image::create([
                 'blog_post_id' => $post->id,
                 'path' => $path,])
            );
        }

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

        // if(Gate::denies('posts.delete', $post)){
        //     abort(403, "You cant delete this blog post");
        // }

        $this->authorize($post);

        $post->delete();
        session()->flash('ststus', 'Blog post was deleted!');
        return redirect()->route('posts.index');
    }
}






