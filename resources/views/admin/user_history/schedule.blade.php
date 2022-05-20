<a href="#" id="scheduler-{{ $record->id }}">View/Hide</a>

<table class="table hidden">
    @foreach($schedule as $day => $options)
        <tr>
            <td width="10%"><strong>{{ trans("forms.days.{$day}") }}</strong></td>
            <td>
                @if ('rest' == $options['type'])
                    Zi fara antrenament
                @elseif('discharging' == $options['type'])
                    Zi de detox
                @else
                    Zi de antrenament (<span class="badge bg-green">{{ $options['time'] }}</span>)
                @endif
            </td>
        </tr>
    @endforeach
</table>

@section('js')
    <script>
        $('#scheduler-{{ $record->id }}').click(function() {
            $(this).siblings('.table').toggleClass('hidden');
            return false;
        })
    </script>
@append