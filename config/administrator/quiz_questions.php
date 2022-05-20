<?php

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title'               => 'Intrebari',
    'model'               => 'App\QuizQuestion',
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
        'rank'    => [
            'output' => function ($row) {
                return output_rank_field($row, 'rank');
            }
        ],
        'question',
        'answers' => [
            'output' => function ($row) {
                if ($group = $row->answerGroup) {
                    return view('admin.quiz.answers', [
                        'answers'  => $group->answers,
                        'group'    => $group,
                        'question' => $row
                    ]);
                }

                return '';
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
        'save_order' => [
            'title'    => 'Save order',
            'type'     => 'submit',
            'callback' => function ($model, $payload) {
                if (isset($payload['rank']) && $ranking = (array)$payload['rank']) {
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
        'answerGroup',
        'answerGroup.answers'
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

        'question'        => [
            'type'         => 'text',
            'translatable' => false
        ],
        'answer_group_id' => [
            'type'    => 'select',
            'options' => function () {
                return App\QuizAnswersGroup::lists('name', 'id');
            }
        ],
        'rank'            => ['type' => 'number']
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
    'rows_per_page'       => 10,
    'view'                => [
        'after' => 'admin.quiz.questions_after'
    ]
];