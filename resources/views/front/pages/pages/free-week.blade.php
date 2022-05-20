@extends('front.app')

@section('content')


<div class="breadcrumbs">
    <div class="container">
        <a href="#">Home</a> >
        <a href="#" class="active">Oferta o saptamana gratis</a>
    </div>
</div>

<div class="video-banner">
    <img src="{{ asset('front-assets/img/free-week-video.png') }}">
</div>

<div class="abon-content free-week">
    <h1>O saptamana gratuita</h1>
    <div class="container">
      <div class="row">
        <div class="conditions">
            <p>Fie că vrei să slăbești, să îți tonifiezi corpul, să uiți de stresul cotidian sau să deprinzi regulile stilului sănătos de viață, abonamentele noastre reprezintă o provocare perfecta pentru tine.</p>
            <p>Dacă alegi să te înregistrezi la săptămâna gratuită, urmează să primești următoarele facilități:</p>
        </div>
      </div>
    </div>
    <div class="container">
        <div class="row abon-options">
            <div class="col-md-2 item">
                <img src="{{ asset('front-assets/img/option-1.png') }}">
                <p class="just-border"></p>
                <p><span>Antrenamente cu efort fizic dozat</span></p>
            </div>
            <div class="col-md-2 item">
                <img src="{{ asset('front-assets/img/option-2.png') }}">
                <p><span>Testarea nutrițională și fiziologică</span></p>
            </div>
            <div class="col-md-2 item">
                <img src="{{ asset('front-assets/img/option-3.png') }}">
                <p><span> Regim alimentar  personalizat zilnic</span></p>
            </div>
            <div class="col-md-2 item">
                <img src="{{ asset('front-assets/img/option-4.png') }}">
                <p><span> Posibilitatea de  a vizualiza în timp  real evoluția parametrilor corporali</span></p>
            </div>
            <div class="col-md-2 item">
                <img src="{{ asset('front-assets/img/option-5.png') }}">
                <p><span>Detectarea și monitorizarea perioadelor metabolice</span></p>
            </div>
            <div class="col-md-2 item">
                <img src="{{ asset('front-assets/img/option-6.png') }}">
                <p><span>Agendă on line,  unde îți poți nota fiecare pas </span></p>
            </div>
        </div>
    </div>
    <div class="banner-warning">
        <img src="{{ asset('front-assets/img/banner-warning.png') }}">
    </div>
    <h5>Unde în altă parte vei mai avea ocazia să beneficiezi de serviciile unui centru de sport și nutriție on-line la doar 40 cenți pe zi ?</h5>
    <div class="deal-btn button-center">
        <a href="{{ route('add.free.week') }}">Primeste o saptamâna gratuită</a>
    </div>
    <div class="green-btns">
        <a href="#">Procura unul din abonamente</a>
    </div>
</div>


@include('front.partials.footer-line')

@stop
