@extends('front.app')

@section('content')

<div class="static-banner relative">
    <img src="{{ asset('front-assets/img/banner-search.png') }}">
    <div class="search-form">
        <input type="text" name="search" placeholder="Cuvinte Cheie" value="{{ Request::get('search') }}">
        <input type="submit" value="Cauta">
        {{-- <span>
            Cauta dupa
            <a href="#" class="arts"></a>
            <a href="#" class="imgs"></a>
            <a href="#" class="video"></a>
        </span> --}}
    </div>
</div>

<div class="container search-area">
    <h3 class="text-center">Au fost descoperite {{ $amount }} articole cu cuvintele cheie de cautare introduse</h3>

    <?php $keySeminars = 0; ?>
    @if (!empty($seminars))
        @foreach ($seminars as $keySeminars => $seminar)
            <div class="row">
                <div class="col-md-1 number"><span>{{ $keySeminars + 1 }}</span></div>
                <div class="col-md-11 article">
                    <h4>{{ $seminar->title }}</h4>
                    <p> {{ $seminar->descr }}</p>
                    <a href="{{ route('seminars.single', ['seminar' => $seminar->slug]) }}">Citeste mai mult</a>
                </div>
            </div>
        @endforeach
    @endif

    @if (!empty($events))
        @foreach ($events as $key => $event)
            <div class="row">
                <div class="col-md-1 number"><span>{{ $keySeminars + $key + 1 }}</span></div>
                <div class="col-md-11 article">
                    <h4>{{ $event->title }}</h4>
                    <p> {{ $event->descr }}</p>
                    <a href="{{ route('events.single', ['event' => $event->slug]) }}">Citeste mai mult</a>
                </div>
            </div>
        @endforeach
    @endif


</div>



<div class="button-center">
    <a href="">Primeste o saptamâna gratuită</a>
</div>


@stop
