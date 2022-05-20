<table class="table">
    @foreach($details as $key => $value)
        <tr>
            <th>
                {{ title_case($key) }}
            </th>
            <td>
                {{ $value }}
            </td>
        </tr>
    @endforeach
</table>