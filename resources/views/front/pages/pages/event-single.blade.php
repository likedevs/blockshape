@extends('front.app')

@section('content')

<div class="container standart">
    <div class="breadcrumbs">
        <a href="#">Home</a> >
        <a href="#" class="active">Seminar</a>
    </div>

    <h1>{{ $event->title }}</h1>
    <div class="static-banner">
        <img src="{{ $event->image }}">
    </div>
    <div class="seminar">
        {!! $event->body !!}
    </div>
</div>

@include('front.partials.footer-line')

@stop
