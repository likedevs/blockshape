@extends('front.app')

@section('content')

<div class="archive-content">
    <div class="container">
        <div class="breadcrumbs">
            <a href="#">Home > </a>
            <a href="#" class="active">Arhiva Istorii de success</a>
        </div>

        <div class="content">
            <h1>Arhiva Istoriilor de succes</h1>
            <p>Pentru a te încuraja să obții rezultatele dorite de către tine, în materialele video și foto, îți vom prezenta poveștile persoanelor care deja și-au obținut scopul propus.
            </p><p>Ghidați de echipa de profesioniști a Galinei Tomaș rezultatele au ajuns la minus 20, 30, 50 și 70 kilograme. </p>
            <p>Plus că toți au deprins principiile unui stil sănătos de viață și au reușit să-și schimbe viața la 90 de grade.  </p>
            <p class="blue">Inspiră-te, acționează și implimentează sfaturile primite de la ei!</p>
            <p class="green">Fii chiar tu următoarea poveste de success!!!</p>
        </div>

    </div>
    <div class="over-content">

        <div class="container">
            <div class="row">
                <select class="archive-select" name="" onchange="location = this.value;">
                    <option value="/page/archive/2017" {{ Request::segment(3) == 2017 ? 'selected' :  '' }}>2017</option>
                    <option value="/page/archive/2016" {{ Request::segment(3) == 2016 ? 'selected' :  '' }}>2016</option>
                    <option value="/page/archive/2015" {{ Request::segment(3) == 2015 ? 'selected' :  '' }}>2015</option>
                    <option value="/page/archive/2014" {{ Request::segment(3) == 2014 ? 'selected' :  '' }}>2014</option>
                    <option value="/page/archive/2013" {{ Request::segment(3) == 2013 ? 'selected' :  '' }}>2013</option>
                    <option value="/page/archive/2012" {{ Request::segment(3) == 2012 ? 'selected' :  '' }}>2012</option>
                    <option value="/page/archive/2011" {{ Request::segment(3) == 2011 ? 'selected' :  '' }}>2011</option>
                    <option value="/page/archive/2010" {{ Request::segment(3) == 2010 ? 'selected' :  '' }}>2010</option>
                    <option value="/page/archive/2009" {{ Request::segment(3) == 2009 ? 'selected' :  '' }}>2009</option>
                    <option value="/page/archive/2008" {{ Request::segment(3) == 2008 ? 'selected' :  '' }}>2008</option>
                    <option value="/page/archive/2007" {{ Request::segment(3) == 2007 ? 'selected' :  '' }}>2007</option>
                    <option value="/page/archive/2006" {{ Request::segment(3) == 2006 ? 'selected' :  '' }}>2006</option>
                </select>
            </div>
            <div class="row histories ">
                <div class="histories-slider">
                    @if (!empty($photos))
                        @foreach ($photos as $key => $photo)
                            <div class="item"><img src="{{ $photo->img }}"></div>
                        @endforeach
                    @else
                        Nu am gasit nimic!
                    @endif
                    {{-- <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-1.png') }}">
                    </div>
                    <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-2.png') }}">
                    </div>
                    <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-3.png') }}">
                    </div>
                    <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-1.png') }}">
                    </div>
                    <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-2.png') }}">
                    </div>
                    <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-3.png') }}">
                    </div>
                    <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-1.png') }}">
                    </div>
                    <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-2.png') }}">
                    </div>
                    <div class="col-md-4 item">
                        <img src="{{  asset('front-assets/img/history-3.png') }}">
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
    <div class="button-center">
        <a href="">Primeste o saptamâna gratuită</a>
    </div>

</div>

@include('front.partials.footer-line')

@stop
