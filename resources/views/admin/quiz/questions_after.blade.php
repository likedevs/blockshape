@section('js')
    <script>
        $(function () {
            $("div.callout input").change(function () {
                $.post('{{ route('admin.quiz.syncHint', ['page' => 'quiz']) }}', {
                    name: $(this).attr('name'),
                    value: $(this).prop('checked') ? 1 : 0
                })
            })
        })
    </script>
@append