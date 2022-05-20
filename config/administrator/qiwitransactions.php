<?php

use App\Offer;
use App\Order;
use Illuminate\Contracts\Auth\Guard;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title' => 'Qiwi',

    'model' => 'App\Order',

    'permission' => function (Guard $guard) {
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

        'user' => [
            'output' => function ($row) {
                if ($user = $row->userHistory->user) {
                    return html_ul(
                        array_only($user->toArray(), ['name', 'email', 'phone', 'birth_date']),
                        null,
                        ['class' => 'list-unstyled']
                    );
                }

                return '';
            },
        ],

        'offer' => [
            'elements' => [
                'user_history_id' => [
                    'title' => 'ID Formular',
                ],
                'offer' => [
                    'output' => function ($row) {
                        if ($offer = $row->offer) {
                            return $offer->title . ' (' . $row->amount . ' ' . (site()->currency) . ')';
                        }

                        return null;
                    },
                ],
                'status' => [
                    'output' => function ($row) {
                        $class = 'paid' == $row->status ? 'bg-green' : 'bg-red';

                        return html_label($row->status, $class);
                    },
                ],
            ],
        ],

        'details' => [
            'output' => function ($order) {
                if ($details = $order->details) {
                    return view('admin.orders.qiwi_details', [
                        'details' => $details,
                    ]);
                }

                return null;
            },
        ],

        'dates' => [
            'elements' => [
                'created_at',
                'updated_at',
            ],
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
        'edit' => false,
        'delete' => false,
        'refund' => [
            'title' => 'Refund',
            'callback' => function ($order) {
                if ($order->status == Order::STATUS_PAID) {
                    $order->status = Order::STATUS_REFUND;

                    $order->save();
                }

                return false;
            },
            'confirmation' => 'Refund? Are you sure?',
        ],
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
        return $query->whereGateway('qiwi')->orderBy('id', 'desc');
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
        'id' => [
            'type' => 'text',
            'label' => 'ID Formular',
            'query' => function ($query, $value = null) {
                return $query->where('user_history_id', (int) $value);
            },
        ],

        'status' => [
            'type' => 'select',
            'options' => [
                '' => '--Any--',
                'pending' => 'Pending',
                'paid' => 'Paid',
                'declined' => 'Declined',
                'fault' => 'Fault',
                'refund' => 'Refund',
            ],
        ],

        'offer_id' => [
            'type' => 'select',
            'options' => function () {
                return [
                    '' => '--Any--',
                ] + Offer::whereGroup('online')->lists('title', 'id')->toArray();
            },
        ],

        'created_at' => [
            'label' => 'Created period',
            'type' => 'daterange',
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
    'edit_fields' => [

        'title' => [
            'type' => 'text',
            'translatable' => false,
        ],

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