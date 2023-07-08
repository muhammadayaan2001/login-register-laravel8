@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Register</h3>
    @if(Session::has('sucess'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif    
    @if(Session::has('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif    
    <form class="mb-3" action="{{ route('user.register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputPassword1">
            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection