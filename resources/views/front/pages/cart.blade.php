@extends('front.app')

@section('content')

<div class="static-banner">
<img src="{{ asset('front-assets/img/banner-cart.png') }}">
</div>

<div class="breadcrumbs">
<div class="container">
    <a href="#">Cosul Tau</a>
    <a href="#" class="active">- Efectueaza plata</a>
</div>
</div>

<div class="cart-table">
    <div class="container">

    <div class="row heading">
        <div class="container">
            <div class="col-md-6">Produs</div>
            <div class="col-md-6 text-right">Pret</div>
        </div>
    </div>

@if (!empty($cart))
    @foreach ($cart as $key => $value)
        @if (($value->type == 'subscrs') || ($value->type == 'consult'))
            <div class="row body">
                <div class="container">
                    <div class="col-md-2"><img src="{{ $value->subscriptions->image }}"></div>
                    <div class="col-md-6">
                        <h2>{{ $value->subscriptions->name }}</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-md-2"><a href="{{ route('cart.delete', ['id' => $value->id]) }}" class="del"></a></div>
                    <div class="col-md-2 text-right"><span class="price">{{ $value->price }} €</span></div>
                </div>
            </div>
        @elseif ($value->type == 'events')
            <div class="row body">
                <div class="container">
                    <div class="col-md-2"><img src="{{ $value->events->image }}"></div>
                    <div class="col-md-6">
                        <h2>{{ $value->events->title }}</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-md-2"><a href="{{ route('cart.delete', ['id' => $value->id]) }}" class="del"></a></div>
                    <div class="col-md-2 text-right"><span class="price">{{ $value->price }} €</span></div>
                </div>
            </div>
        @elseif ($value->type == 'seminars')
            <div class="row body">
                <div class="container">
                    <div class="col-md-2"><img src="{{ $value->seminars->image }}"></div>
                    <div class="col-md-6">
                        <h2>{{ $value->seminars->title }}</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-md-2"><a href="{{ route('cart.delete', ['id' => $value->id]) }}" class="del"></a></div>
                    <div class="col-md-2 text-right"><span class="price">{{ $value->price }} €</span></div>
                </div>
            </div>
        @endif
    @endforeach
@endif

<div class="row body">
    <div class="container">
        <div class="col-md-9 confirm">
            <input type="checkbox" class="confirm-checkbox" name="confirm">
            <label><a href="#">Confirm că am luat cunoştinţă și sunt de acord cu condiţiile de prestare a serviciilor</a></label>
        </div>
        <div class="col-md-3 text-right total">
            Total spre achitare<span class="price">{{ $total }} €</span>
            <div>
                <a class="pay-btn pasive-pay">Efectueaza plata</a>
                {{-- <a href="{{ route('pay.get') }}" class="pay-btn active-pay">Efectueaza plata</a> --}}
                <a href="{{ route('test.payment') }}" class="pay-btn active-pay">Efectueaza plata</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@stop
