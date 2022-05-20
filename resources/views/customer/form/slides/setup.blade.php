<div class="step">
    Pas 1
</div>
<form novalidate="true" autocomplete="off" name="forms.setup">
<md-card>
    <md-card-content>
        <h2 class="md-headline">{{ trans('forms.record.scope') }}</h2>
        <md-input-container>
            <md-radio-group ng-model="data.target_id" label-area="Scope" required layout="row" layout-sm="column">
                @foreach($targets->all() as $target)
                <md-radio-button value="{{ $target->id }}">
                    {{ $target->name }}
                </md-radio-button>
                @endforeach
            </md-radio-group>
        </md-input-container>
    </md-card-content>
    <md-divider></md-divider>
</md-card>
<md-card>
    <md-card-content class="orange">
        <h2 class="md-headline">{{ trans('forms.record.setup') }}</h2>

        <div layout="row" layout-wrap>
            <md-input-container flex flex-sm="50" flex-md="50">
                <label>{{ trans('forms.record.height') }}</label>
                <input placeholder="{{ trans('forms.record.height_placeholder') }}" type="number" min="{{ config('measurements.height.min') }}" max="{{ config('measurements.height.max') }}" step="{{ config('measurements.height.step') }}" ng-model="data.height" required>
            </md-input-container>
            <div flex="5"></div>
            <md-input-container flex flex-sm="50" flex-md="50">
                <label>{{ trans('forms.record.current_weight') }}</label>
                <input placeholder="{{ trans('forms.record.current_weight_placeholder') }}" type="number" min="{{ config('measurements.weight.min') }}" max="{{ config('measurements.weight.max') }}" step="{{ config('measurements.weight.step') }}" ng-model="data.current_weight" required>
            </md-input-container>
            <div flex="5"></div>
            <md-input-container flex flex-sm="50" flex-md="50">
                <label>{{ trans('forms.record.target_weight') }}</label>
                <input placeholder="{{ trans('forms.record.target_weight_placeholder') }}" type="number" min="{{ config('measurements.weight.min') }}" max="{{ config('measurements.weight.max') }}" step="{{ config('measurements.weight.step') }}"  ng-model="data.target_weight" required>
            </md-input-container>
        </div>
    </md-card-content>

    <div layout="row" layout-align="end center">
        <div class="md-primary center-btn"></div>
        <div class="md-primary center-btn"></div>
        <a class="md-primary center-btn" href="/customer/signup" layout-align="end right">« Back</a>
        <md-button class="md-primary center-btn" ng-disabled="! isStepValid('setup')" ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
        <div class="md-primary center-btn"></div>
        <div class="md-primary center-btn"></div>
    </div>
</md-card>

</form>
