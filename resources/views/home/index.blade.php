{{-- @extends('layouts.app')
@section('title', 'Home page')
@section('content')

<h2>Welcome to laravel!</h2>
@for($i = 0 ; $i < 10 ; $i++)
<div>The current value is {{ $i }}</div>
@endfor
<div>

</div>
@php $done = false @endphp
@while(!$done)
<div>I am not done</div>

@php
    if (random_int(0,1) === 1) $done = true
@endphp
@endwhile
@endsection --}}
@extends('layouts.app')
@section('title', 'Home page')
@section('content')

<h2>Welcome to laravel!</h2>
<h3>This is the content of the main page</h3>
@endsection
