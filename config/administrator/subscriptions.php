<?php

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'               => 'Abonamente',
    'model'               => 'App\MSubscription',
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
        'image' => [
            'output' => function ($row){
                return "<img height='200' src='". $row->image ."'/>";
            }
        ],
        'type' => [
            'output' => function($row){
                if ($row->type == 'subscription') {
                    return "abonament";
                }else{
                    return 'consultatie cu Galina';
                }
            }
        ],
        'term' => [
            'output' => function ($row){
                return $row->term.' luni';
            },
        ],
        'price' => [
            'output' => function ($row){
                return $row->price.' euro';
            },
        ],
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
        'name' => ['type' => 'text'],
        'pagina' => ['type' => 'text'],
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
        'lang_id' => [
            'type'    => 'select',
            'title'   => 'Lang',
            'options'  => ['1' => 'ro', '2' => 'ru']
        ],
        'name' => [
            'type' => 'text',
        ],
        'term' => [
            'type' => 'text',
            'placeholder' => 'mouth',
        ],
        'type' => [
            'type' => 'select',
            'options' => ['subscription' => 'abonament', 'consultation' => 'consultatie'],
        ],
        'price' => [
            'type' => 'number',
        ],
        'image'  => [
            'type' => 'image',
            'location' => 'upfiles/subscriptions'
        ],
        'aditional_image'  => [
            'type' => 'image',
            'location' => 'upfiles/subscriptions'
        ],
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
    ]
];
