@extends('emails.layout')

@section('content')
    <h4>Bună</h4>

    <p>Pentru a primi testarea nutrițională și fiziologcă e necesar confirmarea adresei de email.</p>

    <p>Introdu codul pe pagina de înregistrare - <strong>{{ $token }}</strong></p>
@endsection