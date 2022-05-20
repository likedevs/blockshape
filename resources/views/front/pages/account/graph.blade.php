@extends('front.app')

@section('content')

    @include('front.partials.account-tabs')

    <div class="account-supl">
        <div class="container">
            @if (!is_null($history))
                <div class="params-form">
                    @if (!is_null($diary))
                        <form method="post" action="{{ route('post.graph') }}">
                            <h2>Insert Your body parameters for today</h2>
                            <div class="form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="inside">
                                            <input type="text" name="weight" placeholder="Weight"
                                                   value="{{ $diary->weight_body }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inside">
                                            <input type="text" name="buttocks" placeholder="Hips"
                                                   value="{{ $diary->buttocks }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inside">
                                            <input type="text" name="waist" placeholder="Waist"
                                                   value="{{ $diary->waist }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="inside">
                                            <input type="text" name="arm" placeholder="Arm" value="{{ $diary->arm }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inside">
                                            <input type="text" name="thigh" placeholder="Thigh"
                                                   value="{{ $diary->thigh }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inside">
                                            <input type="text" name="abdomen" placeholder="Abdomen"
                                                   value="{{ $diary->abdomen }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 text-center">
                        <input type="submit" class="btn btn-default margin-top-20" value="Save">
                    </div>
                </div>
                </form>
            @endif
            <div class="body-imgs">
                <div class="item">
                    <img src="{{  asset('front-assets/img/fese.png') }}">
                    <p>Fese</p>
                </div>
                <div class="item">
                    <img src="{{  asset('front-assets/img/talia.png') }}">
                    <p>Waist</p>
                </div>
                <div class="item">
                    <img src="{{  asset('front-assets/img/Brat.png') }}">
                    <p>Arm</p>
                </div>
                <div class="item">
                    <img src="{{  asset('front-assets/img/Coapsa.png') }}">
                    <p>Thigh</p>
                </div>
                <div class="item">
                    <img src="{{  asset('front-assets/img/abdomen.png') }}">
                    <p>Abdomen</p>
                </div>
            </div>
            <div class="char-area">
                <h3>Results tracker</h3>
                <p>Results tracker is the best tool to monitor Your daily achievements towards Your goals.</p>
                <div class="char">
                    <div class="col-md-10 char-schema">
                        <div class="chart">
                            <canvas id="myChart" width="400" height="200"></canvas>
                        </div>
                    </div>

                    <div class="col-md-2 char-tabs">
                        <a class="tab-graph green" data='{!! json_encode($values['weight']['date']) !!}'
                           data-val='{!! json_encode($values['weight']['val']) !!}' data-meas="kg">Weight</a>

                        <a class="tab-graph blue" data='{!! json_encode($values['buttocks']['date']) !!}'
                           data-val='{!! json_encode($values['buttocks']['val']) !!}' data-meas="cm">Waist</a>

                        <a class="tab-graph red" data='{!! json_encode($values['weight']['date']) !!}'
                           data-val='{!! json_encode($values['weight']['val']) !!}' data-meas="cm">Abdomen</a>

                        <a class="tab-graph violet" data='{!! json_encode($values['waist']['date']) !!}'
                           data-val='{!! json_encode($values['waist']['val']) !!}' data-meas="cm">Hips</a>

                        <a class="tab-graph orange" data='{!! json_encode($values['arm']['date']) !!}'
                           data-val='{!! json_encode($values['arm']['val']) !!}' data-meas="cm">Thigh</a>

                        <a class="tab-graph indigo" data='{!! json_encode($values['thigh']['date']) !!}'
                           data-val='{!! json_encode($values['thigh']['val']) !!}' data-meas="cm">Arm</a>
                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-md-9">
                        <br><br>
                        <h4>Our app will generate customised meal and exercises plan, based on Your body parameters and desired goals</h4>
                        <a class="goto" href="{{ route('order-offer', ['offer' => 5]) }}"> Insert Your body parameters</a>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var tabs = function (data, val) {
            var arrData = [];
            for (var prop in data) {
                arrData.push(data[prop]);
            }

            var arrVals = [];
            for (var prop in val) {
                arrVals.push(val[prop]);
            }

            return [arrData, arrVals];
        }

        var arrData = tabs({!! json_encode($values['weight']['date']) !!}, {!! json_encode($values['weight']['val']) !!})[0];

        console.log(arrData);
        var arrVals = tabs({!! json_encode($values['weight']['date']) !!}, {!! json_encode($values['weight']['val']) !!})[1];

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: arrData,
                datasets: [{
                    label: "Results tracker",
                    borderColor: '#ff993c',
                    data: arrVals,
                }]
            },
            options: {
                layout: {
                    padding: 5,
                },
                legend: {
                    position: false,
                },
                title: {
                    display: true,
                    text: 'Weight'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Weight in kg'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Days in program'
                        }
                    }]
                }
            }
        });

        $('.tab-graph').on('click', function () {
            var arrData1 = tabs(JSON.parse($(this).attr('data')), JSON.parse($(this).attr('data-val')))[0];
            var arrVals1 = tabs(JSON.parse($(this).attr('data')), JSON.parse($(this).attr('data-val')))[1];
            var config = chart.config;
            var measurement = $(this).attr('data-meas');
            config.data.datasets[0].data = arrVals1;
            config.data.labels = arrData1;
            config.options.title.text = $(this).text();
            config.options.scales.yAxes[0].scaleLabel.labelString = $(this).text() + ' ' + measurement;
            chart.update();
        });

    </script>

    @include('front.partials.prefooter')

    @include('front.partials.footer-line')

@stop
