@extends('user')

@section('content')

    <?php
    $genders = [
            [
                    'label'    => trans('user.register.gender.female'),
                    'value'    => 'female',
                    'disabled' => false
            ],
            [
                    'label'    => trans('user.register.gender.male'),
                    'value'    => 'male',
                    'disabled' => true,
                    'message'  => trans('user.register.gender.disabled')
            ],
    ];
    ?>

    <style media="screen">
        .img-top{
            position: absolute;
            top: 220px;
        }
    </style>

    <md-card flex="66" style="margin-top: 200px;">
        <md-card-content class="btn-space" ng-controller="UserRegisterController"
                         ng-init="data.genders = {{ json_encode($genders) }}">

                @if ($errors)
                    <ul class="errors">
                        @foreach ($errors->all() as $key => $value)
                            <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                @endif
                <md-tabs class="no-tab-data" md-no-ink="true" md-no-ink-bar="true" md-enable-disconnect="true"
                         md-selected="currentSlide" md-no-pagination="true" md-swipe-content="false"
                         md-dynamic-height="true">
                    <md-tab label="Email">
                        @include('auth.register.email')
                    </md-tab>
{{--                    <md-tab label="Data">--}}
{{--                        @include('auth.register.data')--}}
{{--                    </md-tab>--}}
                </md-tabs>
        </md-card-content>
    </md-card>
@endsection
