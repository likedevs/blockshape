<div class="step">
    Pas 4
</div>
<form novalidate="true" autocomplete="off" name="forms.schedule">
    <input type="hidden" ng-model="selectedDays" ng-validate-count="7" value="@{{ selectedDays }}">
    {{--<input type="hidden" ng-model="workoutDays" ng-validate-count="3" value="@{{ workoutDays }}" />--}}
    {{--<input type="hidden" ng-model="restDays" ng-validate-count="3" value="@{{ restDays }}" />--}}
    <input type="hidden" ng-model="dischargingDays" ng-validate-count="1" value="@{{ dischargingDays }}" />
    <md-card>
        <md-card-content>
            {{--<h2 class="md-headline">{{ trans('forms.record.schedule_user') }}</h2>--}}

            <ul class="md-caption">
                <li>{{ trans('forms.record.activity_warning') }}</li>
                <li>{{ trans('forms.record.go_next_text') }}</li>
                <li class="color-red">{{ trans('forms.record.detox_warning') }}</li>
            </ul>

            {{--<ul class="color-red md-caption">--}}
                {{--<li ng-if="dischargingDays > 1">--}}
                    {{--{{ trans('forms.record.multiple_detox_days_alert') }}--}}
                {{--</li>--}}
            {{--</ul>--}}

            <div layout="column" flex layout-padding class="schedule">
                @foreach(['mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun'] as $i => $day)
                    <ng-schedule-day
                            day="{{ $day }}"
                            weekday="{{ trans('forms.days.' . $day) }}"
                            num="{{ ++$i }}"
                            load="{{ trans('result.schedule.day_type.activity') }}"
                            rest="{{ trans('result.schedule.day_type.rest') }}"
                            discharging="{{ trans('result.schedule.day_type.discharging') }}"
                            hour="{{ trans('result.schedule.hour') }}">
                    </ng-schedule-day>
                @endforeach
            </div>
        </md-card-content>

        <div layout="row" layout-align="end center">
            <md-button class="md-primary" ng-click="slidePrev()">{{ trans('pagination.previous') }}</md-button>
            <md-button class="md-primary" ng-disabled="! isStepValid('schedule')"
                       ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
        </div>
    </md-card>
</form>
