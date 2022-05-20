@extends('front.app')

@section('content')

    <div class="videos-block events">

        <div class="container video-intro">
            <div class="breadcrumbs">
                <a href="#">Home</a> >
                <a href="#" class="active">VIDEO/PHOTO GALLERY</a>
            </div>
            <h1>VIDEO/PHOTO GALLERY</h1>
            <p>Below You can find video and images - short samples of our Fitness & Yoga workout exercises.
                Depending on Your current body parameters and desired goals, our app will generate customized meal
                and exercises plan. For example, if You want to lose weight explicitly on hips, You will get a
                special complex of exercises for that goal.</p>
        </div>
        <!-- Videos Area -->
        <div class="videos">
            <div class="container">
                <div class="video"><br><br><br><br><br>
                    <video src="{{ asset('assets/IMG_5078.MOV') }}" autoplay muted playsinline style="width: 100%"></video>
                </div>
            </div>
        </div>

        <div class="teasers">
            <div class="container">
                <div class="row wrapp">
                    <div class="col-md-4">
                        <div class="inside">
                            <img src="{{ Image(33) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inside">
                            <img src="{{ Image(34) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="inside">
                            <img src="{{ Image(35) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-center">
                <a href="{{ route('add.free.week') }}">Get one week free</a>
            </div>
        </div>
    </div>
    @include('front.partials.footer-line')
@stop
