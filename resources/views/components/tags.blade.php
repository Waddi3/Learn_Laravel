<p>
    @foreach ($tags as $tag)
    <a href="{{ route('fun.posts.tags.index', ['tag'=> $tag->id]) }}" 
    class="badge badge-success" style="font-size: 1.0rem">{{$tag->name}}
 </a>
    @endforeach
</p>

