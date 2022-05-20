<?php

use App\LanguageKey;
use Illuminate\Filesystem\Filesystem;
use Terranet\Multilingual\Language;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'               => 'Translations',
    'model'               => 'App\LanguageKey',
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
    'columns'             => [
        'id',
        'info'   => [
            'elements' => [
                'key' => ['standalone' => true],
                'group',
            ]
        ],
        'values' => [
            'sortable' => false,
            'output'   => function ($row) {
                return html_ul($row->translations->filter(function ($item) {
                    return $item->value;
                })->map(function ($item) {
                    return '[' . strtoupper($item->language->slug) . '] ' . $item->value;
                }), null, ['class' => 'list-unstyled']);
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
        'delete' => false
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
        'create'            => false,
        'load_translations' => [
            'title'    => 'Load',
            'callback' => function () {
                Artisan::call('translations:load');
            }
        ],
        'save_translations' => [
            'title'    => 'Dump',
            'callback' => function () {
                Artisan::call('translations:dump');
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
        //'key'   => ['type' => 'text'],
        'value' => [
            'type'  => 'text',
            'query' => function ($query, $value = null) {
                return $query->join('language_key_translations', function ($join) {
                    $join->on('translation_id', '=', 'language_keys.id');
                })->where('language_key_translations.value', 'LIKE', '%' . $value . '%');
            }
        ],
        'group' => [
            'type'    => 'select',
            'options' => function () {
                return ['' => '--Any--'] + LanguageKey::lists('group', 'group')->toArray();
            }
        ],
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
        'group' => [
            'type' => 'key'
        ],
        'key'   => [
            'type' => 'key',
        ],
        'value' => [
            'type'         => 'textarea',
            'translatable' => true
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