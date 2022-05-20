<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('administrator.title')  }}</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- bootstrap 3.0.2 -->
    <link href="<?= asset($assets . '/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?= asset($assets . '/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?= asset($assets . '/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?= asset($assets . '/css/AdminLTE.css') ?>" rel="stylesheet" type="text/css" />

    <link href="<?= asset($assets . '/css/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= asset($assets . '/css/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />

    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    {{--<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>--}}
    <![endif]-->

    @yield('headjs')
</head>
<body class="skin-black">
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="/{{ $mainConfig->get('prefix') }}" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        {{ config('administrator.title', 'Administration panel') }}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <li>
                    <a class="dropdown-toggle active" href="{{ route('admin_model_index', ['page' => 'languages']) }}">
                        <i class="fa fa-envelope"></i>
                        Languages
                    </a>
                </li>

                {{--<li>--}}
                {{--<a class="dropdown-toggle" href="settings">--}}
                {{--<i class="fa fa-gears"></i>--}}
                {{--Settings--}}
                {{--</a>--}}
                {{--</li>--}}

                {{--@include('administrator::partials.badges')--}}

                @include('administrator::partials.user')
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            @include('administrator::partials/navigation')
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{ $title }}
            @if (isset($total) && isset($count))
                <small>({{ $count }} / {{ $total }})</small>
            @endif
            </h1>
            {!! $breadcrumbs !!}
        </section>

        @include('administrator::partials/messages')

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        {{--<div class="box-header">--}}
                        {{--<h3 class="box-title">Test</h3>--}}
                        {{--</div><!-- /.box-header -->--}}

                        @yield('filter')

                        <div class="box-body table-responsive">
                            @if ($before = $moduleConfig->get('view.before'))
                                @include($before)
                            @endif

                            @yield('content')

                            @if ($after = $moduleConfig->get('view.after'))
                                @include($after)
                            @endif
                        </div>
                    </div><!-- /.box -->
                </div>
            </div>

        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<!-- jQuery 2.0.2 -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= asset($assets . '/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?= asset($assets . '/js/AdminLTE/app.js') ?>" type="text/javascript"></script>

<script src="<?= asset($assets . '/js/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<script src="<?= asset($assets . '/js/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>

@yield('js')
</body>
</html>