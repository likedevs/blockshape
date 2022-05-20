<html>

<head>
    <title>Schedule</title>
    <style>
        #content {
            width: 960px;
            margin: 0 auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table td,
        .table th {
            padding: 5px;
            border: 1px solid #000;
        }
        .table th {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<div id="content">
    @foreach($hours as $workoutTime => $schedule)
        <h3>Workout at: {{$workoutTime}}</h3>

        <table class="table">
            <tr>
                <th width="120">Time</th>
                <th>Nutrient</th>
            </tr>
            @foreach($schedule as $hour => $nutrient)
                <tr>
                    <td align="center">{{ $hour }}</td>
                    <td>{{ $nutrient }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
</div>
</body>
</html>