<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    public function history()
    {
        $orders = OrderProduct::latest()->get();
        return view('user.riwayat', compact('orders'));
    }
}
