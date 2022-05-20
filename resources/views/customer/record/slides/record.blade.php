<form name="forms.record" novalidate="true" autocomplete="off">
<md-card layout="column">
	<md-card-content>
        
        <div layout="row">
            <div flex="50">
            <h2 class="md-headline">{{ trans('forms.record.measurements') }}</h2>

            @foreach(['talia1','talia2', 'talia3', 'buttocks','thigh1', 'thigh2', 'shoulders', 'bone_radius'] as $field)
            <?php $options = trans('forms.measurements.options')[$field]; ?>
            <div layout="row">
                <div flex="25" layout layout-align="start center">
                    <span class="md-subhead">
                        {{ $options['label'] }} ({{ $options['short'] }})
                        <md-icon>
                            <md-tooltip md-direction="right">{{ $options['hint'] }}</md-tooltip>
                            help_outline
                        </md-icon>
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

            <div flex="50" layout="column">
                <h2 class="md-headline">{{ trans('forms.record.figure_type') }}</h2>

                <div layout layout-align="center top">
                    <md-radio-group flex="50" ng-model="data.figure_type_id" label-area="{{ trans('forms.record.figure_type') }}i" required layout="column">
                        <md-radio-button value="@{{ type.id }}" ng-repeat="type in lists.figureTypes">
                            @{{ type.name }}
                        </md-radio-button>
                    </md-radio-group>
                        
                    <div layout="column" flex="50" layout-align="center center">
                        <img ng-if="data.figure_type_id" ng-src="@{{ constitutionImage() }}" alt="" />
                    </div>
                </div>
            </div>
        </div> 
    </md-card-content>
    
    <div layout="row" layout-align="end center">
    	<md-button class="md-primary" ng-click="slidePrev()">{{ trans('pagination.previous') }}</md-button>
    	<md-button class="md-primary" ng-disabled="! isStepValid('record')" ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
    </div>	
</md-card>
</form>