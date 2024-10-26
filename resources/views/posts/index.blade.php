{{-- @extends('layouts.app')

@section('title', 'Blog posts')

@section('content') --}}
{{-- @each('posts.partials.post' , $posts , 'post') --}}
{{-- @forelse ($posts as $key => $post )

    @include('posts.partials.post', [])
@empty
no posts found!
@endforelse


@endsection --}}
{{-- @extends('layouts.app')
  @vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="row">
    <div class="col-8">
    @forelse ($posts as $post)
        <p>
            <h3>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
            </h3>

            <p class="text-muted">
                Added {{ $post->created_at->diffForHumans() }}
                by {{$post->user->name}}
            </p>

            @if($post->comments_count)           
                <p>{{$post->comments_count}} comments</p>
            @else
                <p>No comments yet!</p>
            @endif
            @can('update', $post)
                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                    class="btn btn-primary">
                    Edit
                </a>
            @endcan
            @cannot('delete', $post)
                <p>
                    you cant delete this post
                </p>
            @endcannot
            @can('delete', $post)
                <form method="POST" class="fm-inline"
                    action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                    @csrf
                    @method('DELETE')

                    <input type="submit" value="Delete!" class="btn btn-primary"/>
                </form>
            @endcan
        </p>
    @empty
        <p>No blog posts yet!</p>
    @endforelse
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">Most Commented</h5>
                <p class="card-text">What prople are currently talking about</p>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Vestibulum at eros</li>
                </ul>
        </div>
    </div>
</div>
@endsection('content') --}}


@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-8">
    @forelse ($posts as $post)
        <p>
            <h3>
                
                @if($post->trashed())
                    <del>
                @endif
                <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
                    href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                @if($post->trashed())
                    </del>
                @endif
            </h3>

            {{-- <p class="text-muted">
                Added {{->}}
                by {{ $post->user->name }}
            </p> --}}

            @component('components.updated' ,['date'=>$post->created_at, 'name'=> $post->user->name, 'userId'=> $post->user->id])
            @endcomponent

            @component('components.tags', ['tags'=> $post->tags])
            @endcomponent
            
            @if($post->comments_count)
                <p style="color: rgb(247, 90, 43)">{{ $post->comments_count }} comments</p>
            @else
                <p>No comments yet!</p>
            @endif
        @auth
            @can('update', $post)
                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                    class="btn btn-primary">
                    Edit
                </a>
            @endcan
        @endauth
            {{-- @cannot('delete', $post)
                <p>You can't delete this post</p>
            @endcannot --}}
            @auth
                @if(!$post->trashed())
                    @can('delete', $post)
                        <form method="POST" class="fm-inline"
                            action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Delete!" class="btn btn-primary"/>
                        </form>
                    @endcan
                @endif
            @endauth
        </p>
    @empty
        <p>No blog posts yet!</p>
    @endforelse
    <p>_________________________________________________________________________</p>
    </div>
    <div class="col-4">
       @include('posts._activity')
    </div>
</div>
@endsection('content')
