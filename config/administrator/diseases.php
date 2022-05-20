<?php

use App\Disease;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'               => 'Maladii',
    'model'               => 'App\Disease',
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
        'rank'     => [
            'output' => function ($row) {
                return output_rank_field($row, 'rank');
            }
        ],
        'info'     => [
            'sortable' => 'name',
            'elements' => [
                'name' => ['standalone' => true],
                'note' => [
                    'output' => function ($row) {
                        return $row->note;
                    }
                ],
            ]
        ],
        'diseases' => [
            'output'   => function ($row) {
                $out = '';

                if (count($children = $row->children)) {
                    $out = view('admin.diseases.children', ['children' => $children]);
                }

                return $out .= view('admin.diseases.create', ['parent' => $row]);
            },
            'sortable' => false
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
    'with'                => [
        'children'
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
        return Request::has('disease_id') ? $query->child(Request::get('disease_id')) : $query->main();
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
        'parent_id' => [
            'label'   => 'Group',
            'type'    => 'select',
            'options' => function () {
                return ['' => '--Top level--'] + Disease::main()->lists('name', 'id')->toArray();
            },
            'value'   => function () {
                return Request::input('disease_id');
            }
        ],
        'name'      => [
            'type'         => 'text',
            'translatable' => false
        ],
        'note'      => ['type' => 'tinymce'],
        'defer'     => ['type' => 'bool'],
        'rank'      => ['type' => "number"]
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
    ],
    /*
    |-------------------------------------------------------
    | Validation rules
    |-------------------------------------------------------
    */
    'rules'               => [
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