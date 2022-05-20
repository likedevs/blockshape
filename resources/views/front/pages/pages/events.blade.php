@extends('front.app')

@section('content')

<div class="static-banner">
    <img src="{{ $page->banner }}">
</div>

<div class="events">
    <div class="container paddin-bottom-80">
       <h1>{{ Label(69, $lang_id) }}</h1>
       <p>{{ Label(70, $lang_id) }}</p>
    </div>

    @if (!empty($events))
        @foreach ($events as $key => $event)
            @if ($key % 2 == 0)
                <div class="green">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 item">
                               <h2>{{ $event->title }}</h2>
                               <img src="{{ $event->image }}">
                               <a href="{{ route('cart.events', ['id' => $event->id]) }}">{{ Label(71, $lang_id) }}</a>
                           </div>
                           <div class="col-md-6 item">
                               <p>{{ $event->descr }}
                               <small>Valabil de pe {{ $event->begin }} pana {{ $event->end }}</small></p>
                               <a href="{{ route('events.single', ['event' => $event->slug]) }}" class="more">{{ Label(72, $lang_id) }}</a>
                           </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="green silver">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 item">
                               <p>{{ $event->descr }}
                               <small>Valabil de pe {{ $event->begin }} pana {{ $event->end }}</small></p>
                               <a href="{{ route('events.single', ['event' => $event->slug]) }}" class="more">{{ Label(72, $lang_id) }}</a>
                           </div>
                           <div class="col-md-6 item">
                               <h2>{{ $event->title }}</h2>
                               <img src="{{ $event->image }}">
                               <a href="{{ route('cart.events', ['id' => $event->id]) }}">{{ Label(71, $lang_id) }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>

<div class="button-center">
    <a href="{{ route('free.week') }}">Primeste o saptamâna gratuită</a>
</div>

@include('front.partials.footer-line')

@stop
