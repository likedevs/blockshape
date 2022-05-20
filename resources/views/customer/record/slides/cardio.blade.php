@inject('glossary', 'App\Repositories\PressureTypesRepository')

<form novalidate="true" autocomplete="off" name="forms.cardio">
    <md-card>
        <md-card-content>
            <h2 class="md-headline">{{ trans('forms.record.pressure') }}</h2>

            <div layout="row" layout-sm="column">

                <div flex="45" flex-sm="100" layout="row">
                    <md-input-container flex>
                        <label>{{ trans('forms.record.pressure_rest.max') }}</label>
                        <input type="number" min="{{ config('measurements.pressure.sistolic.min') }}" max="{{ config('measurements.pressure.sistolic.max') }}" step="{{ config('measurements.pressure.sistolic.step') }}" ng-model="data.pressure_rest.max" required>
                    </md-input-container>

                    <md-input-container>
                        <label>X</label>
                    </md-input-container>

                    <md-input-container flex>
                        <label>{{ trans('forms.record.pressure_rest.min') }}</label>
                        <input type="number" min="{{ config('measurements.pressure.diastolic.min') }}" max="{{ config('measurements.pressure.diastolic.max') }}" step="{{ config('measurements.pressure.diastolic.step') }}" ng-model="data.pressure_rest.min" required>
                    </md-input-container>
                </div>
                <div flex></div>
                <div flex="45" flex-sm="100" layout="row">
                    <md-input-container flex>
                        <label>{{ trans('forms.record.pressure_load.max') }}</label>
                        <input type="number" min="{{ config('measurements.pressure.sistolic.min') }}" max="{{ config('measurements.pressure.sistolic.max') }}" step="{{ config('measurements.pressure.sistolic.step') }}" ng-model="data.pressure_load.max" ng-required="requireLoadPressure()">
                    </md-input-container>

                    <md-input-container>
                        <label>X</label>
                    </md-input-container>

                    <md-input-container flex>
                        <label>{{ trans('forms.record.pressure_load.min') }}</label>
                        <input type="number" min="{{ config('measurements.pressure.diastolic.min') }}" max="{{ config('measurements.pressure.diastolic.max') }}" step="{{ config('measurements.pressure.diastolic.step') }}" ng-model="data.pressure_load.min" ng-required="requireLoadPressure()">
                    </md-input-container>
                </div>

            </div>

            <h2 class="md-body-1">{{ trans('forms.record.pressure_reaction') }}</h2>

            <div layout>
                <md-radio-group flex layout="row" ng-model="data.pressure_type_id" label-area="Resultat tensiune" required>
                    @foreach($items = $glossary->all() as $item)
                        <md-radio-button value="{{ $item->id }}">{{ $item->name }}</md-radio-button>
                    @endforeach
                </md-radio-group>
            </div>
        </md-card-content>
    </md-card>

    <md-card>
        <md-card-content layout="row" layout-sm="column">
            <div flex="45">
                <h2 class="md-headline">{{ trans('forms.record.pulse') }}</h2>

                <md-input-container flex-sm="100">
                    <label>{{ trans('forms.record.pulse3') }}</label>
                    {{--<input type="number" min="{{ config('measurements.pulse.min') }}" max="{{ config('measurements.pulse.max') }}" step="{{ config('measurements.pulse.step') }}" ng-model="data.pulse3" ng-required="requireLoadPressure()">--}}

                    <md-select ng-model="data.pulse3">
                        <md-option ng-repeat="value in [{{ join(', ', range(config('measurements.pulse.min'), config('measurements.pulse.max'), config('measurements.pulse.step'))) }}]">@{{ value }}</md-option>
                    </md-select>
                </md-input-container>
            </div>

            <div flex>&nbsp;</div>
        </md-card-content>
    </md-card>

    <md-card>
        <md-card-content>

            <div layout layout-sm="column" layout-align="start center" layout-align-sm="start start">
                <h2 class="md-headline">{{ trans('forms.record.menstrual_cycle.title') }}</h2>

                <md-input-container layout-padding>
                    <md-checkbox ng-model="data.menstrual_cycle.menopause" aria-label="{{ trans('forms.record.menopause') }}">
                        {{ trans('forms.record.menopause') }}
                    </md-checkbox>
                </md-input-container>

                <span flex></span>
            </div>

            <div layout layout-wrap flex ng-if="! data.menstrual_cycle.menopause">
                <md-input-container flex="45" flex-sm="100" flex-md="45">
                    <label>{{ trans('forms.record.menstrual_cycle.first_date_user') }}</label>
                    <md-select ng-required="! data.menstrual_cycle.menopause" ng-disabled="data.menstrual_cycle.menopause" ng-model="data.menstrual_cycle.start_date">
                        <md-option ng-repeat="date in [{{ join(', ', range(1, 31)) }}]" ng-value="@{{ date }}">@{{ date }}</md-option>
                    </md-select>
                </md-input-container>

                <div flex></div>

                <md-input-container flex="45" flex-sm="100" flex-md="45">
                    <label>{{ trans('forms.record.menstrual_cycle.duration_user') }}</label>
                    <md-select ng-required="! data.menstrual_cycle.menopause" ng-disabled="data.menstrual_cycle.menopause" ng-model="data.menstrual_cycle.duration">
                        <md-option ng-repeat="duration in [-2, -1, {{ join(', ', range(24, 36)) }}]" ng-value="@{{ duration }}">
                            <span ng-if="-2 == duration">{{ trans('forms.record.after_childbirth') }}</span>
                            <span ng-if="-1 == duration">{{ trans('forms.record.menstrual_cycle.float') }}</span>
                            <span ng-if="duration > 0">@{{ duration }} zile</span>
                        </md-option>
                    </md-select>
                </md-input-container>

                <ul class="md-caption">
                    <li>
                        {{ trans('forms.record.menstrual_cycle.first_date_user_tooltip') }}
                    </li>
                    <li>
                        {{ trans('forms.record.menstrual_cycle.duration_user_tooltip') }}
                    </li>
                </ul>
            </div>

            <div layout>
                <span flex></span>
                <md-button class="md-primary" ng-click="slidePrev()">{!! trans('pagination.previous') !!}</md-button>
                <md-button class="md-primary" ng-disabled="! isStepValid('cardio')" ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
            </div>
        </md-card-content>
    </md-card>
</form>