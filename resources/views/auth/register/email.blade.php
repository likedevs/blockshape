<md-card-content layout-padding>
    {{-- <div ng-if="! email.requested">
        <form ng-submit="requestToken()" layout="column">
            <md-input-container>
                <label>1. {{ trans('user.register.email') }}</label>
                {!! Form::email('email', null, ['ng-model' => 'user.email', 'ng-required' => true]) !!}
            </md-input-container>

            <md-button flex ng-disabled="! user.email || submitting" class="md-primary md-raised" type="submit">{{ trans('user.buttons.request_confirmation') }}</md-button>
        </form>
    </div> --}}

    {{-- <div ng-if="email.requested && ! email.confirmed" layout="column"> --}}

    <div layout="column">
        {{-- <p class="md-body-1 color-red">
            {{ trans('user.register.check_email') }}
        </p> --}}

        <form ng-submit="confirmToken()" layout="column">
            {{-- <md-input-container>
                <label>2. {{ trans('user.register.token') }}</label>
                {!! Form::text('token', 'null', ['ng-model' => 'email.token']) !!}
            </md-input-container> --}}

            <md-button  class="main-btn" type="submit">ENTER BODY PARAMETERS</md-button>
        </form>

    </div>


    {{-- <div style="color: darkgreen; text-align: center" ng-if="email.confirmed" layout="column">
        <div><i class="fa fa-check fa-4x"></i></div>
        <div>{{ trans('user.register.confirmed') }}</div>
        <br />

        <md-button flex ng-if="email.user" class="md-primary md-raised" ng-click="goToFormular()">{{ trans('pagination.next') }}</md-button>

        <md-button flex ng-if="! email.user" class="md-primary md-raised" ng-click="slideNext()">{{ trans('pagination.next') }}</md-button>
    </div> --}}
</md-card-content>
