@extends('layouts.app')

@section('title', 'create the post')

@section('content')
<form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('posts.partials.form')
    <button type="submit" class="btn btn-primary btn-block">Create!</button>
</form>
@endsection
