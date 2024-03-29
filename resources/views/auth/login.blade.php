@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Login</h3>
    <form class="mb-3" action="{{ route('user.login') }}" method="POST">
        @if(Session::has('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif   
        @csrf
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