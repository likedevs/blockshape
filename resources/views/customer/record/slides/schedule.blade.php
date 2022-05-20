<form novalidate="true" autocomplete="off" name="forms.schedule">
    <md-card>
        <md-card-content>
            <h2 class="md-headline">{{ trans('forms.record.schedule') }}</h2>

            <p ng-if="! dischargingDays || dischargingDays > 1" style="color: rgb(244,67,54);"><md-icon class="material-icons md-warn">announcement</md-icon> {{ trans('forms.record.detox_warning') }}</p>

            <div layout="column" flex layout-padding class="schedule">
                <input type="hidden" ng-model="selectedDays" ng-validate-count="7" value="@{{ selectedDays }}">
                {{--<input type="hidden" ng-model="workoutDays" ng-validate-count="3" value="@{{ workoutDays }}" />--}}
                {{--<input type="hidden" ng-model="restDays" ng-validate-count="3" value="@{{ restDays }}" />--}}
                <input type="hidden" ng-model="dischargingDays" ng-validate-count="1" value="@{{ dischargingDays }}" />
                @foreach(['mon', 'tue', 'wen', 'thu', 'fri', 'sat', 'sun'] as $i => $day)
                    <ng-schedule-day
                            day="{{ $day }}"
                            weekday="{{ trans('forms.days.' . $day) }}"
                            num="{{ ++$i }}"
                            load="{{ trans('result.schedule.day_type.activity') }}"
                            rest="{{ trans('result.schedule.day_type.rest') }}"
                            discharging="{{ trans('result.schedule.day_type.discharging') }}"
                            hour="{{ trans('result.schedule.hour') }}"
                    ></ng-schedule-day>
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