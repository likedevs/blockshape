@extends('front.app')

@section('content')

@include('front.partials.account-tabs')

<div class="events">
    <h1>Cumparaturi curente</h1>
    @if (count($cart) > 0)
        @foreach ($cart as $key => $value)
            @if ($value->type == 'events')
                @if ($key % 2 == 0)
                    <div class="green">
                        <div class="container">
                            <div class="row">
                                 <div class="col-md-6 item">
                                   <h2>{{ $value->events->title }}</h2>
                                   <img src="{{ $value->events->image }}">
                               </div>
                               <div class="col-md-6 item">
                                   <p>{{ $value->events->descr }}
                                   <small>Valabil de pe {{ $value->events->begin }} pana {{ $value->events->end }}</small></p>
                                   <a href="#" class="more">citeste mai mult</a>
                               </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="green silver">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 item">
                                   <p>{{ $value->events->descr }}
                                   <small>Valabil de pe {{ $value->events->begin }} pana {{ $value->events->end }}</small></p>
                                   <a href="#" class="more">citeste mai mult</a>
                               </div>
                               <div class="col-md-6 item">
                                   <h2>{{ $value->events->title }}</h2>
                                   <img src="{{ $value->events->image }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @elseif ($value->type == 'seminars')
                    @if ($key % 2 == 0)
                    <div class="green">
                        <div class="container">
                            <div class="row">
                                 <div class="col-md-6 item">
                                   <h2>{{ $value->seminars->title }}</h2>
                                   <img src="{{ $value->seminars->image }}">
                               </div>
                               <div class="col-md-6 item">
                                   <p>{{ $value->seminars->descr }}
                                   <small>Valabil de pe {{ $value->seminars->begin }} pana {{ $value->seminars->end }}</small></p>
                                   <a href="#" class="more">citeste mai mult</a>
                               </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="green silver">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 item">
                                   <p>{{ $value->seminars->descr }}
                                   <small>Valabil de pe {{ $value->seminars->begin }} pana {{ $value->seminars->end }}</small></p>
                                   <a href="#" class="more">citeste mai mult</a>
                               </div>
                               <div class="col-md-6 item">
                                   <h2>{{ $value->seminars->title }}</h2>
                                   <img src="{{ $value->seminars->image }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    @else
        <p class="text-center">Cumparaturi curente nu sunt!</p>
    @endif
</div>
@include('front.partials.prefooter')

@include('front.partials.footer-line')

@stop
