@extends('front.app')

@section('content')

    <div class="banner-abonaments">
        <img src="{{ asset('front-assets/img/banner.png') }}">
    </div>

    <div class="histories about-auth"><br> <br>
        <h2>About Block Shape</h2>
        <h3>This app is created to help people lose weight and get in shape.</h3>
        <div class="decor-line"></div>
        <div class="histories-slider">

            <div class="item">
                <a href="#">
                    <img src="{{ asset('/assets/1.jpg') }}" style="max-height: 240px">
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{ asset('/assets/2.jpg') }}" style="max-height: 240px">
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <img src="{{ asset('/assets/3.jpg') }}" style="max-height: 240px">
                </a>
            </div>
        </div>
        <div class="decor-line"></div>
        <div class="container sub">
            <p>Get Yourself a healthy way of life from home. Our unique methodology included Fitness, Yoga, and healthy
                nutrition. Try a week for free our methodology. Let the new You start the path to a healthy life!</p>
            <p>Our app will generate customised meal and exercises plan, based on Your body parameters and desired
                goals. Our app is the first of a kind that combines Fitness, Yoga, healthy nutrition, payments in crypto
                and NFT for achieved results.</p>
        </div>
    </div>

    <div class="container author">
        <h3>Get Yourself a healthy way of life from home. Complete the registration form with Your body parameters and
            get a customized plan with workout exercises and personalized daily diet!</h3>
        <h4>Our app provides the following features</h4>
        <div class="facilits">
            <div class="row first">
                <div class="item">
                    <img src="{{ Image(8) }}">
                    <p><span>Workout exercises</span></p>
                </div>
                <div class="item">
                    <img src="{{ Image(9) }}">
                    <p><span>Yoga exercises</span></p>
                </div>
                <div class="item">
                    <img src="{{ Image(10) }}">
                    <p><span>Personalized daily diet</span></p>
                </div>
                <div class="item">
                    <img src="{{ Image(11) }}">
                    <p><span>Your digital fitness calendar</span></p>
                </div>
            </div>
            <div class="row second">
                <div class="item">
                    <img src="{{ Image(12) }}">
                    <p><span>Your achievements online tracking</span></p>
                </div>
                <div class="item">
                    <img src="{{ Image(13) }}">
                    <p><span>Daily results measuring</span></p>
                </div>
                <div class="item">
                    <img src="{{ Image(14) }}">
                    <p><span>NFT for achieved results</span></p>
                </div>
            </div>
            <h5>Lose weight, get in shape, pay in crypto, receive NFT - innovate Yourself!</h5>
            <h6>The project Block Shape is the first of a kind that combines Fitness, Yoga, healthy nutrition, payments
                in crypto, and NFT in one place. You can do it from home - get the body of Your dreams and receive NFT
                for that. Own the digital proof of Your real-life body transformation.</h6>
        </div>
        <div class="deal-btn button-center">
            <a href="{{ route('add.free.week') }}">Get one week free</a>
        </div>

    </div>

    @include('front.partials.footer-line')

@stop
