@extends('error')

@section('title')
    <title>Page not found.</title>
@endsection

@section('content')
    <div class="title">Not found.</div>
    <div class="link"><a href="{{ url('/') }}">Get back</a></div>
@endsection