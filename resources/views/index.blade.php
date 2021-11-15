@extends('layouts.guest')
@section('title', 'Login')
@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">ES</h1>
        </div>
        <h3>Expert System</h3>
        <form class="m-t" role="form" method="post" action="{{ url('auth') }}">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" required="">
                @if ($errors->has('email'))
                    <small class="text-danger m-b-none">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required="">
                @if ($errors->has('password'))
                    <small class="text-danger m-b-none">{{ $errors->first('password') }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <a href="#"><small>Forgot password?</small></a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>
@endsection