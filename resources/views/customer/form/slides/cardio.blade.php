@inject('glossary', 'App\Repositories\PressureTypesRepository')
<div class="step">
    Pas 3
</div>
<form novalidate="true" autocomplete="off" name="forms.cardio">
    <md-card>
        <md-card-content>
            <h1 class="md-headline">{{ trans('forms.record.pressure_user') }}</h1>
            <span class="md-caption" style="text-decoration: underline; margin-bottom: 30px; display: block;">{!! trans('forms.record.pressure_note') !!}</span>

            <div layout="row" layout-sm="column">
                <div flex="45" flex-sm="100" layout="column">
                    <h2 class="md-body-2" style="font-weight: 600; line-height: 1;">{{ trans('forms.record.set_pressure_rest') }}</h2>
                    <span>&nbsp;</span>
                    <div layout="row">
                        <md-input-container flex>
                            <label>{{ trans('forms.record.pressure_rest_user.max') }}</label>
                            <input type="number" min="{{ config('measurements.pressure.sistolic.min') }}" max="{{ config('measurements.pressure.sistolic.max') }}" step="{{ config('measurements.pressure.sistolic.step') }}" ng-model="data.pressure_rest.max">
                        </md-input-container>

                        <md-input-container>
                            <label>X</label>
                        </md-input-container>

                        <md-input-container flex>
                            <label>{{ trans('forms.record.pressure_rest_user.min') }}</label>
                            <input type="number" min="{{ config('measurements.pressure.diastolic.min') }}" max="{{ config('measurements.pressure.diastolic.max') }}" step="{{ config('measurements.pressure.diastolic.step') }}" ng-model="data.pressure_rest.min">
                        </md-input-container>
                    </div>
                </div>
                <div flex></div>
                <div flex="45" flex-sm="100" layout="column">
                    <h2 class="md-body-2" style="font-weight: 600; line-height: 1;">
                        {{ trans('forms.record.set_pressure_load') }} ({!! trans('forms.record.pressure_instructions') !!})
                    </h2>
                    <div class="color-red md-caption">
                        <span ng-if="highRestPressure()">
                            {{ trans('forms.record.high_pressure_alert') }}
                        </span>&nbsp;
                        <span ng-if="requireLoadPressure()">
                            {{ trans('forms.record.high_pressure_required') }}
                        </span>&nbsp;
                    </div>
                    <div layout="row">
                        <md-input-container flex>
                            <label>{{ trans('forms.record.pressure_load_user.max') }}</label>
                            <input type="number" ng-disabled="highRestPressure()" min="{{ config('measurements.pressure.sistolic.min') }}" max="{{ config('measurements.pressure.sistolic.max') }}" step="{{ config('measurements.pressure.sistolic.step') }}" ng-model="data.pressure_load.max" ng-required="requireLoadPressure()">
                        </md-input-container>

                        <md-input-container>
                            <label>X</label>
                        </md-input-container>

                        <md-input-container flex>
                            <label>{{ trans('forms.record.pressure_load_user.min') }}</label>
                            <input type="number" ng-disabled="highRestPressure()" min="{{ config('measurements.pressure.diastolic.min') }}" max="{{ config('measurements.pressure.diastolic.max') }}" step="{{ config('measurements.pressure.diastolic.step') }}" ng-model="data.pressure_load.min" ng-required="requireLoadPressure()">
                        </md-input-container>
                    </div>
                </div>
            </div>
        </md-card-content>
    </md-card>

    <md-card layout="row">
        <md-card-content layout="row" layout-sm="column" flex>
            <div flex="35" layout="column">
                <h2 class="md-headline">{{ trans('forms.record.pulse_user') }}</h2>



                <span class="md-caption">{!! trans('forms.record.pulse_note') !!}</span>
                <span class="md-caption">{!! trans('forms.record.pulse_result_note') !!}</span>

                <md-input-container flex="20" flex-sm="100">
                    <label>{{ trans('forms.record.pulse3_user') }}</label>
                    {{--<input type="number" min="{{ config('measurements.pulse.min') }}" max="{{ config('measurements.pulse.max') }}" step="{{ config('measurements.pulse.step') }}" ng-model="data.pulse3" ng-required="requireLoadPressure()">--}}

                    <div class="color-red md-caption" style="margin-top: 10px;">
                        <span ng-if="highRestPressure() || highLoadPressure()">
                            {{ trans('forms.record.high_pressure_alert') }}
                        </span>&nbsp;
                    </div>

                    <md-select ng-model="data.pulse3" ng-disabled="highRestPressure() || highLoadPressure()">
                        <md-option ng-repeat="value in [{{ join(', ', range(config('measurements.pulse.min'), config('measurements.pulse.max'), config('measurements.pulse.step'))) }}]">@{{ value }}</md-option>
                    </md-select>
                </md-input-container>
            </div>

            <div flex>
                <img src="{{ asset('images/fandari.gif') }}" alt="fandari" />
            </div>
        </md-card-content>
    </md-card>

    <md-card>
        <md-card-content>

            <div layout layout-sm="column" layout-align="start center" layout-align-sm="start start">
                <h2 class="md-headline">{{ trans('forms.record.menstrual_cycle.title') }}</h2>

                <md-input-container flex layout-padding>
                    <md-checkbox ng-model="data.menstrual_cycle.menopause" aria-label="{{ trans('forms.record.menopause') }}">
                        {{ trans('forms.record.menopause') }}
                    </md-checkbox>
                </md-input-container>

                <span flex></span>
            </div>

            <div layout layout-wrap flex ng-if="! data.menstrual_cycle.menopause">
                <md-input-container flex="45" flex-sm="100" flex-md="45">
                    <span class="md-caption">{{ trans('forms.record.menstrual_cycle.first_date_user_tooltip') }}</span>
                    <label>{{ trans('forms.record.menstrual_cycle.first_date_user') }}</label>
                    <md-select ng-required="! data.menstrual_cycle.menopause" ng-disabled="data.menstrual_cycle.menopause" ng-model="data.menstrual_cycle.start_date">
                        <md-option ng-repeat="date in [{{ join(', ', range(1, 31)) }}]" ng-value="@{{ date }}">@{{ date }}</md-option>
                    </md-select>
                </md-input-container>

                <div flex></div>

                <md-input-container flex="45" flex-sm="100" flex-md="45">
                    <span class="md-caption">{{ trans('forms.record.menstrual_cycle.duration_user_tooltip') }}</span>
                    <label>{{ trans('forms.record.menstrual_cycle.duration_user') }}</label>
                    <md-select ng-required="! data.menstrual_cycle.menopause" ng-disabled="data.menstrual_cycle.menopause" ng-model="data.menstrual_cycle.duration">
                        <md-option ng-repeat="duration in [-1, -2, {{ join(', ', range(24, 36)) }}]" ng-value="@{{ duration }}">
                            <span ng-if="-2 == duration">{{ trans('forms.record.after_childbirth') }}</span>
                            <span ng-if="-1 == duration">{{ trans('forms.record.menstrual_cycle.float') }}</span>
                            <span ng-if="duration > 0">@{{ duration }} zile</span>
                        </md-option>
                    </md-select>
                </md-input-container>
            </div>

            <div layout>
                <span flex></span>
                <md-button class="md-primary" ng-click="slidePrev()">{!! trans('pagination.previous') !!}</md-button>
                <md-button class="md-primary" ng-disabled="! isStepValid('cardio')" ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
            </div>
        </md-card-content>
    </md-card>

</form>
