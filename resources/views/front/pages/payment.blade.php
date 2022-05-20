@extends('front.app')

@section('content')

<div class="static-banner">
   <img src="{{ asset('front-assets/img/banner-payment.png') }}">
</div>

<div class="container">
   <div class="row payment">
       <div class="col-md-12">
           <h3>Cosul tau - <b>Efectueaza plata</b></h3>
       </div>
       <div class="col-md-6">
           <a href="#"><img src="{{ asset('front-assets/img/credit-card.png') }}"></a>
           <span class="accept-cards"></span>
           <div class="total">suma totală:  {{ $total }} €</div>
           {{-- <h4>Detalii</h4> --}}
           {{-- <div class="row card-form">
               <div class="col-md-12">
                   <label for="card-name">Numar de card</label>
                   <input type="text" id="card-name" placeholder="1234 1234 1234">
               </div>
               <div class="col-md-4">
                   <label for="card-expire-mouth">Luna expirare card</label>
                   <input type="text" id="card-expire-mouth" placeholder="LL">
               </div>
               <div class="col-md-4">
                   <label for="card-expire-year">Anul expirare card</label>
                   <input type="text" id="card-expire-year" placeholder="AAAA">
               </div>
               <div class="col-md-4">
                   <label for="card-code">Cod de securitate</label>
                   <input type="text" id="card-code" placeholder="1234">
               </div>
               <div class="col-md-12">
                   <input type="submit" value="Efectueaza plata">
               </div>
           </div> --}}
           <div class="row card-form">
              <div class="col-md-6">
                  <form action="{{ url('payment/vb') }}" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="order_id" value="{{ $order_id }}">
                      <div class="col-md-12">
                          <input type="submit" value="Efectueaza plata">
                      </div>
                  </form>
              </div>
              <div class="col-md-6">
                    <a href="{{ route('test.payment') }}">Testeaza</a>  
              </div>
           </div>
       </div>
       <div class="col-md-6">
           {{-- <a href="#"><img src="{{ asset('front-assets/img/paypal.png') }}"></a> --}}
       </div>
   </div>
</div>

@stop
