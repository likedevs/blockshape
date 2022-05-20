<?php

use App\Office;
use App\Order;
use App\User;
use App\UserHistory;
use Carbon\Carbon;

require_once base_path('vendor/terranet/administrator/src/helpers.php');

$instructors = function () {
    $instructors = User::instructor();
    $instructors->select('users.id', 'users.name');
    if (Auth::user()->isManager()) {
        if (($iManage = Auth::user()->offices->lists('id')->toArray()) && count($iManage)) {
            $instructors->join('office_user', function ($join) use ($iManage) {
                $join->on('office_user.user_id', '=', 'users.id')
                    ->whereIn('office_user.office_id', $iManage);
            });
        } else {
            $instructors->where('1', '=', 0);
        }
    }

    return $instructors->lists('name', 'id')->toArray();
};

return [
    'title' => 'Formulare',
    'model' => 'App\UserHistory',
    'permission' => function (\Illuminate\Contracts\Auth\Guard $guard) {
        return $guard->check() && ($guard->user()->isAdmin() || $guard->user()->isManager());
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
        'id' => ['sortable' => false],
        'user' => [
            'elements' => [
                'user' => [
                    'standalone' => true,
                    'output' => function ($row) {
                        if ($user = $row->user) {
                            $name = $user->name . ($user->email ? ' (' . $user->email . ')' : '');

                            if ($user->isOnline()) {
                                $name .= '&nbsp;<span class="badge bg-blue">online</span>';
                            }

                            return $name;
                        }

                        return 'Unknown user';
                    },
                ],
                'instructor' => [
                    'output' => function ($row) {
                        if ($i = $row->instructor) {
                            return $i->name;
                        }

                        return null;
                    },
                ],
                'target' => [
                    'output' => function ($row) {
                        return $row->target->name;
                    },
                ],
                'office' => [
                    'output' => function ($row) {
                        if ($office = $row->office) {
                            return $office->name;
                        }

                        return null;
                    },
                ],
                'offer' => ['output' => function ($row) {
                    if ($order = Order::linkedToRecord($row)->latest('id')->first()) {
                        return view('admin.user_history.order', ['order' => $order]);
                    }

                    return null;
                }, 'sortable' => false, 'standalone' => true],
                'workout' => [
                    //'standalone' => true,
                    'output' => function ($row) {
                        return html_label($row->workout, ('individual' == $row->workout ? 'label-primary' : 'label-default'));
                    }],
                'priority' => [
                    //'standalone' => true,
                    'output' => function ($row) {
                        if ($priority = $row->priorityPeriod()) {
                            $deadline = $row->deadline();

                            $class = $row->confirmed() ? 'label-success' : 'label-default';
                            if (! $row->confirmed()) {
                                if ($row->deadlineExpired()) {
                                    $class = 'label-danger';
                                } else if ($row->highPriority()) {
                                    $class = 'label-warning';
                                }
                            }

                            return html_label(join(' / ', [$priority, $deadline->toDateString()]), $class);
                        }

                        return '';
                    },
                ],
                'created_at' => [
                    'title' => 'Data completării',
                    'output' => function ($row) {
                        if ($at = $row->created_at) {
                            return $at->toFormattedDateString();
                        }

                        return null;
                    },
                ],
                'purchased_at' => [
                    'title' => 'Data achitării',
                    'output' => function ($row) {
                        if (($date = $row->purchased_at) instanceof Carbon) {
                            return $date->toFormattedDateString();
                        }

                        return null;
                    },
                ],
                'accepted_at' => [
                    'title' => 'Data remiterii',
                    'output' => function ($row) {
                        if ($row->confirmed() && $at = $row->confirmedAt()) {
                            return $at->toFormattedDateString();
                        }

                        return null;
                    },
                ],
                'status' => [
                    'title' => 'Procesare',
                    'output' => function ($row) {
                        $class = $row->confirmed() ? 'label-success' : ($row->declined() ? 'label-danger' : 'label-warning');

                        return '<span class="label ' . $class . '">' . $row->status . '</span>'
                        . ($row->declineReason ? '<div style="color: red">' . $row->declineReason . '</div>' : '');
                    },
                ],
                'actions' => [
                    'standalone' => true,
                    'output' => function ($row) {
                        return view('admin.user_history.actions')->withRow($row);
                    },
                ],
            ],
        ],
        'measurements' => [
            'title' => 'Masurari',
            'sortable' => false,
            'output' => function ($row) {
                $rest = $row->pressure_rest;
                $load = $row->pressure_load;
                $type = $row->pressureType;

                $pressure =
                    (is_array($rest) && array_has($rest, 'min') && array_has($rest, 'max') ? "Rest: {$rest['max']}x{$rest['min']}<br />" : "") .
                    (is_array($load) && array_has($load, 'min') && array_has($load, 'max') ? "Load: {$load['max']}x{$load['min']}<br />" : "") .
                    ($type && $type->name ? "<span class=\"label label-default\">{$type->name}</label>" : "");

                return <<<CARDIO
H:&nbsp;{$row->height}&nbsp;cm<br />
{$row->current_weight}&nbsp;kg&nbsp;&raquo;&nbsp;{$row->target_weight}&nbsp;kg<br />
T1:&nbsp;{$row->talia1}&nbsp;cm<br />
T2:&nbsp;{$row->talia2}&nbsp;cm<br />
T3:&nbsp;{$row->talia3}&nbsp;cm<br />
F:&nbsp;{$row->buttocks}&nbsp;cm<br />
C1:&nbsp;{$row->thigh1}&nbsp;cm<br />
C2:&nbsp;{$row->thigh2}&nbsp;cm<br />
P3:&nbsp;{$row->pulse3}<br />
O1:&nbsp;{$row->bone_radius}<br />
Pressure<br />
{$pressure}
CARDIO;
            },
        ],
        'schedule' => [
            'title' => 'Orarul&nbsp;antrenamentelor',
            'sortable' => false,
            'output' => function ($record) {
                return view('admin.user_history.schedule', [
                    'record' => $record,
                    'schedule' => $record->schedule,
                ]);
            },
        ],
        'other' => [
            'title' => 'Starea&nbsp;sanatatii',
            'elements' => [
                'diseases' => [
                    'output' => function ($record) {
                        return html_ul($record->diseases->lists('name'), null, ['class' => "list-unstyled"])
                        . ($record->other_diseases ? '<div style="color: red">' . $record->other_diseases . '</div>' : "");
                    },
                ],
                'allergies' => [
                    'output' => function ($record) {
                        return html_ul($record->allergies->lists('name'), null, ['class' => "list-unstyled"])
                        . ($record->other_allergies ? '<div style="color: red">' . $record->other_allergies . '</div>' : "");
                    },
                ],
                'foodExcludes' => [
                    'output' => function ($record) {
                        return html_ul($record->excludes->lists('name'), null, ['class' => "list-unstyled"])
                        . ($record->other_excludes ? '<div style="color: red">' . $record->other_excludes . '</div>' : "");
                    },
                ],
            ],
        ],
        'nutrition' => [
            'sortable' => false,
            'title' => 'Alimentatia',
            'output' => function ($record) {
                return view('admin.user_history.nutrition', [
                    'record' => $record,
                    'answers' => $record->quizPairs,
                ]);
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
    'actions' => [
        'edit' => true,
        'delete' => function () {
            return auth()->user()->isAdmin();
        },
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
	'order',
	'order.offer',
        'user',
        'instructor',
        'target',
        'diseases',
        'allergies',
        'excludes',
        'pressureType',
        'office',
    ],
    /*
    |-------------------------------------------------------
    | QueryBuilder
    |-------------------------------------------------------
    |
    | Extend the main scaffold index query
    |
    */
    'query' => function () use ($instructors) {
        $query = UserHistory::unsorted()->select('user_history.*');

        $query->join('users', function ($join) {
            $join->on('users.id', '=', 'user_history.user_id');
        })->whereNull('users.deleted_at');

        $query->leftJoin('users as instructors', function ($join) {
            $join->on('instructors.id', '=', 'user_history.instructor_id');
        })->whereNull('instructors.deleted_at');

        if (! Request::get('site_id')) {
            $query->where('users.site_id', (int) site_id());
        }

        $query->join('orders', function ($join) {
            $join->on('orders.user_history_id', '=', 'user_history.id');
        });

        if (Auth::user()->isManager()) {
            $query->whereIn('instructor_id', array_keys($instructors()));
        }

        $query->orderBy('user_history.id', 'desc');

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
        'site_id' => sites_control(function ($query, $value = null) {
            return $query->where('users.site_id', '=', (int) $value);
        }),
        'user' => [
            'label' => 'Nume client',
            'type' => 'text',
            'query' => function ($query, $value = '') {
                return $query->where('users.name', 'LIKE', '%' . $value . '%');
            },
        ],
        'user_type' => [
            'type' => 'select',
            'label' => 'Tip client',
            'options' => [
                '' => '--Any--',
                'online' => 'Online',
                'offline' => 'Offline',
            ],
            'query' => function ($query, $value = null) {
                if (in_array($value, ['online', 'offline'])) {
                    return $query->where('users.online', (int) ('online' == $value));
                }

                return $query;
            },
        ],
        'instructor_id' => [
            'label' => 'Instructor',
            'type' => 'select',
            'options' => function () use ($instructors) {
                $instructors = $instructors();

                return [
                    '' => '--Any--',
                ] + $instructors;
            },
        ],
        'office_id' => [
            'label' => 'Filiala',
            'type' => 'select',
            'options' => function () {
                return [
                    '' => '--Any--',
                ] + Office::lists('name', 'id')->toArray();
            },
        ],
        'offer_id' => [
            'label' => 'Timpul de procesare',
            'type' => 'select',
            'options' => function () {
                $rawOffers = App\Offer::active()->with('site')->get();
                $offers = [];

                foreach ($rawOffers as $offer) {
                    $offers[title_case($offer->group)][$offer->id] = $offer->publicName();
                }

                unset($rawOffers);

                return [
                    '' => '--Any--',
                ] + $offers;
            },
            'query' => function ($query, $value = null) {
                return $query->where('orders.offer_id', '=', (int) $value);
            },
        ],
        'status' => [
            'label' => 'Statut de procesare',
            'type' => 'select',
            'options' => [
                '' => '--Any--',
                UserHistory::STATUS_PENDING => 'In asteptare',
                UserHistory::STATUS_CONFIRMED => 'Confirmat',
                UserHistory::STATUS_DECLINED => 'Refuzat',
            ],
        ],
        'payment' => [
            'label' => 'Statut de achitare',
            'type' => 'select',
            'options' => [
                '' => '--Any--',
                Order::STATUS_PENDING => 'In asteptare',
                Order::STATUS_PAID => 'Achitat',
                Order::STATUS_DECLINED => 'Refuzat',
            ],
            'query' => function ($query, $value) {
                return $query->where('orders.status', '=', $value);
            },
        ],
        'created_at' => [
            'label' => 'Completat',
            'type' => 'daterange',
        ],
        'purchased_at' => [
            'label' => 'Achitat',
            'type' => 'daterange',
        ],
        'accepted_at' => [
            'label' => 'Acceptat',
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
        'user' => [
            'type' => 'key',
            'value' => function ($row = null) {
                return $row->user->name;
            },
        ],
        'instructor' => [
            'type' => 'key',
            'value' => function ($row = null) {
                return (($i = $row->instructor) ? $i->name : 'none');
            },
        ],
        'target_id' => [
            'type' => 'select',
            'label' => 'Scopul',
            'options' => function () {
                return \App\Target::lists('name', 'id');
            },
        ],
        'office_id' => [
            'type' => 'select',
            'label' => 'Filiala',
            'options' => function () {
                return ['' => '--Online--'] + Office::lists('name', 'id')->toArray();
            },
        ],
        'workout' => ['type' => 'select', 'options' => function () {
            return trans('forms.department.workout.options');
        }],
        'height' => ['type' => 'number', 'min' => 100, 'max' => 220, 'label' => 'Inaltimea (cm)'],
        'current_weight' => ['type' => 'number', 'min' => 30, 'max' => 300, 'label' => 'Greutatea curenta (kg)'],
        'target_weight' => ['type' => 'number', 'min' => 30, 'max' => 300, 'label' => 'Greutatea dorita (kg)'],
        'bone_radius' => ['type' => 'number', 'min' => 11, 'max' => 19, 'label' => 'Osul (cm)'],
        'antropometria' => ['type' => 'key'],
        'talia1' => ['type' => 'number', 'label' => 'Talia 1'],
        'talia2' => ['type' => 'number', 'label' => 'Talia 2'],
        'talia3' => ['type' => 'number', 'label' => 'Talia 3'],
        'buttocks' => ['type' => 'number', 'label' => 'Fese'],
        'thigh1' => ['type' => 'number', 'label' => 'Coapsa 1'],
        'thigh2' => ['type' => 'number', 'label' => 'Coapsa 2'],
        'shoulders' => ['type' => 'number', 'label' => 'Solduri'],
        'figure_type_id' => [
            'type' => 'select',
            'label' => 'Tipul siluetei',
            'options' => function () {
                return \App\FigureType::lists('name', 'id');
            },
        ],
        'Sanatate' => ['type' => 'key'],
        'pulse3' => ['type' => 'number', 'label' => 'Pulse 3'],
        //        'pressure_load'  => [
        //            'type'  => 'key',
        //            'value' => function ($row) {
        //                return '' .
        //                '<input type="number" name="pressure_load[max]" value="' . (int) $row->pressure_load['max'] . '" />' .
        //                ' <span class="label label-info">x</span> ' .
        //                '<input type="number" name="pressure_load[min]" value="' . (int) $row->pressure_load['min'] . '" />';
        //            }
        //        ],
        //        'pressure_rest'  => [
        //            'type'  => 'key',
        //            'value' => function ($row) {
        //                return '' .
        //                '<input type="number" name="pressure_rest[max]" value="' . (int) $row->pressure_rest['max'] . '" />' .
        //                ' <span class="label label-info">x</span> ' .
        //                '<input type="number" name="pressure_rest[min]" value="' . (int) $row->pressure_rest['min'] . '" />';
        //            }
        //        ],
        'pressure' => [
            'label' => 'Tensiune',
            'type' => 'key',
            'value' => function ($row) {
                return
                    'Inainte: ' . $row->pressure_rest['max'] . ' x ' . $row->pressure_rest['min'] . '<br />' .
                    'Dupa: ' . $row->pressure_load['max'] . ' x ' . $row->pressure_load['min'];
            },
        ],
        'pressure_type_id' => [
            'label' => 'Reactia',
            'type' => 'select',
            'options' => function () {
                return \App\PressureType::lists('name', 'id');
            },
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
        'after' => 'admin.user_history.after',
    ],
];
