<?php

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'               => 'Tipul constitutional',
    'model'               => 'App\ConstitutionType',
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
        'name',
        'description' => [
            'sortable' => false,
            'output'   => function ($row) {
                return html_ul($row->note);
            }
        ],
        'bone_min'    => ['title' => 'Osul [min]', 'sortable' => false],
        'bone_max'    => ['title' => 'Osul [max]', 'sortable' => false]
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

        'name'              => [
            'type'         => 'text',
            'translatable' => false
        ],
        'note[weight-loss]' => [
            'type'  => 'tinymce',
            'value' => function ($row) {
                return $row->note['weight-loss'];
            }
        ],
        'note[maintenance]' => [
            'type'  => 'tinymce',
            'value' => function ($row) {
                return $row->note['maintenance'];
            }
        ],
        'note[weight-gain]' => [
            'type'  => 'tinymce',
            'value' => function ($row) {
                return $row->note['weight-gain'];
            }
        ],
        'bone_min'          => [
            'label'   => 'circumferinta osului [min]',
            'type'    => 'select',
            'options' => function () {
                return array_combine($range = range(11, 19, 1), $range);
            }
        ],
        'bone_max'          => [
            'label'   => 'circumferinta osului [max]',
            'type'    => 'select',
            'options' => function () {
                return array_combine($range = range(11, 19, 1), $range);
            }
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
    ],
    /*
    |-----------------------------------------------------------
    | Append/Prepend custom views before/after main content area
    |-----------------------------------------------------------
    */
    'view'                => [
        'before' => null,
        'after'  => null
    ]
];