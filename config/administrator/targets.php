<?php

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title' => 'Scopuri',
    'model' => 'App\Target',
    'permission' => function (\Illuminate\Contracts\Auth\Guard $guard) {
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
        'name',
        'slug'
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
    'global_actions' => [
        'create' => false
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

        'name' => ['type' => 'text'],
        'slug' => ['type' => 'key'],
        //'imc'        => ['type' => 'tinymce'],
        //        'metabolism' => [
        //            'type'        => 'tinymce',
        //            'description' =>
        //<<<METABOLISM
        //<ul class="list-unstyled">
        //    <li><i>:current_metabolism</i> - Metabolismul curent</li>
        //    <li><i>:estimated_time</i> - Timpul estimat pentru greutatea dorita</li>
        //    <li><i>:estimated_time_max</i> - Timpul estimat pentru greutatea recomandata</li>
        //    <li><i>:estimated_time_anabolic</i> - Timpul estimat pentru perioada catabolica (G dorita)</li>
        //    <li><i>:estimated_time_max_anabolic</i> - Timpul estimat pentru perioada catabolica (G recomandata)</li>
        //</ul>
        //METABOLISM
        //],
        //        'pulse'      => ['type' => 'tinymce'],
        //        'resume'     => [
        //            'type' => 'tinymce',
        //            'description' =>
        //<<<RESUME
        //<ul class="list-unstyled">
        //    <li><i>:current_weight</i> - Greutatea curenta</li>
        //    <li><i>:target_weight</i> - Greutatea dorita</li>
        //    <li><i>:estimated_time</i> - Timpul estimat pentru greutatea dorita</li>
        //    <li><i>:estimated_time_max</i> - Timpul estimat pentru greutatea recomandata</li>
        //    <li><i>:estimated_time_anabolic</i> - Timpul estimat pentru perioada catabolica (G dorita)</li>
        //    <li><i>:estimated_time_max_anabolic</i> - Timpul estimat pentru perioada catabolica (G recomandata)</li>
        //</ul>
        //RESUME
        //
        //        ],

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
        'after' => null
    ]
];