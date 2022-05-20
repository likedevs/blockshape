<div layout>
    <div flex layout="column">
        <md-radio-group ng-model="payment.gateway" required>
            <md-radio-button value="cc-vb" aria-label="VictoriaBank">
                {{ trans('user.payment.card') }}
            </md-radio-button>
        </md-radio-group>

        <div layout="row">
            <img style="width: 90px" src="/images/payments/visa-mastercard.png"/>
            <span flex="5"></span>
            <p class="md-body-1">{{ trans('user.payment.card_info') }}</p>
        </div>

        <div flex></div>
    </div>
</div>