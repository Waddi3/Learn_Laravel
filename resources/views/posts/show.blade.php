@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-8">
        @if($post->image)
            <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px color: white; text-align: center; background-attachment: fixed;">
                <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
        @else
            <h1>
        @endif
            <h1 style="color: rgb(15, 71, 162)">{{ $post->title }}</h1>
    
            @component('components.badge', ['show' => now()->diffInMinutes($post->created_at) <30])
               <h1> Bard new Post! </h1>
            @endcomponent   
            @if($post->image)
                </h1>   
            </div>             
            @else
                </h1>
            @endif
            {{-- @badge
                    Brand new post!
                @endbadge --}}
        
        <p>{{ $post->content }}</p>

        {{-- <img src="{{ $post->image->url() }}"  width="1000" height="auto"  />  --}}

        {{-- <img src="{{ url('storage/' . $post->image->path) }}" width="800" height="auto" /> --}}


        {{-- <p>Added {{ $post->created_at->diffForHumans() }}</p> --}}

        @component('components.updated' ,['date'=>$post->created_at, 'name'=> $post->user->name])
        @endcomponent

        @component('components.updated' ,['date'=>$post->updated_at]) 
        Updated
        @endcomponent

        @component('components.tags', ['tags'=> $post->tags])
        @endcomponent
        

        <p>Currently read by {{$counter}} people</p>

        <h4 style="color:rgb(19, 19, 219)">Comments</h4>

        @component('components.comment-form', ['route' => route('fun.posts.comments.store', ['post'=> $post->id])])
        @endcomponent

        @component('components.comment-list', ['comments'=> $post->comments])
        @endcomponent
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>
@endsection('content')
