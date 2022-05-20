@extends('standalone')

@section('content')
    <link rel="stylesheet" href="{{ elixir('css/landing.css') }}">

    @include('landing.header')

    <md-content class="md-padding" layout="column" layout-wrap layout-align="center center" ng-cloak>

        <span class="md-display-2">{{ $page->title }}</span>

        <div layout="column">

            <?php
        //    $mapUrl = http_build_query([
        //            'center' => '47.0317484,28.8224649',
        //            'zoom'  => 17,
        //            'size'  => '570x300',
        //            'maptype' => 'roadmap',
        //            'markers' => 'color:blue|label:U|47.0317484,28.8224649'
        //    ]);
            ?>
            {!! $page->body !!}
        </div>
    </md-content>

    @include('landing.footer')
@endsection
