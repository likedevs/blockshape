<?php

use App\Offer;
use App\Order;
use Illuminate\Contracts\Auth\Guard;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

return [
    'title' => 'Victoria Bank',

    'model' => Order::class,

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

        'details' => [
            'elements' => [
                'user_history_id' => [
                    'title' => 'ID Formular',
                ],
                'offer' => [
                    'output' => function ($row = null) {
                        if ($offer = $row->offer) {
                            return $offer->title . ' (' . $row->processedAmount() . ')';
                        }

                        return null;
                    },
                ],
                'status',
            ],
        ],

        'transactions' => [
            'output' => function ($order) {
                if (($transactions = $order->bankTransactions()->orderBy('id', 'asc')->get()) && $transactions->count()) {
                    return view('admin.orders.transactions', [
                        'transactions' => $transactions,
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
        'confirm' => [
            'title' => 'Confirm',
            'callback' => function ($order) {
                switchToSitePaymentData($order->userHistory->user->site_id);

                if ($order->status == Order::STATUS_PENDING
                    && ! empty($order->details)
                ) {
                    return VbService::confirm($order->details);
                }

                return false;
            },
        ],
        'refund' => [
            'title' => 'Refund',
            'callback' => function ($order) {
                switchToSitePaymentData($order->userHistory->user->site_id);

                if (! empty($order->details)) {
                    return VbService::reverse($order->details);
                }

                return false;
            },
        ],
        'request' => [
            'title' => 'Backup request',
            'route' => ['vb.backup-request', function ($order) {
                return ['order' => $order->id];
            }],
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
        'create' => false,
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
        return $query->whereGateway('cc-vb')->orderBy('id', 'desc');
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