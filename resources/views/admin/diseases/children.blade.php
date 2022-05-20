<ul class="list-unstyled" style="min-width: 250px;">
    @foreach($children as $element)
        <li>
            {!! output_rank_field($element, 'rank') !!}&nbsp;
            {{ $element->name }}

            <div class="pull-right">
                <a href="{{ qsRoute('admin_model_edit', ['id' => $element->id, 'page' => 'diseases']) }}"><i class="fa fa-edit product-edit"></i></a>
                <a href="{{ qsRoute('admin_model_delete', ['page' => 'diseases', 'id' => $element->id]) }}" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o product-delete"></i></a>
            </div>
        </li>
    @endforeach
</ul>