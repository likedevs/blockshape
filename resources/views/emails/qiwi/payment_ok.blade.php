@extends('emails.layout')

@section('content')
    <h4>Bună {{ $name }}</h4>

    <p>Ai achitat Testarea Nutrițională și Fiziologică cu success.</p>

    <p>Numarul tranzactiei: <strong>{{ $txn_id }}</strong></p>

    <p>Veți primi pe email în decurs de {{ $period }} zile Testarea Nutrițională și Fiziologică.</p>

@endsection