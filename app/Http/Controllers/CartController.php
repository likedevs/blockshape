<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Page;
use App\MPages;
use App\MSubscription;
use App\MSeminars;
use App\MEvents;
use App\MVideoStories;
use App\MPhotoStories;
use App\MVideo;
use App\MProjects;
use App\UserHistory;
use App\User;
use App\Cart;
use App\Order;
use App\MOrder;
use Input;
use Auth;
use Session;
use App\Services\Contracts\HtmlBuilder;


class CartController extends MainController
{
    private $types = ['subscrs', 'events', 'seminars', 'consult'];

    public function index()
    {
        return redirect()->back();
        $order = MOrder::where('user_id', Auth::user()->id)->where('status', 'pending')->first();

        if (is_null($order)) {
            return redirect()->back();
        }

        $cart = Cart::where('user_id', Auth::user()->id)->where('order_id', $order->id)->get();

        $data['cart'] = $cart;
        $data['total'] = $order->amount;
        return view('front.pages.cart', $data);
    }

    public function getOrder($price)
    {
        $id  = Auth::user()->id;
        $order = MOrder::where('user_id', $id)->where('status', 'pending')->first();
        if (is_null($order)) {
            $ret = MOrder::create([
                'user_id' => $id,
                'status' => 'pending',
                'amount' => $price,
            ]);
        }else{
            MOrder::where('user_id', $id)->where('status', 'pending')->update([
                'amount' => $order->amount + $price,
            ]);
            $ret =  MOrder::where('user_id', $id)->where('status', 'pending')->first();
        }
        return $ret;
    }

    public function subscriptions($id)
    {
        $type = $this->types[0];
        $subscr = MSubscription::find($id);

        if (is_null($subscr)) { return redirect()->back(); }

        $order = $this->getOrder($subscr->price);

        $cartProd = Cart::where('user_id', Auth::user()->id)
                        ->where('prod_id', $id)
                        ->where('type', $type)
                        ->where('order_id', $order->id)
                        ->first();

        if (is_null($cartProd)) {
            if (!is_null($subscr)) {
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'prod_id' => $subscr->id,
                    'order_id' => $order->id,
                    'type' => $type,
                    'price' => $subscr->price,
                ]);
            }
        }

        Session::flash('cartMessage', $subscr->name.' it was added. View cart or continue shopping');

        return redirect()->back();
    }

    public function events($id)
    {
        $type = $this->types[1];
        $event = MEvents::find($id);

        $cartProd = Cart::where('user_id', Auth::user()->id)
                        ->where('prod_id', $id)
                        ->where('type', $type)
                        ->first();

        if (is_null($cartProd)) {
            if (!is_null($event)) {
                $order = $this->getOrder($event->price);
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'prod_id' => $event->id,
                    'order_id' => $order->id,
                    'type' => $type,
                    'price' => $event->price,
                ]);
            }
            Session::flash('cartMessage', $event->title.' it was added. View cart or continue shopping');
            return redirect()->back();
        }

        Session::flash('cartMessage', $event->title.' it is already added to the cart or ordered');
        return redirect()->back();

    }

    public function seminars($id)
    {
        $type = $this->types[2];
        $seminar = MSeminars::find($id);
        $order = $this->getOrder($seminar->price);

        $cartProd = Cart::where('user_id', Auth::user()->id)
                        ->where('prod_id', $id)
                        ->where('type', $type)
                        ->where('order_id', $order->id)
                        ->first();

        if (is_null($cartProd)) {
            if (!is_null($seminar)) {
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'prod_id' => $seminar->id,
                    'order_id' => $order->id,
                    'type' => $type,
                    'price' => $seminar->price,
                ]);
            }
            Session::flash('cartMessage', $seminar->title.' it is already added to the cart or ordered');
            return redirect()->back();
        }

        Session::flash('cartMessage', $seminar->title.' it was added. View cart or continue shopping');
        return redirect()->back();
    }

    public function consults($id)
    {
        $type = $this->types[3];
        $seminar = MSubscription::find($id);

        $cartProd = Cart::where('user_id', Auth::user()->id)
                        ->where('prod_id', $id)
                        ->where('type', $type)
                        ->first();

        if (is_null($cartProd)) {
            if (!is_null($seminar)) {
                $order = $this->getOrder($seminar->price);
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'prod_id' => $seminar->id,
                    'order_id' => $order->id,
                    'type' => $type,
                    'price' => $seminar->price,
                ]);
            }
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        $cart = Cart::find($id);

        $order = MOrder::where('id', $cart->order_id)->first();

        if (!is_null($order)) {
            MOrder::where('id', $order->id)->update([
                'amount' => $order->amount - $cart->price,
            ]);
        }


        if (!is_null($cart)) {
            Cart::where('id', $id)
                ->delete();
        }
        return redirect()->back();
    }

    public function getPay()
    {
        $historyUserId = UserHistory::where('user_id', Auth::user()->id)->first();
        $orderCart = MOrder::where('user_id', Auth::user()->id)->where('status', 'pending')->first();
        if (is_null($historyUserId) || is_null($orderCart)) { return dd('404'); }

        $this->_deleteFailedOrders($historyUserId);
        $total = $orderCart->amount;

        $lastOrderId = Order::orderBy('order_id', 'desc')->first();
        $order_id =  1;
        if (!is_null($lastOrderId)) {
            $order_id =  $lastOrderId->order_id + 1;
        }

        $order = Order::create([
            'user_history_id' => $historyUserId->id,
            'offer_id' => 5,
            'gateway' => 'cc-vb',
            'order_id' => $order_id,
            'amount' => $total,
            'discount' => 0,
            'period' => 10,
            'status' => 'pending',
            'expires_at' => strtotime(date('Y-m-d h:i:s')),
            'valid' => 1,
            'comand_id' => $orderCart->id,
        ]);

        $data['total'] = $orderCart->amount;
        $data['order_id'] = $order->id;
        return view('front.pages.payment', $data);
    }

    private function _deleteFailedOrders($hitoryId)
    {
        $orders = Order::where('user_history_id', $hitoryId->id)
                        ->where('status', 'pending')
                        ->where('valid', '1')
                        ->get();
        if (!empty($orders)) {
            foreach ($orders as $key => $order) {
                Order::where('id', $order->id)->delete();
            }
        }
    }

    private function _countTotalPrice($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $key => $value) {
                $total += $value->price;
            }
        }
        return $total;
    }
}
