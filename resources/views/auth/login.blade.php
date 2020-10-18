@extends('layouts.app')
@section('content')
<div class="container">
	<div class="login-container">
            <div id="output"></div>
            <img class="avatar" src="{{env('LOGIN_AVATAR')}}">
            <div class="form-box">
                <form action="{{ route('login') }}" method="POST">
                  @csrf
                    <input name="email" type="email" placeholder="username" value="{{ old('email') }}" required autocomplete="email" autofocus class="@error('email') is-invalid @enderror">
                    <input name="password"type="password" placeholder="password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">
                    <button class="btn btn-info btn-block login" type="submit">Login</button>
                </form>
            </div>
        </div>

</div>
@endsection
