<a href="#" id="handler_{{ $record->id }}">View/Hide</a>

<ul class="list-unstyled hidden">
    @foreach($answers as $i => $answer)
    <li>
        <strong>{{ $answer->question->question }}</strong>
        <br />
        &raquo; <em>{{ $answer->answer->answer }}</em>
    </li>
    @endforeach
</ul>

@section('js')
    <script>
        $(function() {
            $('#handler_{{ $record->id }}').click(function() {
                $(this).siblings('ul').toggleClass('hidden');

                return false;
            });
        });
    </script>
@append