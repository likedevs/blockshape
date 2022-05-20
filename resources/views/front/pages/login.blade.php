@extends('front.app')

@section('content')
    <div class="static-banner relative">
        <img src="{{ asset('front-assets/img/login-banner.png') }}">
        <div class="login-form">
            <div class="row heading">
                <div class="col-md-6 text-center">
                    <h4><a href="{{ route('register') }}">Sign up</a></h4>
                </div>
                <div class="col-md-6 text-center">
                    <h3>Sign in</h3>
                </div>
            </div>
            <div class="row form-area">
                <form action="{{ route('post.login') }}" method="post">
                    @if (Session::has('bad'))
                        <div class="alert alert-danger text-center">
                            {{ Session::get('bad') }}
                        </div>
                    @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">
                            Email
                            <span class="prompt-block">
                            {{ $errors->has('email') ? $errors->first('email') : '' }}
                        </span>
                        </label>
                        <input type="text" name="email" id="email" value="{{ Request::old('email') }}">
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">
                            Password
                            <span class="prompt-block">
                            {{ $errors->has('password') ? $errors->first('password') : '' }}
                        </span>
                        </label>
                        <input type="password" id="password" name="password">
                    </div>
                    <input type="submit" value="Sign in">
                </form>
            </div>
        </div>
    </div>
@stop
