@inject('glossary', 'App\Repositories\PressureTypesRepository')


    {{-- <md-card layout="column" flex ng-if="payment.gateway == 'qiwi'">
        <md-card-content>

            <h1 class="md-headline">Qiwi</h1>

            <div layout layout-padding>
                <div flex>
                    <span class="md-display-2">Numărul comenzii tale este:</span>
                </div>
                <div flex layout="row" layout-align="start center">
                    <input type="text" ng-model="payment.order.order_id" readonly class="md-display-2" style="width: 240px; text-align: center; background: #c4c4c4">

                    @if ('local' == env('APP_ENV'))
                    <md-button class="md-button color-red" ng-click="cancelOrder($event)">ANULEAZĂ</md-button>
                    @endif
                </div>
            </div>

            <div layout layout-padding>
                <div flex class="md-body-1">
                    Te rugăm sa faci plata în maxim 72 ore de la crearea comenzii.<br />
                    Poți efectua plata pină la: @{{ payment.order.expires_at }}
                </div>
                <div flex class="md-body-1">
                    Cum faci plata? <br />
                    Pentru a achita comanda, notează-ți numărul comenzii și mergi la cel mai apropiat terminal Qiwi.<br />
                    <a target="_blank" href="http://qiwi.md/md/private/address/">Vezi lista terminalelor</a>
                </div>
            </div>

            <div layout="column" layout-padding style="border: 1px solid #000;" class="md-body-1">
                <strong>Urmează următorii pași pentru a efectua plata:</strong>
                <ol style="margin-left: 40px;">
                    <li>Pe ecranul terminalului accesează rubrica ”Alte servicii”</li>
                    <li>Click butonul UnicaSport</li>
                    <li>Introdu numărul comenzii tale</li>
                    <li>Achită comanda</li>
                </ol>
            </div>

            <p class="md-caption color-red">Dupa achitarea comenzii, veți primi notificare pe email ca plata a fost primită. În dependență de perioada selectată (2 sau 10 zile) veți primi pe email testarea nutrițională și fiziologică.</p>

            <ul class="md-caption">
                <li>Așteaptă mesajul de confirmare că tranzacția a avut loc cu success și primește chitanța</li>
                <li>Te rugăm să păstrezi chitanța de achitare la terminal pănă la primirea pe email a testării nutriționale și fiziologice.</li>
                <li>În cazul în care ai întîlnit dificultăți la achitare plății sau ai nevoie de asistență, contactează Serviciul Clienți Qiwi la numărul de telefon: +373 (22) 844-300</li>
            </ul>
        </md-card-content>
    </md-card> --}}

    {{-- <md-card layout="column" flex ng-if="payment.gateway == 'cc-vb'"> --}}
    <md-card layout="column" flex >
        <md-card-content>
            <form novalidate="true" autocomplete="off" name="forms.order" method="post" action="{{ url('payment/vb') }}">
                <input type="hidden" name="order_id" value="@{{ payment.order.id }}" />
                {{--<h1 class="md-headline">Plătește comanda prin intermediul băncii VictoriaBank.</h1>--}}

                <div layout="column">
                    <p>Pentru a achita comanda, acceptă termenii și condițiile site-ului, apoi apasă butonul "PLĂTEȘTE" și urmează instrucțiunile băncii.</p>

                    <md-checkbox required ng-model="payment.agree" aria-label="Sunt deacord cu termenii și condițiile site-ului Benefito.md">
                        Sunt deacord cu {!! link_to(route('static_page', ['slug' => 'termeni-si-conditii']), 'termenii și condiții', ['target' => '_blank']) !!}
                    </md-checkbox>
                </div>

                <div layout>
                    @if ('local' == env('APP_ENV'))
                    <md-button type="button" class="md-button color-red" ng-click="cancelOrder($event)">ANULEAZĂ</md-button>
                    @endif
                    <span flex></span>
                    <md-button type="submit" class="md-primary md-raised" ng-disabled="! isStepValid('order')">PLĂTEȘTE</md-button>
                </div>
            </form>
        </md-card-content>
    </md-card>
