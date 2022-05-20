@extends('user')

@section('content')
    <md-card>
        <md-card-content>
            <h1 class="md-headline">{{ trans('user.payment.vb.success.header') }}</h1>

            <p class="md-body-1">
                Felicitări, ai achitat "Testare Nutrițională și Fiziologică" cu success.
            </p>
        </md-card-content>
    </md-card>
@endsection