@extends('app')

@section('content')

@inject('offices', 'App\Repositories\DepartmentsRepository')
@inject('figureTypes', 'App\Repositories\FigureTypesRepository')
@inject('diseases', 'App\Repositories\DiseasesRepository')
@inject('allergies', 'App\Repositories\AllergiesRepository')
@inject('excludes', 'App\Repositories\ExcludesRepository')
@inject('targets', 'App\Repositories\TargetsRepository')

<?php

$lists = [
    'bones'             => range(11, 19, 1),
    'departments'       => $offices->instructorBelongsTo($instructor)->toArray(),
    'figureTypes'       => $figureTypes->all()->toArray(),
    'diseases'          => $diseases->all(),
    'allergies'         => $allergies->all()->toArray(),
    'excludes'          => $excludes->all()->toArray(),
];//setForm('department');

?>

<div ng-controller="FormularController">
    <div ng-init="lists = {{ json_encode($lists) }}; setForm('department'); "></div>
    @if (isset($json))
    <div ng-init="data = {{ json_encode($json) }}"></div>
    @endif

    <md-tabs class="no-tab-data" md-no-ink="true" md-no-ink-bar="true" md-enable-disconnect="true" md-selected="currentSlide" md-no-pagination="true" md-swipe-content="false" md-dynamic-height="true">
        <md-tab label="office">
            @include('customer.record.slides.department')
        </md-tab>
        <md-tab label="setup">
            @include('customer.record.slides.setup')
        </md-tab>
        <md-tab label="record">
            @include('customer.record.slides.record')
        </md-tab>
        <md-tab label="cardio">
            @include('customer.record.slides.cardio')
        </md-tab>
        <md-tab label="schedule">
            @include('customer.record.slides.schedule')
        </md-tab>
        <md-tab label="diseases">
            @include('customer.record.slides.diseases')
        </md-tab>
        <md-tab label="nutrition">
            @include('customer.record.slides.nutrition')
        </md-tab>
    </md-tabs>

    {{--<pre>Data: @{{ data | json }}<hr />Forms: @{{ forms | json }}</pre>--}}
</div>
@append


@section('scripts')
    <script>
        window.onbeforeunload = function() {
            var message = '{!! trans('forms.messages.unload')  !!}';

            return message;
        }
    </script>
@append