@extends('front.app')

@section('content')

@include('front.partials.account-tabs')

<?php
    return redirect('/page/consultation');
 ?>
    <h2 class="text-center">Page does not exist yet</h2>


@include('front.partials.prefooter')

@include('front.partials.footer-line')

@stop
