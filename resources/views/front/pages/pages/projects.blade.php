@extends('front.app')

@section('content')

<div class="archive-content projects-block">
    <div class="container">
        <div class="breadcrumbs">
            <a href="#">Home > </a>
            <a href="#" class="active">Proiectele Noastre</a>
        </div>

        <div class="content">
            <h1>{{ Label(81, $lang_id) }}</h1>
            <p>{{ Label(82, $lang_id) }}</p>
            <p>{{ Label(83, $lang_id) }}</p>
        </div>
        <div class="project-content">
            <div class="container">
                <div class="row projects-list">
                    <h2>{{ Label(84, $lang_id) }}</h2>
                    <div class="decor-line"></div>
                    <div class="row">
                        @if (!empty($projects))
                            @foreach ($projects as $key => $project)
                                <div class="col-md-4 item">
                                    <div class="inside">
                                        <h3>{{ $project->title }}</h3>
                                        <img src="{{ $project->image }}">
                                        <a href="{{ $project->link ? $project->link : route('project.single', ['project' => $project->slug]) }}">{{ Label(85, $lang_id) }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="decor-line"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="button-center">
        <a href="{{ route('free.week') }}">Primeste o saptamâna gratuită</a>
    </div>

</div>

@include('front.partials.footer-line')

@stop
