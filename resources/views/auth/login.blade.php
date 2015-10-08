
@extends('layouts.auth.auth')

@section('title', 'Login Page')

@section('content')
    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>Admin</b>KaCaNa</a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your Manager</p>
                <form method="POST" action="/auth/login">
                    <div class="form-group has-feedback">
                        Email
                        <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group has-feedback">
                        Password
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input name="remember" type="checkbox"> Remember Me </input>
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div>
                        <button class="btn btn-default" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop


