@extends('front.app')

@section('content')

<div class="archive-content history-block">
    <div class="container">
        <div class="breadcrumbs">
            <a href="#">Home > </a>
            <a href="#" class="active">Istorii de success</a>
        </div>

        <div class="content">
            <h1>Istorii de succes</h1>
            <p>Pentru a te încuraja să obții rezultatele dorite de către tine, în materialele video și foto, îți vom prezenta poveștile persoanelor care deja și-au obținut scopul propus.
            </p><p>Ghidați de echipa de profesioniști a Galinei Tomaș rezultatele au ajuns la minus 20, 30, 50 și 70 kilograme. </p>
            <p>Plus că toți au deprins principiile unui stil sănătos de viață și au reușit să-și schimbe viața la 90 de grade.  </p>
            <p class="blue">Inspiră-te, acționează și implimentează sfaturile primite de la ei!</p>
            <p class="green">Fii chiar tu următoarea poveste de success!!!</p>
        </div>

    </div>

    <div class="sliders">
        <div class="histories">
            <h4 class="green">Galereie Video</h4>
            {{-- <div class="histories-slider"> --}}
              {{-- @if (!empty($videos))
                  @foreach ($videos as $key => $video)
                      <div class="item">{!! $video->video !!}</div>
                  @endforeach
              @endif --}}
              <div class="video-block">
                  <iframe width="100%" height="415" src="https://www.youtube.com/embed/?listType=playlist&list=PLltYmamAmqFNQVLSO14sWnDE7aveARw-K" frameborder="0" allowfullscreen></iframe>
                  {{-- <a href="/page/success_stories" class="show-more">Vezi toate istoriile de succes </a> --}}
              </div>
            {{-- </div> --}}
        </div>
        <div class="histories silver-ungle">
            <h4 class="blue">Galereie Foto</h4>
            <div class="histories-slider">
                @if (!empty($photos))
                    @foreach ($photos as $key => $photo)
                        <div class="item"><img src="{{ $photo->img }}"></div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <a href="/page/archive/2017" class="show-more">Arhiva </a>
    

    <div class="button-center">
        <a href="{{ route('free.week') }}">Primeste o saptamâna gratuită</a>
    </div>

</div>
@include('front.partials.footer-line')
@stop
