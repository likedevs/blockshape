<form novalidate="true" autocomplete="off" name="forms.diseases">
<md-card layout="column" flex>
    <md-card-content layout="row">
        <div flex layout="column">
                <h2 class="md-headline">{{ trans('forms.record.diseases') }}</h2>

                <div layout="column">
                    <div ng-repeat="group in lists.diseases">
                        <div ng-if="group.children.length" style="margin-bottom: 30px;">
                            <h2 class="md-subhead">@{{ group.name }}</h2>
                            <md-checkbox style="margin-left: 30px;" ng-repeat="disease in group.children" ng-checked="exists(disease.id, 'diseases')" ng-click="toggle(disease.id, 'diseases')" class="md-body-1">@{{ disease.name }}</md-checkbox>
                        </div>

                        <h2 ng-if="group.children.length == 0" class="md-subhead">
                            <md-checkbox ng-checked="exists(group.id, 'diseases')" ng-click="toggle(group.id, 'diseases')">@{{ group.name }}</md-checkbox>
                        </h2>
                    </div>
                </div>

                <md-input-container>
                    <label>{{ trans('forms.record.other') }}</label>
                    <textarea ng-model="data.other_diseases" cols="30" rows="4"></textarea>
                </md-input-container>
        </div>
        <div flex layout="column">
            <div layout="column">
                <h2 class="md-headline">{{ trans('forms.record.allergies') }}</h2>
                <md-checkbox class="md-body-1" ng-repeat="allergy in lists.allergies" ng-checked="exists(allergy.id, 'allergies')" ng-click="toggle(allergy.id, 'allergies')">@{{ allergy.name }}</md-checkbox>
            </div>

            <md-input-container>
                <label>{{ trans('forms.record.other') }}</label>
                <textarea ng-model="data.other_allergies" cols="30" rows="4"></textarea>
            </md-input-container>

            <div layout="column">
                <h2 class="md-headline">{{ trans('forms.record.food_excludes') }}</h2>
                <md-checkbox ng-repeat="exclude in lists.excludes" ng-checked="exists(exclude.id, 'excludes')" ng-click="toggle(exclude.id, 'excludes')">@{{ exclude.name }}</md-checkbox>
            </div>

            <md-input-container>
                <label>{{ trans('forms.record.other') }}</label>
                <textarea ng-model="data.other_excludes" cols="30" rows="4"></textarea>
            </md-input-container>
        </div>
    </md-card-content>

    <md-divider></md-divider>

    <md-card-content layout="row">
        <span flex></span>
        <md-button class="md-primary" ng-click="slidePrev()">{{ trans('pagination.previous') }}</md-button>
        <md-button class="md-primary" ng-disabled="! isStepValid('diseases')" ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
    </md-card-content>
</md-card>
</form>