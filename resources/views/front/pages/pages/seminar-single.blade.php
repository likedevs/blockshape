@extends('front.app')

@section('content')

<div class="container standart">
    <div class="breadcrumbs">
        <a href="#">Home</a> >
        <a href="#" class="active">Seminar</a>
    </div>

    <h1>{{ $seminar->title }}</h1>
    <div class="static-banner">
        <img src="{{ $seminar->image }}">
    </div>
    <div class="seminar">
        {!! $seminar->body !!}
    </div>
</div>

<a href="#" class="regiter-link">ÎNREGISTREAZă-TE</a>

<div class="account-inside no-padding">
    <h3 class="red">Avantajele care îți aduce acest Seminar</h3>
    <ul>
        @if (strlen($seminar->avantage_1))
            <li>{{ $seminar->avantage_1 }}</li>
        @endif
        @if (strlen($seminar->avantage_2))
            <li>{{ $seminar->avantage_2 }}</li>
        @endif
        @if (strlen($seminar->avantage_3))
            <li>{{ $seminar->avantage_3 }}</li>
        @endif
        @if (strlen($seminar->avantage_4))
            <li>{{ $seminar->avantage_4 }}</li>
        @endif
        @if (strlen($seminar->avantage_5))
            <li>{{ $seminar->avantage_5 }}</li>
        @endif
    </ul>
</div>

<div class="seminar-price">
    Costul de participare la acest seminar = {{ $seminar->price }} €
</div>

<a href="#" class="regiter-link">ÎNREGISTREAZă-TE</a>

@include('front.partials.footer-line')

@stop
