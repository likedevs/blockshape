@inject('questions', 'quiz_questions')

<form novalidate="true" autocomplete="off" name="forms.nutrition">
<md-card layout="column">
    <md-card-content>
        <h2 class="md-headline">{{ trans('forms.record.nutrition') }}</h2>
        
        <md-input-container style="overflow: auto;">

            @foreach($questions as $question)
            <div layout ng-class="{'required': ! data.quiz[{{ $question->id }}]}">
                <span flex="45" layout layout-align="start center"><strong>{{ $question->question }}</strong></span>
                <md-radio-group flex layout="row" ng-model="data.quiz[{{ $question->id }}]" label-area="{{ $question->question }}" required>
                    @foreach($question->answers as $answer)
                    <md-radio-button value="{{ $answer->id }}">{{ $answer->answer }}</md-radio-button>
                    @endforeach
                </md-radio-group>
            </div>
            <md-divider></md-divider>
            @endforeach

        </md-input-container>
    </md-card-content>

    <div layout="row" layout-align="end center">
        <md-button class="md-primary" ng-click="slidePrev()">{{ trans('pagination.previous') }}</md-button>
        <md-button class="md-default md-warn" ng-disabled="! isStepValid('nutrition') || submitting" ng-click="finish()">{{ trans('pagination.finish') }}</md-button>
    </div>
</md-card>
</form>