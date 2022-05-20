<?php

use App\Exercise;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'               => 'Harta Exercitiu/Tensiune',
    'model'               => 'App\PressureMap',
    'permission'          => function (\Illuminate\Contracts\Auth\Guard $guard) {
        return $guard->check() && $guard->user()->isAdmin();
    },
    /*
    |-------------------------------------------------------
    | Columns/Groups
    |-------------------------------------------------------
    |
    | Describe here full list of columns that should be presented
    | on main listing page
    |
    */
    'columns'             => [
            'id',
            'exercise' => [
                'output'   => function ($row) {
                    if ($e = $row->exercise) {
                        return $e->name;
                    }

                    return 'Not set';
                },
                'sortable' => function ($query, $direction) {
                    return $query->join('exercises', function ($join) {
                        $join->on('exercises.id', '=', 'exercise_pressure_map.exercise_id');
                    })->orderBy('exercises.name', $direction);
                }
            ],


        ] + array_reduce(range(110, 200, 10), function ($out, $item) {
            $key = "p_{$item}";
            $out[$key] = ['sortable' => false];

            return $out;
        }, []),
    /*
    |-------------------------------------------------------
    | Row actions
    |-------------------------------------------------------
    |
    | Change the permission to basic action like edit, delete
    | or define new actions
    |
    */
    'actions'             => [

    ],
    /*
    |-------------------------------------------------------
    | Global actions
    |-------------------------------------------------------
    |
    | Change the permission to basic action like create
    | or define new global actions
    |
    */
    'global_actions'      => [

    ],
    /*
    |-------------------------------------------------------
    | Eloquent With Section
    |-------------------------------------------------------
    |
    | Eloquent lazy data loading, just list relations that should be preloaded
    |
    */
    'with'                => [
        'exercise'
    ],
    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query'               => function ($query) {
        return $query;
    },
    /*
    |-------------------------------------------------------
    | Global filter
    |-------------------------------------------------------
    |
    | Filters should be defined here
    |
    */
    'filters'             => [

    ],
    /*
    |-------------------------------------------------------
    | Editable area
    |-------------------------------------------------------
    |
    | Describe here all fields that should be editable
    |
    */
    'edit_fields'         => [
            'exercise_id' => [
                'type'    => 'select',
                'options' => function () {
                    return Exercise::lists('name', 'id')->toArray();
                }
            ],
        ] + array_reduce(range(110, 200, 10), function ($out, $item) {
            $key = "p_{$item}";
            $out[$key] = ['type' => 'number', 'step' => 10, 'min' => 110, 'max' => 200];

            return $out;
        }, []),
    /*
    |-------------------------------------------------------
    | Append query string for each requested url
    |-------------------------------------------------------
    |
    | List here all arguments which should be
    | appended as query string for each request
    | Initial value should come from Referrer
    |
    */
    'append_query_string' => [
        // member_id
    ],
    /*
    |-------------------------------------------------------
    | Validation rules
    |-------------------------------------------------------
    */
    'rules'               => [
        //
    ],
    /*
    |-------------------------------------------------------
    | Custom breadcrumbs
    |-------------------------------------------------------
    */
    'breadcrumbs'         => [
//        'index' => function()
//        {
//            $id      = Request::get('program_id');
//            $program = \Unica\Models\Program::find($id, ['id']);
//
//            return [
//                "programs" => ["Programs", route('admin_model_index', ['page' => 'programs'])],
//                "programs.edit" => [$program->title, route('admin_model_edit', ['page' => 'programs', 'id' => $id])],
//                "schedule" => ["Schedule", null]
//            ];
//        }
    ]
];