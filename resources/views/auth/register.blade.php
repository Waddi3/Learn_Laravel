@extends('layouts')
@section('content')
<form action="{{route('register')}}" method="POST">
@csrf

<div class="form-group">
    <label>Name</label>
    <input name="name" value="{{old('name')}}" required class="form-control">
</div>

<div class="form-group">
    <label>E-mail</label>
    <input name="email" value="{{old('email')}}" required class="form-control">

</div>

<div class="form-group">
    <label>Password</label>
    <input name="password"  required class="form-control">

</div>

<div class="form-group">
    <label>Retyped password</label>
    <input name="password_cofirmation"  required class="form-control">

</div>
 <button type="submit" class="brn btn-primary brn-block">Register</button>
</form>
    
@endsection('content')
