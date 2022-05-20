<!DOCTYPE html>
<html ng-app="Unica">
    <head>
        @include('head.seo')

        @include('head.styles')

        @include('head.token')

        <meta name="viewport" content="initial-scale=1" />
    </head>
    <body>
        @yield('content')

        @include('head.scripts')
    </body>
</html>
