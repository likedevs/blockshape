<?php

use App\Site;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'  => 'Pages',

    'model'  => 'App\Page',
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

        'info' => [
            'elements' => [
                'title' => ['output' => function ($page) {
                    return link_to(route('static_page', ['slug' => $page->slug]), $page->title, ['target' => '_blank']);
                }, 'standalone' => true],
                'slug'
            ]
        ],

        'body' => ['sortable' => false, 'output' => function ($page) {
            return ($content = substr(trim(strip_tags($page->body)), 0, 600)) ? $content . ' ...' : '';
        }],

        'dates' => [
            'elements' => [
                'created_at',
                'updated_at',
            ]
        ]
    ],

    /*
    |-------------------------------------------------------
    | Actions available to do, including global
    |-------------------------------------------------------
    |
    | Global actions
    |
    */
    'actions' => [

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

        'slug' => filter_text(),

        'created_at' => filter_daterange('Created period')

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

        'title'    => form_text(),

        'body'    => form_textarea('Content', ['style' => 'width: 90%; height: 500px;']),

    ]
];