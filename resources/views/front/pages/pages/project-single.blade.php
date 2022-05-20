@extends('front.app')

@section('content')

<div class="container standart">
    <div class="breadcrumbs">
        <a href="#">Home</a> >
        <a href="#" class="active">Seminar</a>
    </div>

    <h1>{{ $project->title }}</h1>

    <div class="seminar">
        {!! $project->body !!}
    </div>
</div>

@include('front.partials.footer-line')

@stop
