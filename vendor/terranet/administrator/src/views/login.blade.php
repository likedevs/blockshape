<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- bootstrap 3.0.2 -->
    <link href="<?= asset($assets . '/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?= asset($assets . '/css/AdminLTE.css') ?>" rel="stylesheet" type="text/css" />
</head>
<body class="bg-black">
    @include('administrator::partials.messages')

    <div class="form-box" id="login-box">
        <div class="header">Sign In</div>
        {!! Form::open() !!}
            <div class="body bg-gray">
                <div class="form-group">
                    {!! Form::text($identity, null, ['class' => 'form-control', 'placeholder' => ucfirst($identity)]) !!}
                </div>
                <div class="form-group">
                    {!! Form::password($credential, ['class' => 'form-control', 'placeholder' => ucfirst($credential)]) !!}
                </div>
                <div class="form-group">
                    <input name="remember_me" type="hidden" value="0" />
                    <input type="checkbox" name="remember_me" value="1" /> Remember me
                </div>
            </div>
            <div class="footer">
                <button type="submit" class="btn bg-olive btn-block">Sign me in</button>
            </div>
        {!! Form::close() !!}
    </div>
</body>
</html>