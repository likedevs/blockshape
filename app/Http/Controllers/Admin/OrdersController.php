<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function createVbRequest($order)
    {
        return view('admin.orders.vb-request', [
            'order' => $order
        ]);
    }
}
