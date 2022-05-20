<?php

use App\Allergy;
use App\Disease;
use App\FoodExcludes;
use App\Nutrient;
use App\Target;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

if (! function_exists('seasons')) {
    function seasons()
    {
        return [
            'summer' => 'Vara',
            'autumn' => 'Toamna',
            'winter' => 'Iarna',
            'spring' => 'Primavara'
        ];
    }

    function season($name)
    {
        return seasons()[$name];
    }
}

return [
    'title' => 'Recete',
    'model' => 'App\Recipe',
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
        'nutrient' => [
            'sortable' => function ($query, $direction) {
                return $query->join('nutrients', function ($q) {
                    $q->on('nutrients.id', '=', 'recipes.nutrient_id');
                })->orderBy('nutrients.name', $direction);
            },
            'output' => function ($row) {
                if ($nutrient = $row->nutrient) {
                    return $nutrient->name;
                }

                return '';
            }
        ],
        'name' => [
            'elements' => [
                'name' => ['standalone' => true, 'output' => '(:name) - (:quantity) / (:quantity_gain)'],
                'diseases' => [
                    'title' => 'Hide for disease',
                    'sortable' => false,
                    'output' => function ($row) {
                        if (count($excludes = $row->diseases)) {
                            return join(', ', $excludes->pluck('name')->toArray());
                        }

                        return '';
                    }
                ],
                'allergy' => [
                    'title' => 'Hide for Allergy',
                    'sortable' => false,
                    'output' => function ($row) {
                        if (count($excludes = $row->allergies)) {
                            return join(', ', $excludes->pluck('name')->toArray());
                        }

                        return '';
                    }
                ],
                'food' => [
                    'title' => 'Exclude',
                    'sortable' => false,
                    'output' => function ($row) {
                        if (count($excludes = $row->foodExcludes)) {
                            return join(', ', $excludes->pluck('name')->toArray());
                        }

                        return '';
                    }
                ],
            ],
        ],
        'snack' => [
            'output' => function ($row) {
                return output_boolean($row, 'snack');
            }
        ],
        'eating' => [
            'output' => function ($row) {
                $eatings = [1 => 'Dejun', 'Prinz', 'Cina'];

                $out = '';

                if ($row->eating) {
                    $out .= '<strong>[Slabire]</strong>';
                    $out .= html_ul(array_only($eatings, $row->eating), null, ['class' => 'list-unstyled']);
                }

                if ($row->eating_gain) {
                    $out .= '<strong>[Adaos]</strong>';
                    $out .= html_ul(array_only($eatings, $row->eating_gain), null, ['class' => 'list-unstyled']);
                }

                return $out;
            }
        ],
        'targets' => [
            'output' => function ($row) {
                return html_ul($row->targets, function ($target) {
                    return Target::whereSlug($target)->first(['name'])->name;
                }, ['class' => 'list-unstyled']);
            }
        ],
        'season' => [
            'output' => function ($row) {
                return html_ul($row->season, function ($season) {
                    return season($season);
                }, ['class' => 'list-unstyled']);
            }
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
        'nutrient',
        'diseases',
        'allergies',
        'foodExcludes'
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
        'nutrient_id' => [
            'type' => 'select',
            'options' => function () {
                return ['' => '--Any--'] + Nutrient::lists('name', 'id')->toArray();
            }
        ],
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
    'edit_fields' => [
        'nutrient_id' => [
            'label' => 'Nutrient',
            'type' => 'select',
            'options' => function () {
                return Nutrient::lists('name', 'id');
            }
        ],
        'targets' => [
            'type' => 'select',
            'label' => 'Scop',
            'options' => function () {
                return Target::lists('name', 'slug')->toArray();
            },
            'multiple' => true
        ],
        'name' => ['type' => 'text'],
        'quantity' => ['type' => 'text', 'label' => 'Quantity [Slabire, Tonifiere]'],
        'quantity_gain' => ['type' => 'text', 'label' => 'Quantity [Adaos masa musculara]'],
        'snack' => ['type' => 'bool'],
        'season' => [
            'type' => 'select',
            'style' => 'height: 120px; width: 300px;',
            'options' => function () {
                return [
                    '' => 'Toate'
                ] + seasons();
            },
            'multiple' => true
        ],
        'eating' => [
            'label' => 'Nr. mesei [Slabire, Tonifiere]',
            'type' => 'select',
            'multiple' => true,
            'options' => function () {
                return [
                    //'' => 'Toate',
                    1 => 'Dejun',
                    'Prinz',
                    'Cina'
                ];
            }
        ],
        'eating_gain' => [
            'label' => 'Nr. mesei [Adaos Masa Musculara]',
            'type' => 'select',
            'multiple' => true,
            'options' => function () {
                return [
                    1 => 'Dejun',
                    'Prinz',
                    'Cina'
                ];
            }
        ],
        'placement' => [
            'type' => 'select',
            'options' => function () {
                return [
                    '' => 'Fara preferinca',
                    'before' => "Inainte de antrenament",
                    'after' => 'Dupa antrenament'
                ];
            }
        ],
        'disease_id' => form_select('Se exclude daca sufera da', function () {
            return Disease::lists('name', 'id');
        }, true, [
            'style' => 'height: 400px; width: 500px;',
            'relation' => 'diseases',
            'description' => 'Hold Ctrl key to select multiple'
        ]),
        'allergy_id' => form_select('Se exclude daca are alergie', function () {
            return Allergy::lists('name', 'id');
        }, true, [
            'style' => 'height: 150px; width: 500px;',
            'relation' => 'allergies',
            'description' => 'Hold Ctrl key to select multiple'
        ]),
        'food_excludes_id' => form_select('Se exclude daca nu consuma', function () {
            return FoodExcludes::lists('name', 'id');
        }, true, [
            'style' => 'height: 200px; width: 500px;',
            'relation' => 'foodExcludes',
            'description' => 'Hold Ctrl key to select multiple'
        ])
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