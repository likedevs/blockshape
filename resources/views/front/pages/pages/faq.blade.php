@extends('front.app')

@section('content')

<div class="static-banner">
   <img src="img/banner-faq.png">
</div>

<div class="container faq">
   <h2>{{ Label(104, $lang_id) }}</h2>
   <div class="questions">
       <div class="row">
           <div class="faq-title active">
               Cum să slăbesc corect?
           </div>
           <div class="anwser">
              Dacă încă mai lupți cu kilogramele în plus, dar nu prea vezi rezultate înseamnă că nu ții cont de anumite reguli. Îți oferim câteva sfaturi elementare de care trebuie să ții cont dacă vrei să scapi de grăsime!
               (http://unica.md/sport/e-bine-sa-stii cum-sa-slabesti-corect-zece-reguli-de-aur/ )
           </div>
       </div>
       <div class="row">
           <div class="faq-title">
               Cum să slăbesc corect?
           </div>
           <div class="anwser hidden">
              Dacă încă mai lupți cu kilogramele în plus, dar nu prea vezi rezultate înseamnă că nu ții cont de anumite reguli. Îți oferim câteva sfaturi elementare de care trebuie să ții cont dacă vrei să scapi de grăsime!
               (http://unica.md/sport/e-bine-sa-stii cum-sa-slabesti-corect-zece-reguli-de-aur/ )
           </div>
       </div>
       <div class="row">
           <div class="faq-title">
               Cum să slăbesc corect?
           </div>
           <div class="anwser hidden">
              Dacă încă mai lupți cu kilogramele în plus, dar nu prea vezi rezultate înseamnă că nu ții cont de anumite reguli. Îți oferim câteva sfaturi elementare de care trebuie să ții cont dacă vrei să scapi de grăsime!
               (http://unica.md/sport/e-bine-sa-stii cum-sa-slabesti-corect-zece-reguli-de-aur/ )
           </div>
       </div>
       <div class="row">
           <div class="faq-title">
               Cum să slăbesc corect?
           </div>
           <div class="anwser hidden">
              Dacă încă mai lupți cu kilogramele în plus, dar nu prea vezi rezultate înseamnă că nu ții cont de anumite reguli. Îți oferim câteva sfaturi elementare de care trebuie să ții cont dacă vrei să scapi de grăsime!
               (http://unica.md/sport/e-bine-sa-stii cum-sa-slabesti-corect-zece-reguli-de-aur/ )
           </div>
       </div>
        <div class="row">
           <div class="faq-title">
               Cum să slăbesc corect?
           </div>
           <div class="anwser hidden">
              Dacă încă mai lupți cu kilogramele în plus, dar nu prea vezi rezultate înseamnă că nu ții cont de anumite reguli. Îți oferim câteva sfaturi elementare de care trebuie să ții cont dacă vrei să scapi de grăsime!
               (http://unica.md/sport/e-bine-sa-stii cum-sa-slabesti-corect-zece-reguli-de-aur/ )
           </div>
       </div>

   </div>
</div>

<div class="button-center">
   <a href="{{ route('free.week') }}">Primeste o saptamâna gratuită</a>
</div>

@include('front.partials.footer-line')

@stop
