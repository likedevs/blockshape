<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Order;
use App\Repositories\OrdersRepository;
use App\Repositories\UsersRepository;
use App\Services\CreateOrder;
use App\Traits\Auth\Tokenizer;
use App\Transformers\ArrayTransformer;
use App\User;
use Illuminate\Http\Request;
use Restable;
use Auth;

class OrdersController extends Controller
{
    use Tokenizer;

    /**
     * @var CreateOrder
     */
    protected $creator;

    public function __construct(CreateOrder $creator)
    {
        $this->creator = $creator;
    }

    public function store(Requests\CreateOrderRequest $request)
    {
        try {
            // $user = $this->userFromToken($request);
            $user = Auth::user();

            $order = $this->creator->create($user, $request->all());

            return $request->all();

            return Restable::created($order, new ArrayTransformer);
        } catch (\Exception $e) {
            return Restable::bad();
        }
    }

    /**
     * @param Request $request
     * @return User|array
     */
    protected function userFromToken(Request $request)
    {
        $user = $this->readToken($request);

        return (app(UsersRepository::class)->findAny($user['data']->id, 'id'));
    }

    public function destroy(Order $order)
    {
        try {
            $user = $this->userFromToken(request());

            $history = $order->userHistory;

            if ((int) $history->user_id !== (int) $user->id) {
                throw new \Exception("Not found");
            }

            app(OrdersRepository::class)->destroy($order);

            return Restable::deleted();
        } catch (\Exception $e) {
            return Restable::missing($e->getMessage());
        }
    }
}
