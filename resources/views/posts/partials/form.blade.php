<div class="form-group">
    <label for="title">Title</label>
    <input id="title" type="text" name="title" class="form-control" value="{{old('title' , optional($post ?? null)->title)}}">
</div>
@error('title')
<div class="alert alert-danger">{{$message}}</div>
@enderror
<div class="form-group">
    <label for="content">Content</label>
    {{-- <input type="text" name="content" class="form-control"
    value="{{old('content', $post->content ?? null)}}"/> --}}
    <textarea class="form-control" id="content" name="content">{{old('content', optional($post ?? null)->content)}}</textarea>
</div>

<div class="form-group">
    <label for="title">Thumbnail</label>
    <input id="title" type="file" name="thumbnail" class="form-control-fail"/>

</div>

@component('components.errors')    
@endcomponent


