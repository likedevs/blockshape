<style>
    div.toolbar {
        position: fixed;
        top:0;
        width: 100%;
        padding: 10px;
        background: #f3f4f5;
        color: #3c8dbc;
        border-bottom: 1px solid #828282;
        box-shadow: #828282;
    }
    div.toolbar a {
        color: #3c8dbc;
    }

    div.document {
        margin-top: 50px;
    }
</style>
<div class="toolbar">
    <a href="{{ url(session('back_url')) }}">Back to admin</a>
    @if ($record->canRebuild())
    | <a href="{{ route('admin.history.rebuild', ['record' => $record]) }}">Rebuild</a>
    @endif
    @if ($record->hasDocument())
     | <a href="{{ route('customer.history.download', ['user'  => $record->user, 'record' => $record]) }}">Download</a>
    @endif
</div>

<div class="document">
    {!! $document !!}
</div>