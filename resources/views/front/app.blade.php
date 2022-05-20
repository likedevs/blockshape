<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="robots" content="nofollow,noindex" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title>BLOCK SHAPE</title>

    <link href="{{ asset('front-assets/css/resets.css') }}" rel="stylesheet">
    <link href="{{ asset('front-assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('front-assets/css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('front-assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('front-assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('front-assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('front-assets/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front-assets/pickadate.js-3.5.6/lib/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/pickadate.js-3.5.6/lib/themes/default.date.css') }}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('front-assets/js/jquery-3.2.0.min.js') }}"></script>

</head>
<body>
    <div id="wrapper">
        @include('front.partials.header')

        @yield('content')

        @include('front.partials.footer')
        <div id="container"></div>
    </div>

    @include('front.partials.modals')

    <script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/slick.js') }}"></script>
    <script src="{{ asset('front-assets/js/scripts.js') }}"></script>
    <script src="{{ asset('front-assets/js/app.js') }}"></script>
    <script src="{{ asset('front-assets/pickadate.js-3.5.6/lib/picker.js') }}"></script>
    <script src="{{ asset('front-assets/pickadate.js-3.5.6/lib/picker.date.js') }}"></script>
    <script src="{{ asset('front-assets/pickadate.js-3.5.6/lib/legacy.js') }}"></script>
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModal').modal('show');
        });
    </script>
    <?php
        $year = date('Y', strtotime(Session::get('history_date')));
        $mouth = date('m', strtotime(Session::get('history_date'))) - 1;
        $day = date('d', strtotime(Session::get('history_date')));
    ?>
    <script>
        $().ready(function(){
            var $input = $( '.datepicker' ).pickadate({
               min: new Date({{ date('Y', strtotime($termFrom)) }}, {{ date('m', strtotime($termFrom)) - 1}}, {{ date('d', strtotime($termFrom)) }}),
               max:  new Date({{ date('Y', strtotime($termTo)) }}, {{ date('m', strtotime($termTo)) - 1}}, {{ date('d', strtotime($termTo)) }}),
               formatSubmit: 'yyyy/mm/dd',
               monthsFull: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
               monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
               weekdaysFull: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
               weekdaysShort: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
               today: false,
               clear: false,
               close: 'cloose',
               container: '#container',
               closeOnSelect: true,
               closeOnClear: false,
               onClose: function() {
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                       }
                   });
                   $.ajax({
                     type: "POST",
                     url: '/history/date',
                     data: {date:picker.get('select', 'yyyy-mm-dd')},
                     success: function(data){
                         if (JSON.parse(data).msg == "true") {
                            location.reload();
                         }
                     }
                   });
               },
           })
           var picker = $input.pickadate('picker');
           picker.set('select', new Date({{$year}}, {{$mouth}}, {{$day}}));
        });

        $('.mainBanner').slick({
          dots: true,
          infinite: true,
          speed: 300,
          slidesToShow: 1,
          adaptiveHeight: true
        });
        $('.histories-slider').slick({
              lazyLoad: 'ondemand',
              slidesToShow: 3,
              slidesToScroll: 1,
              arrows: true,
               responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 900,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 650,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]});
    </script>
</body>
</html>
