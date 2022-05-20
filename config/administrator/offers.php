<?php

use App\Site;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title' => 'Offers',

    'model' => 'App\Offer',

    'permission' => function () {
        return true;
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
        'title',
        'period' => ['output' => function ($row) {
            return $row->period . ' zile';
        }],
        'price' => ['output' => function ($row) {
            return $row->price . ' ' . (($site = $row->site) ? $site->currency : '');
        }],
        'active' => ['output' => function ($row) {
            return output_boolean($row, 'active');
        }],
        'group',
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
        'delete' => false,
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
    'query' => function ($query) {
        if (! Request::has('site_id')) {
            $query->whereSiteId(site_id());
        }

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
        'site_id' => sites_control(),
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

        'site_id' => [
            'type' => 'select',
            'options' => function () {
                return Site::lists('name', 'id')->toArray();
            },
        ],

        'title' => [
            'type' => 'text',
            'translatable' => false,
            'label' => 'Denumire',
        ],
        'period' => ['type' => 'number', 'label' => 'Termen de executare [Zile]', 'min' => 1, 'step' => 1],
        'group' => ['type' => 'select', 'options' => function () {
            return ['online' => 'Online', 'offline' => 'Offline'];
        }, 'label' => 'Tipul ofertei'],
        'price' => ['type' => 'number', 'label' => 'Pretul Actual'],
        'oldPrice' => ['type' => 'number', 'label' => 'Pretul Precedent'],

        'active' => ['type' => 'bool'],
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
    ],

    /*
    |-----------------------------------------------------------
    | Append/Prepend custom views before/after main content area
    |-----------------------------------------------------------
    */
    'view' => [
        'before' => null,
        'after' => null,
    ],
];