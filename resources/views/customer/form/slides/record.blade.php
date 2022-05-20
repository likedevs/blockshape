<div class="step">
    Pas 2
</div>
<form name="forms.record" novalidate="true" autocomplete="off">
<md-card>
	<md-card-content>

        <div layout="row" layout-sm="column" layout-md="column">
            <div flex="30" flex-md="100" flex-sm="100">
                <h2 class="md-headline">{{ trans('forms.record.measurements') }}</h2>

                @foreach($measurements = ['talia1','talia2', 'talia3', 'buttocks','thigh1', 'thigh2', 'shoulders', 'bone_radius'] as $field)
                <?php $options = trans('forms.measurements.options')[$field]; ?>
                <div layout="row">
                    <div flex="25" flex-sm="40" layout layout-align="start center">
                        <span class="md-subhead">
                            {{--<a ng-click="showMeasurementImage($event, '{{ $field }}')">--}}
                                {{--<md-icon>--}}
                                    {{--camera_alt--}}
                                {{--</md-icon>--}}
                            {{--</a>--}}

                            {{ $options['label'] }} ({{ $options['short'] }})
                        </span>
                    </div>
                    <div flex>
                        @if ('bone_radius' == $field)
                            <md-input-container>
                                <md-select aria-label="{{ $options['label'] }}" ng-model="data.{{ $field }}" required>
                                    <md-option ng-repeat="option in [{{ join(',', range(config("measurements.{$field}.min"), config("measurements.{$field}.max"), 1)) }}]">@{{ option }}</md-option>
                                </md-select>
                            </md-input-container>
                        @else
                            <md-input-container>
                                <input aria-label="{{ $options['label'] }}" type="number" min="{{ config("measurements.{$field}.min") }}" max="{{ config("measurements.{$field}.max") }}" step="1" ng-model="data.{{ $field }}" required>
                            </md-input-container>
                        @endif
                    </div>
                    <div flex="15" layout layout-align="center center">
                        <span class="md-subhead"><!-- @{{ data.{{ $field }} || '-' }} --> Cm</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div flex="70" flex-md="100" flex-sm="100" style="margin-left: 100px;">
                <h2 class="md-headline">{{ trans('forms.record.how_to_measure') }}</h2>
                @foreach(array_chunk($measurements, 3) as $measurements)
                <div layout="row" layout-wrap>
                    @foreach($measurements as $field)
                        <a class="measurement-thumbnail" ng-click="showMeasurementImagePopup($event, '{{ $field }}')">
                            <img src="/images/measurements/thumbs/{{ $field }}.jpg">
                            <span class="md-headline" layout="column" layout-align="center center">{{ config("measurements.{$field}.name") }}</span>
                        </a>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </md-card-content>

    <div layout="row" layout-align="end center">
    	<md-button class="md-primary" ng-click="slidePrev()">{{ trans('pagination.previous') }}</md-button>
    	<md-button class="md-primary" ng-disabled="! isStepValid('record')" ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
    </div>
</md-card>
</form>
