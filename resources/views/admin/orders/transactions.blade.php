<table class="table">
    <tr>
        <th>ID</th>
        <th>status</th>
        <th>details</th>
        <th>date</th>
    </tr>
    @foreach($transactions as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>
            <ul class="list-unstyled">
                <li>
                    {{ $item->status }}
                </li>
                <li>
                    TRTYPE: {{ $item->params['TRTYPE'] }}
                </li>
                <li>
                    TEXT: {{ $item->params['TEXT'] }}
                </li>
            </ul>
        </td>
        <td>
            <ul class="list-unstyled">
                <li>
                    APPROVAL: {{ $item->params['APPROVAL'] }}
                </li>
                <li>
                    RRN: {{ $item->params['RRN'] }}
                </li>
                <li>
                    INT_REF: {{ $item->params['INT_REF'] }}
                </li>
            </ul>

        </td>
        <td>{{ $item->created_at }}</td>
    </tr>
    @endforeach
</table>
