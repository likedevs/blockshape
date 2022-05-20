<?php

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'               => 'Instructori',
    'model'               => 'App\User',
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
        'email',
        'offices' => [
            'output' => function ($row) {
                return html_ul($row->offices->lists('name'), null, ['class' => 'list-unstyled']);
            }
        ]
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
        return $query->instructor();
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
        'name' => ['type' => 'text']
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
        'role'     => [
            'type'  => 'hidden',
            'value' => 'instructor'
        ],
        'name'     => [
            'type'         => 'text',
            'translatable' => false
        ],
        'email'    => [
            'type'         => 'email',
            'translatable' => false,
            'description'  => 'A new password will be sent to this email'
        ],
        'password' => [
            'type'        => 'password',
            'description' => 'To change:<br />Leave empty for auto generating<br />Or enter a new password'
        ],
        'offices'  => [
            'type'     => 'select',
            'multiple' => true,
            'style'    => 'height: 160px; width: 250px',
            'options'  => function () {
                return \App\Office::lists('name', 'id')->toArray();
            },
            'relation' => 'offices'
        ],
        'active'   => ['type' => 'bool'],
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
        'name'  => 'required',
        'email' => function () {
            return 'required|email:unique,users,id,' . (int) \Route::current()->parameter('id');
        }
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