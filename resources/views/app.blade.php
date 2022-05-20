<html ng-app="Unica">
<head>
    <meta name="robots" content="nofollow,noindex" />
    <meta name="googlebot" content="noindex, nofollow" />

    <title>UnicaSport - Nutrition</title>
    @include('head.styles')

    @include('head.token')

    <meta name="viewport" content="initial-scale=1"/>
</head>
<body layout="column" ng-cloak>

<div ng-controller="NavigationController">
    <md-toolbar>
        <div class="md-toolbar-tools">
            {{--@if (isset($user))--}}
            <md-button ng-click="toggleLeft()" class="md-icon-button">
                <md-icon>view_headline</md-icon>
            </md-button>
            {{--@endif--}}

            <md-button ng-href="{{ url('home') }}"  ng-class="{'md-default': isLarge || isMedium, 'md-icon-button': isSmall}">
                <md-icon>home</md-icon><span>&nbsp;</span><span ng-if="isLarge || isMedium">{{ trans('forms.buttons.home') }}</span>
            </md-button>

            <md-button ng-href="{{ url('customer/create') }}" ng-class="{'md-default': isLarge || isMedium, 'md-icon-button': isSmall}">
                <md-icon>supervisor_account</md-icon><span>&nbsp;</span><span ng-if="isLarge || isMedium">+ {{ trans('forms.buttons.add_customer') }}</span>
            </md-button>

            <span flex></span>
        </div>
    </md-toolbar>

    <div layout="column">
        <section layout="row" flex>

            <!-- <md-sidenav class="md-sidenav-left md-whiteframe-z2" md-component-id="left" md-is-locked-open="$mdMedia('gt-md')"> -->
            <md-sidenav class="md-sidenav-left md-whiteframe-z2" md-component-id="left" md-is-locked-open="false">
                <md-toolbar>
                    <div class="md-toolbar-tools">
                        {{ Auth::user()->name }}
                    </div>
                </md-toolbar>
                <md-content layout-padding>
                    @if (isset($user))
                        <md-subheader class="md-primary">
                            <span class="md-headline">{{ $user->name }}</span>
                            <br />
                            <span>{{ $user->phone }}</span>
                        </md-subheader>

                        <div class="customer-image">
                        @if ($user->hasImage())
                            <img class="circular" src="{{ $user->imageUrl(App\User::IMAGE_SIZE_MEDIUM) }}" alt="">
                        @endif
                        </div>

                        <md-list>
                            <md-list-item>
                                <div class="md-list-item-text">
                                    <md-button class="md-link" ng-href="{{ route('customer.edit', ['customer' => $user]) }}">
                                        <i class="fa fa-pencil-square-o"></i> {{ trans('forms.buttons.edit_customer_info') }}
                                    </md-button>
                                </div>
                            </md-list-item>
                            <md-divider></md-divider>

                            <md-list-item>
                                <div class="md-list-item-text">
                                    <md-button class="md-link" ng-href="{{ route('customer.show', ['customer' => $user]) }}">
                                        <i class="fa fa-pencil-square-o"></i> {{ trans('forms.buttons.view_customer_history') }}
                                    </md-button>
                                </div>
                            </md-list-item>
                            <md-divider></md-divider>
                        </md-list>

                    @endif

                    <md-list>
                        <md-list-item>
                            Support: {{ \Terranet\Administrator\Model\Settings::getOption('support::phone') }}
                        </md-list-item>

                        <md-list-item>
                            <md-button ng-href="{{ url('auth/logout') }}" class="md-default">
                                <md-icon>input</md-icon> {{ trans('forms.buttons.logout') }}
                            </md-button>
                        </md-list-item>
                    </md-list>
                </md-content>
            </md-sidenav>

            <div flex layout-padding>
                @yield('content')
            </div>

        </section>
    </div>
</div>

@include('head.scripts')
</body>
</html>
