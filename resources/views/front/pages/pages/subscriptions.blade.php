@extends('front.app')

@section('content')

    <div class="banner-abonaments">
        <img src="{{ $page->banner }}">
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

    <div class="abon-content">
        <div class="container">
            <div classs="row">
                <div class="info">
                    <p>Get Yourself healthy way of life from home. Our unique methodology included Fitness, Yoga and
                        healthy nutrition. Try a week for free our methodology. Let the new You start the path to
                        healthy life!</p>
                    <div class="deal-btn button-center">
                        <a href="{{ route('add.free.week') }}">Get one week free</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="conditions">
                <p>Choose the pricing plan that suits You and pay in Near! With any pricing plan it will cost You less
                    than a dollar to get advantage of following features:</p>
            </div>
        </div>
        <div class="container">
            <div class="row abon-options">
                <div class="col-md-2 item">
                    <img src="{{ Image(22) }}">
                    <p class="just-border"></p>
                    <p><span>Workout exercises</span></p>
                </div>
                <div class="col-md-2 item">
                    <img src="{{ Image(23) }}">
                    <p><span>Yoga exercises</span></p>
                </div>
                <div class="col-md-2 item">
                    <img src="{{ Image(24) }}">
                    <p><span>Personalized daily diet</span></p>
                </div>
                <div class="col-md-2 item">
                    <img src="{{ Image(25) }}">
                    <p><span>Your achievements online tracking</span></p>
                </div>
                <div class="col-md-2 item">
                    <img src="{{ Image(26) }}">
                    <p><span>Daily results measuring</span></p>
                </div>
                <div class="col-md-2 item">
                    <img src="{{ Image(27) }}">
                    <p><span>Your digital fitness calendar</span></p>
                </div>
            </div>
        </div>
        <div class="sliver-line">
            <div class="container">
                <p>Whatever is the pricing plan that suits You most, Your journey with us will start with a free week,
                    all the services included!</p>
            </div>
        </div>
        <div class="banner-warning">
            {{--            <img src="{{ Image(28) }}">--}}
        </div>
        <div class="green-btns">
            <a href="#"> CHOOSE YOUR PRICING PLAN</a>
        </div>
    </div>

    @include('front.partials.footer-line')

@stop
