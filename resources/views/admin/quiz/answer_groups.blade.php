@if ($answers->count())
    <ul class="list-unstyled">
        @foreach($answers as $answer)
            <li>
                {{ $answer->answer  }}

                <div class="pull-right">
                    <a href="{{ qsRoute('admin_model_edit', ['id' => $answer->id, 'page' => 'quiz_answers']) }}"><i class="fa fa-edit product-edit"></i></a>
                    <a href="{{ qsRoute('admin_model_delete', ['page' => 'quiz_answers', 'id' => $answer->id]) }}" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o product-delete"></i></a>
                </div>
            </li>
        @endforeach
        <li>
            <a href="{{ qsRoute('admin_model_create', ['page' => 'quiz_answers', 'group_id' => $group->id]) }}" class="label label-primary">+ add</a>
        </li>
    </ul>
@endif