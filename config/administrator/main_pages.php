<?php

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'               => 'Pagini',
    'model'               => 'App\MPages',
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
        'text blocks' => [
            'title' => 'Texte',
            'sortable' => false,
            'output' => function ($row) {
                if (count($row->TextsBlocks)) {
                    foreach ($row->TextsBlocks as $key => $block) {
                        echo "<li><a href='".url('admin/blocks_pages/'.$block->id.'/edit')."'>".substr($block->body, 0, 100)."...</a></li>";
                    }
                }
                return ;
            },
        ],
        'image blocks' => [
            'title' => 'imagini',
            'output' => function ($row) {
                if (count($row->ImagesBlocks)) {
                    foreach ($row->ImagesBlocks as $key => $block) {
                        echo "<a href='".url('admin/blocks_images/'.$block->id.'/edit')."'><img style='width: 45px; display: block; margin: 3px; border: 1px solid #FFF; ' src='". $block->img."'/></a>";
                    }
                }
                return ;
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
        'textsBlocks',
        'imagesBlocks'
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
        'name' => [
            'type'         => 'text'
        ],
        'slug' => [
            'type'         => 'select',
            'options' => [
                'about_author' => 'about_author',
                'subscriptions' => 'subscriptions',
                'seminars' => 'seminars',
                'events' => 'events',
                'success_stories' => 'success_stories',
                'videos' => 'videos',
                'projects' => 'projects',
                'consultation' => 'consultatie',
                'faq' => 'faq',
                'contacts' => 'contacts',
                'home' => 'home',
                'conditions' => 'conditions',
            ]
        ],
        'banner' => [
            'type'    => 'image',
            'location' => 'upfiles/pages',
        ],
        'is_home'  => [
            'type' => 'bool'
        ],
        'is_menu' => [
            'type' => 'bool',
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
