@extends('front.app')

@section('content')
    <div class="static-banner relative">
        <img src="{{ asset('front-assets/img/login-banner.png') }}">
        <div class="login-form">
            <div class="row heading">
                <div class="col-md-6 text-center">
                    <h3>Sign up</h3>
                </div>
                <div class="col-md-6 text-center">
                    <h4><a href="{{ route('login') }}">Sign in</a></h4>
                </div>
            </div>
            <div class="row form-area">

                <form action="{{ route('post.register') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">
                            First Name
                            <span class="prompt-block">
                            {{ $errors->has('name') ? $errors->first('name') : '' }}
                        </span>
                        </label>
                        <input class="form-control" id="name" type="text" name="name"
                               value="{{ Request::old('name') }}">
                    </div>
                    <div class="form-group {{ $errors->has('sname') ? 'has-error' : '' }}">
                        <label for="sname">
                            Second Name
                            <span class="prompt-block">
                            {{ $errors->has('sname') ? $errors->first('sname') : '' }}
                        </span>
                        </label>
                        <input class="form-control" id="sname" type="text" name="sname"
                               value="{{ Request::old('sname') }}">
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">
                            E-mail
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
                    <div class="form-group {{ $errors->has('passwordAgain') ? 'has-error' : '' }}">
                        <label for="password-again">
                            Repeat Password
                            <span class="prompt-block">
                            {{ $errors->has('passwordAgain') ? $errors->first('passwordAgain') : '' }}
                        </span>
                        </label>
                        <input type="password" name="passwordAgain" id="password-agian">
                    </div>
                    <input type="submit" value="Sign Up">
                </form>

            </div>
        </div>
    </div>
@stop
