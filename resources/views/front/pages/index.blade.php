@extends('front.app')

@section('content')

    <div class="banner">
        <div class="mainBanner">
            <div><a href="#"><img src="{{  asset('front-assets/img/banner.png') }}"></a></div>
            <div><a href="#"><img src="{{  asset('front-assets/img/banner.png') }}"></a></div>
            <div><a href="#"><img src="{{  asset('front-assets/img/banner.png') }}"></a></div>
        </div>

        <div class="banner-circle">
            <div class="banner-circle-inside">
                <h2>Want to get in shape from home?</h2>
                <div class="btns">
                    <a href="{{ route('add.free.week') }}" class="green">Get one week free access to all our app's
                        services</a>
                    <a href="{{ route('login') }}">Register Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="offerts">
        <div class="offerts-header">
            <p>Get the body You dreamed of!</p>
            <p>Workout and Yoga at home!</p>
            <p>Personalized daily diet!</p>
            <p>Get one week free</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 item">
                    <div class="item-inside">
                        <img src="{{ asset('/assets/1.jpg') }}">
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="item-inside">
                        <img src="{{ asset('/assets/2.jpg') }}">
                    </div>
                </div>
                <div class="col-md-4 item">
                    <div class="item-inside">
                        <img src="{{ asset('/assets/3.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="button-center">
            <a href="{{ route('add.free.week') }}">Get one week free</a>
        </div>
    </div>

    <div class="histories">
        <div class="video-block">
            <video src="{{ asset('assets/IMG_5078.MOV') }}" autoplay muted playsinline style="width: 100%"></video>
        </div>
    </div>

    <div class="teasers">
        <div class="banner-abonaments">
            <div class="deals">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 deal">
                            <a href="{{ route('cart.subscriptions', ['id' => 1]) }}">
                                <img src="{{ asset('assets/BS-pricing-plan-1.jpg') }}">
                            </a>
                        </div>
                        <div class="col-md-3 deal">
                            <a href="{{ route('cart.subscriptions', ['id' => 2]) }}">
                                <img src="{{ asset('assets/BS-pricing-plan-2.jpg') }}">
                            </a>
                        </div>
                        <div class="col-md-3 deal">
                            <a href="{{ route('cart.subscriptions', ['id' => 3]) }}">
                                <img src="{{ asset('assets/BS-pricing-plan-3.png') }}">
                            </a>
                        </div>
                        <div class="col-md-3 deal">
                            <a href="{{ route('cart.subscriptions', ['id' => 4]) }}">
                                <img src="{{ asset('assets/BS-pricing-plan-4.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-center">
            <a href="{{ route('add.free.week') }}">Get one week free</a>
        </div>
    </div>

    @include('front.partials.footer-line')

@stop
