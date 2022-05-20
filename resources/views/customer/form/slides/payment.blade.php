<h1 class="md-headline">Datele au fost transmise</h1>
<form novalidate="true" autocomplete="off" name="forms.checkout">
    {{-- <md-card layout="row">
        <md-card-content layout="column" flex layout-padding>
            <h1 class="md-headline">{{ trans('user.payment.select_offer') }}</h1>

            <div layout="row">
                <md-radio-group layout="row" ng-model="payment.offer" required>
                    <md-radio-button
                            ng-value="offer.id"
                            ng-repeat="offer in lists.offers"
                            aria-label="@{{ offer.title }}">
                        @{{ offer.title }} (@{{ offer.price }} {{ site()->currency }})
                    </md-radio-button>
                </md-radio-group>

                <div flex="5"></div>

                <div layout="column" flex>
                    <span class="md-caption">{{ trans('user.payment.to_pay') }}</span>
                    <h1 class="md-display-2"
                        style="margin-top: 10px; margin-bottom:10px;">@{{ offerPrice() }} {{ site()->currency }}</h1>
                </div>
            </div>

            <p class="md-caption color-red">
                {{ trans('user.payment.change_offer_alert') }}
            </p>
        </md-card-content>
    </md-card>

    <md-divider></md-divider> --}}




    <md-card>

        <md-card-content layout-padding class="btn-space">
            {{-- <h1 class="md-headline">{{ trans('user.payment.select_method') }}</h1> --}}


            @if (1 == site_id())
                @include('customer.form.slides.payments.md')
            @elseif (2 == site_id())
                @include('customer.form.slides.payments.ro')
            @endif
            <div layout >
                <md-button flex class="main-btn" ng-disabled="! isStepValid('checkout')"
                           ng-click="placeOrder()">vezi programul elaborat
                </md-button>
            </div>
        </md-card-content>
    </md-card>

    {{-- <div layout>
        <a href="{{ route('main.record') }}">Primeste receta</a>
    </div> --}}


</form>
