<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with('order_items.product.brand', 'order_items.product.category')->get();
        return Inertia::render('User/Dashboard', ['orders' => $orders]);
    }

    public function contact_index()
    {
        return Inertia::render('User/Contact');
    }

    public function about()
    {
        return Inertia::render('User/About');
    }
}
