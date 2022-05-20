@extends('app')

@section('content')

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table td {
        padding: 5px;
        line-height: 24px;
        vertical-align: top;
    }
</style>

<?php
$records = $history->reduce(function($records, $item) {
    $records[$item->id] = [
            'status' => $item->status,
            'reason' => $item->declineReason
    ];
    return $records;
}, []);
?>

<div class="history" ng-controller="HistoryController" ng-init="records = {{ json_encode($records) }}; key = '{{ config('broadcasting.connections.pusher.key') }}'; channel = 'history.processed.{{ Auth::user()->id }}'">
    <div layout="row" layout-align="center" layout-padding>
        <div layout="column" flex>
            <h3 class="md-display-1">
                {{ $user->name }}
                <md-button href="{{ route('customer.record.create', ['customer' => $user]) }}" class="md-btn md-warn">{{ trans('forms.buttons.new_record') }}</md-button>
            </h3>
            <h3 class="md-headline">{{ trans('forms.record.history') }}</h3>
            <div layout="column">
                @foreach($history as $record)
                <div>
                <md-card-content flex layout id="record-{{$record->id}}">
                    <div flex="15" layout-padding>
                        <div layout="column" layout-align="center center">
                            <span class="md-display-3">{{ $record->date()->formatLocalized('%e') }}</span>
                            <span class="md-headline">{{ $record->date()->formatLocalized('%b, %Y') }}</span>

                            <strong class="md-caption"><u>{{ $record->target->name }}</u></strong>

                            <md-chips ng-if="pending({{ $record->id }}) || declined({{ $record->id }})"><md-chip style="background-color: red; color: white;">{{ $record->status }}</md-chip></md-chips>

                            <md-button ng-if="pending({{ $record->id }}) || declined({{ $record->id }})" class="md-mini md-warn" ng-href="{{ route('customer.record.create', ['customer' => $user, 'record' => $record]) }}">
                                <md-icon>create</md-icon> {{ trans('forms.buttons.edit_record') }}
                            </md-button>

                            <md-button href="{{ route('customer.history.download', [
                                'user'   => $user,
                                'record' => $record
                            ]) }}" class="md-mini" ng-if="confirmed({{ $record->id }})"><md-icon>picture_as_pdf</md-icon> {{ trans('forms.buttons.download') }}</md-button>
                        </div>
                    </div>
                    <div flex="85" layout-padding>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong class="md-caption">{{ trans('forms.record.height') }}: </strong> {{ $record->height }}
                                        <md-divider></md-divider>
                                    </td>
                                    <td>
                                        <strong class="md-caption">{{ trans('forms.record.current_weight') }}: </strong> {{ $record->current_weight }}
                                        <md-divider></md-divider>
                                    </td>
                                    <td>
                                        <strong class="md-caption">{{ trans('forms.record.target_weight') }}: </strong> {{ $record->target_weight }}
                                        <md-divider></md-divider>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong class="md-caption">{{ trans('forms.measurements.options.talia1.label') }}</strong>: {{ $record->talia1 }} cm<br />
                                        <strong class="md-caption">{{ trans('forms.measurements.options.talia2.label') }}</strong>: {{ $record->talia2 }} cm<br />
                                        <strong class="md-caption">{{ trans('forms.measurements.options.talia3.label') }}</strong>: {{ $record->talia3 }} cm<br />
                                        <strong class="md-caption">{{ trans('forms.measurements.options.buttocks.label') }}</strong>: {{ $record->buttocks }} cm<br />
                                        <strong class="md-caption">{{ trans('forms.measurements.options.thigh1.label') }}</strong>: {{ $record->thigh1 }} cm<br />
                                        <strong class="md-caption">{{ trans('forms.measurements.options.thigh2.label') }}</strong>: {{ $record->thigh2 }} cm<br />
                                        <strong class="md-caption">{{ trans('forms.measurements.options.bone_radius.label') }}</strong>: {{ $record->bone_radius }} cm<br />
                                    </td>
                                    <td>
                                        <strong class="md-caption">Puls dupa efort:</strong> {{ $record->pulse3 }}<br />

                                        <strong class="md-caption">Tensiune inainte de efort</strong>: {{ $record->pressure_rest['max'] }}x{{ $record->pressure_rest['min'] }}<br />
                                        <strong class="md-caption">Tensiune dupa efort fizic</strong>: {{ $record->pressure_load['max'] }}x{{ $record->pressure_load['min'] }}<br />
                                        {{--{!! md_chips([$record->pressureType->name]) !!}--}}

                                        <a class="md-caption" href="#" ng-click="showRecordSchedule($event, {{ json_encode($record->schedule) }})">Orarul antrenamentelor</a>
                                    </td>
                                    <td>
                                        @if (count($diseases = $record->diseases->pluck('name')))
                                            <strong class="md-caption">Maladii:</strong>
                                            <span class="md-caption">{{ join_collection($diseases) }}}</span>
                                            <br />
                                        @endif

                                        @if (count($allergies = $record->allergies->pluck('name')))
                                            <strong class="md-caption">Alergii:</strong>
                                            <span class="md-caption">{{ join_collection($allergies) }}</span>
                                            <br />
                                        @endif

                                        @if (count($excludes = $record->excludes->pluck('name')))
                                            <strong class="md-caption">Nu consuma:</strong>
                                            <span class="md-caption">{{ join_collection($excludes) }}</span>
                                                <br />
                                        @endif

                                        <a href="#" class="md-caption" ng-click="showRecordAnswers($event, {{ json_encode($record->quizPairs->toArray()) }})">Raspunsuri alimentatie</a>
                                    </td>
                                </tr>
                                @if ($record->declineReason)
                                <tr>
                                    <td colspan="3" class="md-warn">{{ $record->declineReason }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </md-card-content>
                </div>
                <md-divider></md-divider>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://js.pusher.com/2.2/pusher.min.js"></script>
@append
