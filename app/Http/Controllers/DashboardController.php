<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $data = [
                'totalUsers'    => User::where('role', 'user')->count(),
                'totalServices' => Service::count(),
                'totalOrders'   => Order::count(),
                'totalRevenue'  => Order::where('payment_status', Order::PAYMENT_TERVERIFIKASI)
                                       ->sum('total_price'),
                'recentOrders'  => Order::with(['user', 'service'])
                                        ->latest()->take(5)->get(),
                'pendingEstimation' => Order::where('status', Order::STATUS_MENUNGGU_ESTIMASI)->count(),
                'pendingPayment'    => Order::where('payment_status', Order::PAYMENT_MENUNGGU)->count(),
            ];
            return view('admin.dashboard', $data);
        }

        $data = [
            'myOrders'       => Order::where('user_id', auth()->id())
                                     ->with('service')->latest()->take(5)->get(),
            'totalMyOrders'  => Order::where('user_id', auth()->id())->count(),
            'activeOrders'   => Order::where('user_id', auth()->id())
                                     ->whereNotIn('status', [Order::STATUS_SELESAI, Order::STATUS_DIBATALKAN, Order::STATUS_DIKIRIM])
                                     ->count(),
            'activeServices' => Service::where('is_active', true)->count(),
        ];
        return view('user.dashboard', $data);
    }
}