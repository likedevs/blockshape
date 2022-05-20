@if (Auth::user()->isAdmin())
<?php
$out = [];
$out[] = '<a href="' . route('admin.history.preview', ['record' => $row]) . '">View</a>';

if ($row->hasDocument()) {
    $out[] = '<a href="' . route('customer.history.download', ['user'  => $row->user, 'record' => $row]) . '">Download</a>';

    if ($row->canRebuild()) {
        $out[] = '<a href="' . route('admin.history.rebuild', ['record' => $row]) . '">Rebuild</a>';
    }

    if ($row->pending()) {
        $out[] = '<a data-action="accept" data-record="' . $row->id . '" href="' . route('admin.history.accept', ['record' => $row->id]) . '">Accept</a>';
        $out[] = '<a data-action="decline" data-record="' . $row->id . '" href="' . route('admin.history.decline', ['record' => $row->id]) . '">Decline</a>';
    }
}
?>

<div style="margin: 10px 0;"><?=join(" | ", $out)?></div>
@endif