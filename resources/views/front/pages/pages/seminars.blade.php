@extends('front.app')

@section('content')

<div class="static-banner">
    <img src="{{ $page->banner }}">
</div>

<div class="events">
    <div class="container">
       <h1>{{ Label(56, $lang_id) }}</h1>
       <h2>{{ Label(57, $lang_id) }}</h2>
       <p>{{ Label(58, $lang_id) }}</p>
       <h3>{{ Label(59, $lang_id) }}</h3>
       <div class="row items">
           <div class="item sem-1">
               {{ Label(60, $lang_id) }}
           </div>
           <div class="item sem-2">
               {{ Label(61, $lang_id) }}
           </div>
           <div class="item sem-3">
               {{ Label(62, $lang_id) }}
           </div>
           <div class="item sem-4">
               {{ Label(63, $lang_id) }}
           </div>
       </div>
       <div class="green-bordered">
           {{ Label(64, $lang_id) }}
       </div>
       <p class="event-label"><b>{{ Label(65, $lang_id) }}</b> {{ Label(66, $lang_id) }}</p>
    </div>
    @if (!empty($seminars))
        @foreach ($seminars as $key => $seminar)
            @if ($key % 2 != 0)
                <div class="green silver">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 item">
                               <p>{{ $seminar->descr }}
                               <small>Valabil de pe {{ $seminar->begin }} pana {{ $seminar->end }}</small></p>
                               <a href="{{ route('seminars.single', ['seminar' => $seminar->slug]) }}" class="more">{{ Label(68, $lang_id) }}</a>
                           </div>
                           <div class="col-md-6 item">
                               <h2>{{ $seminar->title }}</h2>
                               <img src="{{ $seminar->image }}">
                               <a href="{{ route('cart.seminars', ['id' => $seminar->id]) }}">{{ Label(67, $lang_id) }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="green">
                    <div class="container">
                        <div class="row">
                             <div class="col-md-6 item">
                               <h2>{{ $seminar->title }}</h2>
                               <img src="{{ $seminar->image }}">
                               <a href="{{ route('cart.seminars', ['id' => $seminar->id]) }}">{{ Label(67, $lang_id) }}</a>
                           </div>
                           <div class="col-md-6 item">
                               <p>{{ $seminar->descr }}
                               <small>Valabil de pe {{ $seminar->begin }} pana {{ $seminar->end }}</small></p>
                               <a href="{{ route('seminars.single', ['seminar' => $seminar->slug]) }}" class="more">{{ Label(68, $lang_id) }}</a>
                           </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    <div class="button-center">
        <a href="{{ route('free.week') }}">Primeste o saptamâna gratuită</a>
    </div>
</div>

@include('front.partials.footer-line')

@stop
