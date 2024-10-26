<div class="md-2 mt-2">
    @auth
        <form action="{{ $route }}" method="POST">
            @csrf
            <div class="form-group">
    
                <textarea class="form-control" id="content" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add comment</button>
        </form>
    @component('components.errors')
    @endcomponent
    @else
        <a href="{{route('login')}}">Sign-in</a> to post comments!
    @endauth
    </div>
    <hr/>
    