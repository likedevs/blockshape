@extends('emails.layout')

@section('content')
    <h4>Bună {{ $name }}</h4>

    <p>Ai achitat Testare Nutrițională și Fiziologică cu success.</p>

    <p>Detaliile tranzacției:</p>

    <ul>
        <li>Descriere serviciului: <strong>{{ trans('user.payment.vb.description') }}</strong></li>
        <li>Merchant: <strong>{{ $merchant->getName() }}</strong></li>
        <li>URL: <a href="{{ $merchant->getUrl() }}">{{ $merchant->getUrl() }}</a></li>
        <li>Data achitării: <strong>{{ \Carbon\Carbon::createFromFormat('YmdHis', $order->details['TIMESTAMP'])->toDateString() }}</strong></li>
        <li>Suma achitată: <strong>{{ $order->details['AMOUNT'] }} {{ $order->details['CURRENCY'] }}</strong></li>
        <li>Numărul tranzacției: <strong>{{ $order->details['ORDER'] }}</strong></li>
        <li>Numărul de referență: <strong>{{ $order->details['RRN'] }}</strong></li>
        <li>Codul de autorizare: <strong>{{ $order->details['APPROVAL'] }}</strong></li>
        <li>Tipul tranzacției: <strong>achitare</strong></li>
        <li>Data livrării: <strong>{{ \Carbon\Carbon::createFromFormat('YmdHis', $order->details['TIMESTAMP'])->addDays($order->period)->toDateString() }}</strong></li>
    </ul>
@endsection