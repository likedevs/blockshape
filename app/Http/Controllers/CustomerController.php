<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateHistoryRecordRequest;
use App\Order;
use App\Repositories\OrdersRepository;
use App\Repositories\UserHistoryRepository;
use App\Repositories\UsersRepository;
use App\Services\Contracts\PdfBuilder;
use App\Services\CreateOrder;
use App\Services\HistoryCreator;
use App\Traits\Auth\Tokenizer;
use App\Transformers\UserHistoryTransformer;
use App\Transformers\UserTransformer;
use App\User;
use App\UserHistory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Writer\PDF;
use Restable;
use Users;
use Validator;

class CustomerController extends Controller
{
    use Tokenizer;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ["form", "persistForm", "downloadUser"]]);
    }

    /**
     * Show create customer form
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customer.create', ['form' => []]);
    }

    /**
     * Handle a registration request for the application.
     * Create a new customer
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = Users::createOrUpdateCustomer($request->all());

        return redirect()->route('customer.show', ['customer' => $user]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @param User $user
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, User $user = null)
    {
        return Validator::make($data, [
            'name'             => 'required|max:255',
            'email'            => 'email|max:255|unique:users' . ($user && $user->exists ? ",email,{$user->id}" : ''),
            'phone'            => 'required|unique:users' . ($user && $user->exists ? ",phone,{$user->id}" : ''),
            'birth_date.year'  => 'required|integer',
            'birth_date.month' => 'required|integer|in:' . join(',', range(1, 12, 1)) . '',
            'birth_date.day'   => 'required|integer|in:' . join(',', range(1, 31, 1)) . '',
        ]);
    }

    /**
     * Update customer info
     *
     * @param User $user
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, Request $request)
    {
        $validator = $this->validator($request->all(), $user);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Users::createOrUpdateCustomer($request->all(), $user);

        return redirect()->back();
    }

    /**
     * Show edit customer form
     *
     * @param User $user
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $form = $this->prepareUserData($user);

        return view('customer.create', [
            'user' => $user,
            'form' => $form
        ]);
    }

    /**
     * @param User $user
     * @return array
     */
    protected function prepareUserData(User $user)
    {
        $form = $user->toArray();

        list($year, $month, $day) = explode('-', $form['birth_date']);
        $form['birth_date'] = array_map(function ($val) {
            return (int) $val;
        }, compact(['year', 'month', 'day']));
        $form['phone'] = str_replace('+373', '', $form['phone']);

        return $form;
    }

    /**
     * Customer history
     *
     * @param User $user
     *
     * @param UserHistoryRepository $historyRepository
     * @return \Illuminate\View\View
     */
    public function show(User $user, UserHistoryRepository $historyRepository)
    {
        return view('customer.show', [
            'user'    => $user,
            'history' => $historyRepository->createdForUserByInstructor($user, auth()->user())
        ]);
    }

    /**
     * Self Signed User record form
     */
    public function form()
    {
        return view('customer.form.create');
    }

    public function persistForm(CreateHistoryRecordRequest $request, HistoryCreator $creator, UserHistory $record = null)
    {
        try {
            // $user = $this->readToken($request);

            // $user = app(UsersRepository::class)->findAny($user['data']->id);
            $user = app(UsersRepository::class)->findAny(Auth::user()->id);

            $record = $creator->persist($user, $record, $request->all());

            return Restable::created($record, new UserHistoryTransformer);
        } catch (\Exception $e) {
            return Restable::bad([
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * User history record
     *
     * @param User $user
     * @param UserHistory $record
     *
     * @return \Illuminate\View\View
     */
    public function record(User $user, UserHistory $record = null)
    {
        $payload = $this->preparePayload($user, $record);

        $payload['instructor'] = Auth::user();

        return view('customer.record.create', $payload);
    }

    /**
     * @param User $user
     * @param UserHistory $record
     *
     * @return array
     */
    private function preparePayload(User $user, UserHistory $record)
    {
        $payload = ['user' => $user];
        if ($record && $record->exists) {
            $payload = array_merge($payload, [
                'record' => $record,
                'json'   => (new UserHistoryTransformer)->transform($record)
            ]);

            return $payload;
        } else {
            $date = Carbon::today();
            $payload['json'] = (object) [
                'created_at'   => [
                    'year'  => $date->year,
                    'month' => $date->month,
                    'day'   => $date->day
                ],
                'purchased_at' => [
                    'year'  => $date->year,
                    'month' => $date->month,
                    'day'   => $date->day
                ]
            ];

            return $payload;
        }
    }

    /**
     * Store user history record
     *
     * @param User $user
     * @param UserHistory $record
     * @param CreateHistoryRecordRequest $request
     * @param HistoryCreator $creator
     *
     * @param OrdersRepository $orders
     * @param CreateOrder $orderCreator
     * @return string
     */
    public function persistRecord(
        User $user,
        UserHistory $record = null,
        CreateHistoryRecordRequest $request,
        HistoryCreator $creator,
        OrdersRepository $orders,
        CreateOrder $orderCreator
    )
    {
        try {
            $record = \DB::transaction(function () use ($creator, $orderCreator, $user, $record, $request, $orders) {
                $record = $creator->persist($user, $record, $request->all());

                $orderData = [
                    'offer'    => $request->get('offer_id'),
                    'history'  => $record->id,
                    'gateway'  => Order::GATEWAY_CASH,
                    'discount' => $request->get('discount', 0),
                    'status'   => Order::STATUS_PAID,
                    'workout'  => $record->workout
                ];

                if (! $order = $orders->firstByOptions(['user_history_id' => $record->id])) {
                    $orderCreator->create($record->user, $orderData);
                } else {
                    $orderCreator->update($order, $orderData);
                }

                return $record;
            });

            return Restable::created($record, new UserHistoryTransformer);
        } catch (\Exception $e) {
            return Restable::bad('Bad request: ' . $e->getMessage());
        }
    }

    /**
     * Search for a customer
     *
     * @ajax
     *
     * @param Request $request
     *
     * @return string
     */
    public function search(Request $request)
    {
        $name = $request->get('query');

        $customers = Users::search($name, 'name');

        return Restable::listing($customers, new UserTransformer);
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function destroy(User $user)
    {
        // @todo
        return $user;
    }

    /**
     * A point to download TNF for online users.
     *
     * @param User $user
     * @param UserHistory $record
     * @param $hash
     * @param PdfBuilder $builder
     * @return \Illuminate\View\View
     */
    public function downloadUser(User $user, UserHistory $record, $hash, PdfBuilder $builder)
    {
        if ($token = download_tnf_token($user, $record) !== $hash) {
            abort(404, "TNF not found.");
        }

        return $this->download($user, $record, $builder);
    }

    /**
     * Download resulted document
     *
     * @param User $user
     * @param UserHistory $record
     *
     * @param PdfBuilder $builder
     * @return \Illuminate\View\View
     */
    public function download(User $user, UserHistory $record, PdfBuilder $builder)
    {
        if (! $record->hasDocument()) {
            abort(404, 'Document not found!');
        }

        $pdf = $builder->build($record->document);

        return response()->stream(function () use ($pdf) {
            echo $pdf;
        }, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Testarea-nutritionala-fiziologica.pdf"'
        ]);
    }
}
