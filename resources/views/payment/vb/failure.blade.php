@extends('user')

@section('content')
    <md-card>
        <md-card-content>
            <h1 class="md-headline">{{ trans('user.payment.vb.failure.header') }}</h1>

            <p class="md-body-1">
                Ne cerem scuze, achitare a eșuat, incercați mai tîrziu!
            </p>
        </md-card-content>
    </md-card>
@endsection