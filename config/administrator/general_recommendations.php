<?php

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'  => 'Recomandari generale',

    'model'  => 'App\GeneralRecommendation',

    'permission'  => function (\Illuminate\Contracts\Auth\Guard $guard) {
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
    'columns' => [
        'id',

        'rank' => [
            'output' => function ($row) {
                return output_rank_field($row, 'rank');
            }
        ],

        'body'
    ],

    /*
    |-------------------------------------------------------
    | Row actions
    |-------------------------------------------------------
    |
    | Change the permission to basic action like edit, delete
    | or define new actions
    |
    */
    'actions' => [

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
    'global_actions' => [
        'save_order' => [
            'title'    => 'Save order',
            'type'     => 'submit',
            'callback' => function ($model, $payload) {
                if (isset($payload['rank']) && $ranking = (array) $payload['rank']) {
                    /**
                     * @var Rankable $model
                     */
                    $model->syncRanking($ranking);
                }
            }
        ]
    ],

    /*
    |-------------------------------------------------------
    | Eloquent With Section
    |-------------------------------------------------------
    |
    | Eloquent lazy data loading, just list relations that should be preloaded
    |
    */
    'with' => [

    ],

    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query' => function($query)
    {
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
    'filters' => [
        'title' => ['type' => 'text'],

        'created_at' => [
            'label'=> 'Created period',
            'type' => 'daterange'
        ]
    ],

    /*
    |-------------------------------------------------------
    | Editable area
    |-------------------------------------------------------
    |
    | Describe here all fields that should be editable
    |
    */
    'edit_fields' => [
        'body'    => [
            'type' => 'tinymce'
        ]
    ],


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
    'rules' => [
        //
    ],

    /*
    |-------------------------------------------------------
    | Custom breadcrumbs
    |-------------------------------------------------------
    */
    'breadcrumbs' => [
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