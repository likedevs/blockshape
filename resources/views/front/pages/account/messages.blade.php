@extends('front.app')

@section('content')

@include('front.partials.account-tabs')

<div class="account-messages">
    <div class="container">
        <div class="row heading">
            <div class="col-md-2">De la</div>
            <div class="col-md-8">Mesaj</div>
            <div class="col-md-2">Data</div>
        </div>

        @if (!empty($messages))
            @foreach ($messages as $key => $message)

        <div class="row">
            <div class="col-md-2"><i></i>{{ $message->from }}</div>
            <div class="col-md-8">{{ $message->body }}</div>
            <div class="col-md-2">{{ $message->created_at }}</div>
        </div>

            @endforeach
        @endif

    </div>
</div>

@include('front.partials.prefooter')

@include('front.partials.footer-line')

@stop
