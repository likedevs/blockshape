@inject('offers', 'App\Repositories\OffersRepository')

<form novalidate="true" autocomplete="off" name="forms.department">
    <md-card>
        <md-card-content layout="column">
            <div layout="row">
                <div flex layout="column">
                    <h2 class="md-headline">{{ trans('result.labels.test_date') }}</h2>

                    <div layout="row">
                        <md-input-container>
                            {{--{!! Form::input('date', 'birth_date', isset($user) ? $user->birth_date : null, ['required' => true, 'ng-model' => 'customer.birth_date']) !!}--}}
                            <label>{{ trans('forms.customer.birth_date_day') }}</label>
                            <md-select ng-model="data.created_at.day" required>
                                <md-option ng-value="day"
                                           ng-repeat="day in [{{ join(',', range(1, 31, 1)) }}]">
                                    @{{ day }}
                                </md-option>
                            </md-select>
                        </md-input-container>

                        <md-input-container>
                            <label>{{ trans('forms.customer.birth_date_month') }}</label>
                            <md-select ng-model="data.created_at.month" required>
                                <md-option ng-value="month.month"
                                           ng-repeat="month in {{ json_encode(months_translated_list()) }}">
                                    @{{ month.name }}
                                </md-option>
                            </md-select>
                        </md-input-container>

                        <md-input-container>
                            <label>{{ trans('forms.customer.date_year') }}</label>
                            <md-select ng-model="data.created_at.year" required>
                                <md-option ng-value="year"
                                           ng-repeat="year in [{{ join(',', range(date('Y'), date('Y', strtotime("-100 year")), -1)) }}]">
                                    @{{ year }}
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>
                </div>
                <div flex layout="column">
                    <h2 class="md-headline">{{ trans('result.labels.payment_date') }}</h2>

                    <div layout="row">
                        <md-input-container>
                            {{--{!! Form::input('date', 'birth_date', isset($user) ? $user->birth_date : null, ['required' => true, 'ng-model' => 'customer.birth_date']) !!}--}}
                            <label>{{ trans('forms.customer.birth_date_day') }}</label>
                            <md-select ng-model="data.purchased_at.day" required>
                                <md-option ng-value="day"
                                           ng-repeat="day in [{{ join(',', range(1, 31, 1)) }}]">
                                    @{{ day }}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>

                            <label>{{ trans('forms.customer.birth_date_month') }}</label>
                            <md-select ng-model="data.purchased_at.month" required>
                                <md-option ng-value="month.month"
                                           ng-repeat="month in {{ json_encode(months_translated_list()) }}">
                                    @{{ month.name }}
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>{{ trans('forms.customer.date_year') }}</label>
                            <md-select ng-model="data.purchased_at.year" required>
                                <md-option ng-value="year"
                                           ng-repeat="year in [{{ join(',', range(date('Y'), date('Y', strtotime("-100 year")), -1)) }}]">
                                    @{{ year }}
                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>
                </div>
                <div flex></div>
            </div>

            <div layout="row">
                <div flex layout="column">
                    <h2 class="md-headline">{{ trans('forms.department.workout.label') }}</h2>

                    <md-radio-group ng-model="data.workout" layout="row" layout-sm="column">
                        <md-radio-button
                            value="@{{ key }}"
                            ng-repeat="(key, value) in {{ json_encode(trans('forms.department.workout.options')) }}">
                            @{{ value }}
                        </md-radio-button>
                    </md-radio-group>
                </div>
                <div flex layout="column">
                    <h2 class="md-headline">{{ trans('forms.department.priority.label') }}</h2>
                    <md-radio-group ng-model="data.offer_id" required layout="row" layout-sm="column">
                        <md-radio-button
                            ng-repeat="offer in {{ json_encode($offers->all('offline')->toArray()) }}"
                            value="@{{ offer.id }}" class="md-primary">
                            @{{ offer.title }}
                        </md-radio-button>
                    </md-radio-group>
                </div>
                <div flex layout="column">
                    <h2 class="md-headline">{{ trans('forms.department.discount.label') }}</h2>
                    <md-input-container>
                        {{--<label>{{ trans('forms.department.discount.hint') }}</label>--}}
                        <md-select ng-model="data.discount">
                            @foreach(range(0, 50, 5) as $discount)
                            <md-option value="{{ $discount }}">
                                {{ (0 == $discount ? trans('forms.department.discount.none') : ($discount . '%'))}}
                            </md-option>
                            @endforeach
                        </md-select>
                    </md-input-container>
                </div>
            </div>

            <div layout="row">
                <div layout="column">
                    <input type="hidden" ng-model="data.office_id" required>
                    <h2 class="md-headline">{{ trans('result.labels.office') }}</h2>

                    <div class="department-list" layout="row">
                        <md-button flex ng-repeat="dep in lists.departments"
                                   ng-class="{'md-warn' : data.office_id == dep.id, 'md-primary' : data.office_id == dep.id}"
                                   class=" md-raised department" ng-click="setDepartment(dep)">@{{ dep.name }}</md-button>
                    </div>
                </div>
            </div>
        </md-card-content>

        <div layout="row" layout-align="end center">
            <md-button class="md-primary" ng-disabled="! isStepValid('department')"
                       ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
        </div>
    </md-card>
</form>