<!DOCTYPE html>
<html ng-app="Unica">
    <head>
        @include('head.seo')

        @include('head.styles')

        @include('head.token')

        <meta name="viewport" content="initial-scale=1" />
    </head>
    <body>
        @include('landing.header')

        <div layout layout-align="center center" layout-padding>
            @yield('content')
        </div>

        @include('user.footer')

        @include('head.scripts')
    </body>
</html>
