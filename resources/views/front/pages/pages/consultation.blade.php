@extends('front.app')

@section('content')

<div class="banner-abonaments">
    <img src="{{ asset('front-assets/img/banner-consult.png') }}">
    <div class="deals">
        <div class="container">
            <div class="row">
                @if (!empty($subscriptions))
                    @foreach ($subscriptions as $key => $subscription)
                        <div class="col-md-3 deal">
                            <img src="{{ $subscription->image }}">
                            <a href="{{ route('cart.consults', ['id' => $subscription->id]) }}">{{ Label(111, $lang_id) }}</a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container consultation">
    <h2>{{ Label(105, $lang_id) }}</h2>
    <p>{{ Label(106, $lang_id) }}</p>
    <h2>{{ Label(107, $lang_id) }}</h2>
    <p>{{ Label(108, $lang_id) }}</p>
    <p class="text-center">{{ Label(109, $lang_id) }}</p>
    <h3>{{ Label(110, $lang_id) }}</h3>
    @if (!empty($subscriptions))
        @foreach ($subscriptions as $key => $subscription)
            <div class="row">
                <img src="{{ $subscription->aditional_image }}">
                <a href="{{ route('cart.consults', ['id' => $subscription->id]) }}">{{ Label(111, $lang_id) }}</a>
            </div>
        @endforeach
    @endif
</div>

<div class="deal-btn button-center">
    <a href="{{ route('free.week') }}">Primeste o saptamâna gratuită</a>
</div>

@include('front.partials.footer-line')

@stop
