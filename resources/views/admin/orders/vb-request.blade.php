@extends('administrator::layout')

@section('content')
    <?php
    $fields = [
        'TERMINAL', 'TRTYPE', 'ORDER', 'AMOUNT', 'CURRENCY', 'ACTION', 'RC', 'TEXT', 'APPROVAL', 'RRN',
        'INT_REF', 'TIMESTAMP', 'NONCE', 'CODE', 'DIAG_CODE', 'DIAG_MESSAGE', 'P_SIGN', 'BIN', 'CARD'
    ];
    ?>
    <form action="{{ route('vb.response') }}" method="post">
        <table class="table">
            @foreach($fields as $field)
                <tr>
                    <td style="width:20%;">{{ $field }}</td>
                    <td>
                        @if ('P_SIGN' == $field)
                            <textarea name="{{ $field }}" style="width: 90%; height: 120px;" class="form-control input-sm"></textarea>
                        @else
                            <input type="text" class="form-control input-sm" style="width: 300px;" name="{{ $field }}"/>
                        @endif
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-center">
                        <input type="submit" name="save" value="Make Transaction Request" class="btn btn-bitbucket" />
                    </td>
                </tr>
        </table>
    </form>
@endsection