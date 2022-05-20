@inject('pulseMapper', 'App\Services\PulseMapper')
@inject('recipeFinder', 'App\Services\RecipeFinder')
@inject('offices', 'App\Repositories\DepartmentsRepository')

<?php
/* tmp fix: */
setlocale(LC_TIME, 'ro_RO');
$target = $record->target->slug;

// task# 13028
function lte($diff, $record, $maxWeight)
{
    return $record->current_weight - $maxWeight <= $diff;
}

if ('weight-loss' == $target && lte(7, $record, $maxWeight)) {
    $target .= '-lte-7-kg';
}

$metabolismPayload = [
    'current_metabolism'          => $metabolism['current'],
    'estimated_time'              => $estimatedTime,
    'estimated_time_max'          => $estimatedTimeMax,
    'estimated_time_anabolic'     => $estimatedTimeAnabolic,
    'estimated_time_max_anabolic' => $estimatedTimeMaxAnabolic
];
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8"/>
    <style media="all">
        {!! content('css/print.css') !!}
    </style>
</head>
<body background="{{ dataBase64('images/watermark.png') }}">

<div id="header">
    <img src="{{ dataBase64('images/header.png') }}" alt="">
</div>

<div id="content">
    <img src="{{ dataBase64('images/stamp.png') }}" class="stamp" width="110"/>

    <h2 class="headline">{{ trans('result.title') }}</h2>

    <div class="italic a-center">
        {!! trans('result.analized_by', ['name' => 'Galina Tomaș']) !!}
        <div class="clearfix"></div>
        <br/>
    </div>

    <div style="line-height: 24px;">
        @if ($record->office_id)
            <strong>{{ trans('result.labels.office') }}:</strong>
            <span class="underlined-box w-200 i-block a-center">{{ $record->office->name }}</span>
        @endif

        @if ($record->instructor_id)
            <strong>{{ trans('result.labels.instructor') }}:</strong>
            <span class="i-block underlined-box w-200 a-center">{{ $record->instructor->name }}</span><br/>
        @endif

        <strong>{{ trans('result.labels.customer') }}:</strong>
        <span class="i-block underlined-box w-400 a-center">{{ $record->user->name }}</span>

        <strong>{{ trans('result.labels.age') }}:</strong>
        <span class="i-block underlined-box w-100 a-center">{{ $user->age() }}</span><br/>

        <strong>{{ trans('result.labels.test_date') }}:</strong>
        <span class="i-block underlined-box w-200 a-center">{{ $record->date()->formatLocalized('%d %B %Y') }}</span>

        <strong>{{ trans('result.labels.accept_date') }}:</strong>
        <span class="i-block underlined-box w-200 a-center">{{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}</span><br/>

        <strong>{{ trans('result.labels.target') }}: </strong>
        <span class="i-block underlined-box w-200 a-center">{{ $record->target->name }}</span>

        <strong>{{ trans('forms.record.current_weight') }}:</strong>
        <span class="i-block underlined-box w-100 a-center">{{ $record->current_weight }} kg</span>

        <strong>{{ trans('forms.record.height') }}:</strong>
        <span class="i-block underlined-box w-100 a-center">{{ $record->height }} cm</span>
    </div>

    <div class="page"></div>
    <h3 class="headline">{{ trans('result.headers.expected_result') }}</h3>

    {!! auto_p(glossary("definition.resume.{$target}", 'body', [
        'name'               => title_case($user->name),
        'current_weight'     => $record->current_weight,
        'target_weight'      => $record->target_weight,
        'max_weight'         => $maxWeight,
        'estimated_time'     => $estimatedTime,
        'estimated_time_max' => $estimatedTimeMax,
        'estimated_time_anabolic' => $estimatedTimeAnabolic
    ])) !!}

    <div class="page"></div>
    <h3 class="headline">{{ trans('result.headers.imc') }}</h3>

    {!! auto_p(glossary("definition.imc.{$target}", 'body')) !!}

    <strong>
        {{ trans('result.headers.your_imc') }}:
        <span class="i-block underlined-box w-50 a-center">{{ $bmi->getValue() }}</span>.
    </strong>
    {!! auto_p($bmi->resolve()->note) !!}

    @if ($user->isOnline())
        <div class="page"></div>
        <h3 class="headline">{{ glossary('definition.importance_of_exercise', 'title') }}</h3>
        {!! auto_p(glossary('definition.importance_of_exercise', 'body')) !!}
    @endif

    <div class="page"></div>
    <h3 class="headline">{{ glossary('definition.constitution', 'title') }}</h3>
    {!! auto_p(glossary('definition.constitution', 'body')) !!}

    {!! auto_p($record->constitutionType()->getNote($record->target->slug)) !!}
    {!! auto_p($record->figureType->getDescription($record->target->slug)) !!}

    <div class="page"></div>
    <h3 class="headline">{{ trans('result.headers.metabolism') }}</h3>
    {!! auto_p(glossary('definition.metabolism', 'body')) !!}

    @if ($menopause = (bool) $record->isMenoPause())
        {!! auto_p(glossary("definition.metabolism.menopause", 'body', $metabolismPayload)) !!}
    @else
        <?php
        $metabolismText = auto_p(glossary("definition.metabolism.{$target}", 'body', $metabolismPayload));
        $metabolismText = assign($metabolismText, [
            'menstrual_cycle' => view('dompdf.partials.menstrual_cycle', ['record' => $record])->render()
        ]);
        ?>
        {!! $metabolismText !!}
    @endif

    <div class="page"></div>
    <h3 class="headline">{{ trans('result.headers.medical_state') }}</h3>

    @if ($record->pressureType)
        <h5 class="headline">{{ trans('result.headers.cardiovascular_system_reaction') }}</h5>
        {!! auto_p($record->pressureType->note) !!}
    @endif

    <h5 class="headline">{{ trans('result.headers.recommended_pulse') }}</h5>
    {!! auto_p(glossary('definition.pulse', 'body')) !!}
    {!! auto_p(glossary("definition.pulse.{$target}", 'body')) !!}

    <?php $cols = count($exercises); $width = floor(100 / ($cols + 1)); ?>
    <table class="table">
        <tr>
            <th width="{{ 100 - ($width * $cols) }}%">{{ trans('result.labels.action_areas') }}</th>
            @foreach($exercises as $exercise)
                <th width="{{ $width }}%">{{ $exercise->name }}</th>
            @endforeach
        </tr>
        <tr>
            <th width="{{ 100 - ($width * $cols) }}%">{{ trans('result.headers.recommended_pulse') }}</th>
            @foreach($exercises as $exercise)
                <td width="{{ $width }}%">{{ $pulseMapper->findMax($exercise, $record->pulse3) }}</td>
            @endforeach
        </tr>
    </table>

    @if ($diseasesNotes->count())
        <h5 class="headline">{{ trans('result.headers.medical_consultations') }}</h5>
        @foreach($diseasesNotes as $disease)
            {!! auto_p($disease->hasNote() ? $disease->note : $disease->parent->note) !!}
        @endforeach
    @endif

    <div class="page"></div>

    <h3 class="headline">{{ trans('result.headers.nutrition_schedule') }}</h3>
    {!! auto_p(glossary('definition.nutrition', 'body')) !!}

    <table class="table">
        <tr>
            <th width="10%">{{ trans('result.labels.nutrition_schedule.nutrition_time') }}</th>
            <th width="25%">{{ trans('result.labels.nutrition_schedule.nutrients') }}</th>
            <th>{{ trans('result.labels.nutrition_schedule.products') }}</th>
            <th width="15%">{{ trans('result.labels.nutrition_schedule.quantity') }}</th>
        </tr>
    </table>
    @foreach($schedule as $dayNum => $day)
        <table class="table unbreakable">
            <?php $type = $day['type']; ?>
            <tr>
                <th colspan="4" style="background: #ddd;">
                    Ziua {{ $dayNum+1 }}
                    <small>
                        ({{ trans('result.schedule.day_type.' . $type) . ($day['workout'] ? " - {$day['workout']}" : '') }}
                        )
                    </small>
                </th>
            </tr>

            @if (in_array($type, ['activity', 'rest']))
                @foreach($day['nutrition'] as $hour => $recipe)
                    <tr>
                        <td class="a-center bold" width="10%">{{ $hour }}</td>
                        <td class="a-left" width="25%">{{ $recipe['nutrient'] }}</td>
                        <td class="a-left">
                            {{ $recipe['name'] }}
                            {{--<pre>{{ print_r($recipe) }}</pre>--}}
                        </td>
                        <td width="15%">{{ $recipe['quantity'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="a-left" colspan="4">
                        {!! auto_p($day['nutrition']) !!}
                    </td>
                </tr>
            @endif
        </table>
    @endforeach

    <div class="page"></div>

    <div id="references">
        <h3 class="headline">{{ trans('result.headers.caloric_tables') }}
            <small style="font-size: 0.7em;;">({{ trans('result.labels.caloric_tables_per_100_gr') }})</small>
        </h3>

        <?php
        $columns = 3;
        $cellsPerProduct = 2;
        $cellWidth = floor((100 - ($columns * 5)) / $columns);
        ?>

        @foreach($nutrients as $nutrient)
            <h5 class="headline">{{ trans('result.headers.nutrient_sources', ['nutrient' => $nutrient->name]) }}</h5>

            @foreach($nutrient->referenceGroups as $group)
                <table class="table unbreakable">
                    <tr>
                        <th colspan="{{ $columns * $cellsPerProduct }}" class="a-left"
                            style="background: #ddd;">{{ $group->name }}</th>
                    </tr>
                    <tr>
                        @for($i=0; $i < $columns; $i++)
                            <th width="{{ $cellWidth }}%">{{ trans('result.labels.nutrient_sources.name') }}</th>
                            <th>{{ trans('result.labels.nutrient_sources.energy_value') }}</th>
                        @endfor
                    </tr>
                    <?php
                    $products = $group->products;
                    $haveColumns = $products->count() * $cellsPerProduct;
                    $needRows = ceil($haveColumns / ($columns * $cellsPerProduct));
                    $needColumns = ($columns * $cellsPerProduct) * $needRows;
                    $remainCells = ($needColumns - $haveColumns);
                    ?>
                    <tr>
                        @foreach($products as $i => $product)
                            <td class="a-left" width="{{ $cellWidth }}%">{{ $product->name }}</td>
                            <td>{{ $product->energy_value ? : '' }}</td>
                            @if (($i+1) % $columns == 0)
                    </tr>
                    <tr>
                        @endif
                        @endforeach
                        {!! str_repeat('<td></td>', $remainCells) !!}
                    </tr>
                </table>
                <br/>
            @endforeach
        @endforeach
    </div>

    @if ($quizHints->count())
        <div class="page"></div>
        <h3 class="headline">{{ trans('result.headers.nutrition_corrections') }}</h3>
        @foreach($quizHints as $hint)
            {!! auto_p($hint->hint) !!}
        @endforeach
    @endif

    @if (($foodExcludes = $record->excludes) || $deferDiseasesNotes)
        @if ($foodExcludes && $foodExcludes->count())
            <div class="page"></div>
            <h3 class="headline">{{ trans('result.headers.products_importance') }}</h3>
            @foreach($foodExcludes as $exclude)
                {!! auto_p($exclude->note) !!}
            @endforeach
        @endif

        @foreach($deferDiseasesNotes as $disease)
            {!! auto_p($disease->hasNote() ? $disease->note : $disease->parent->note) !!}
        @endforeach
    @endif

    @if ($suggestions->count())
        <div class="page"></div>
        <h3 class="headline">{{ trans('result.headers.general_recommendations') }}</h3>
        @foreach($suggestions as $item)
            {!! auto_p($item->body) !!}
        @endforeach
    @endif

    <div class="border" style="padding: 10px; margin: 20px;">
        <p>{!! trans('result.headers.contact_email', ['email' => site()->email]) !!}</p>
    </div>

    @if (show_synevo_info_for_user($user))

        <div class="page-break"></div>
        <div style="text-align: center">
            <img src="{{ dataBase64('images/synevo.png') }}" width="200" alt="">
        </div>

        {!! auto_p(glossary('promo.synevo', 'body', ['name' => $user->name])) !!}

        <p>&nbsp;</p>
        @include('dompdf.synevo_packages')

        <p>&nbsp;</p>
        @include('dompdf.synevo_labs')

    @endif

    @if (show_synevo_info_for_user($user) && $user->isOnline())
        <div class="page-break"></div>

        <p style="text-align: center;"><strong>{{ trans('result.headers.office_list') }}</strong></p>
        <?php
        $chunks = $offices->all()->chunk(2);
        ?>

        @foreach($chunks as $offices)
            <table class="table labs unbreakable">
                <tr>
                    <td width="50%" class="a-left" style="vertical-align: top">
                        <?php $office = $offices[0]; ?>
                        <ul>
                            <li style="padding-bottom: 5px;"><u
                                        style="text-transform: uppercase;">{{ $office->name }}</u></li>
                            <li>{{ $office->address }}</li>

                            @if ($phone = $office->phone)
                                <li>{{ trans('result.labels.tel') }}: {{ $phone }}</li>
                            @endif

                            @if ($gsm = $office->gsm)
                                <li>{{ trans('result.labels.gsm') }}: {{ $gsm }}</li>
                            @endif
                        </ul>
                    </td>
                    <td width="50%" class="a-left" style="vertical-align: top">
                        @if (2 == $offices->count() && ($office = $offices[1]))
                            <ul>
                                <li style="padding-bottom: 10px;"><u
                                            style="text-transform: uppercase;">{{ $office->name }}</u></li>
                                <li>{{ $office->address }}</li>

                                @if ($phone = $office->phone)
                                    <li>{{ trans('result.labels.tel') }}: {{ $phone }}</li>
                                @endif

                                @if ($gsm = $office->gsm)
                                    <li>{{ trans('result.labels.gsm') }}: {{ $gsm }}</li>
                                @endif
                            </ul>
                        @endif
                    </td>
                </tr>
            </table>
        @endforeach
    @endif

    <div class="outline"><img src="{{ dataBase64('images/header.png') }}" alt=""></div>
</div>
</body>
</html>
