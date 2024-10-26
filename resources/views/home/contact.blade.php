@extends('layouts.app')

@section('title', 'Contact page')

@section('content')

<h2>Contact page</h2>
<h5>Hello this is content</h5>
@can('home.secret')
<p>
    <a href="{{route('secret')}}">
        Go to the Special contact details
    </a>
     
</p>
@endcan
@endsection
