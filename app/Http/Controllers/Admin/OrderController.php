<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Order::class);

        $query = Order::with(['user', 'service'])->latest();

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('service', fn($s) => $s->where('name', 'like', "%{$search}%"))
                  ->orWhere('id', $search);
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load(['user', 'service']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(UpdateOrderStatusRequest $request, Order $order)
    {
        $this->authorize('update', $order);

        $oldStatus = $order->status;
        $validated = $request->validated();
        $data = ['status' => $validated['status']];

        if (!is_null($validated['estimated_price'] ?? null)) {
            $data['estimated_price'] = $validated['estimated_price'];
            $data['total_price']     = $validated['estimated_price'];
        }

        if (!is_null($validated['admin_notes'] ?? null)) {
            $data['admin_notes'] = $validated['admin_notes'];
        }

        $order->update($data);

        ActivityLogger::log('update_order_status', 'Order', $order->id, [
            'old_status'      => $oldStatus,
            'new_status'      => $order->status,
            'estimated_price' => $order->estimated_price,
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Verifikasi pembayaran
     */
    public function verifyPayment(Request $request, Order $order)
    {
        $this->authorize('verifyPayment', $order);

        $action = $request->input('action'); // 'approve' or 'reject'

        if ($action === 'approve') {
            $order->update([
                'payment_status'      => Order::PAYMENT_TERVERIFIKASI,
                'payment_verified_at' => now(),
                'status'              => Order::STATUS_DIPROSES,
            ]);
            $message = 'Pembayaran berhasil diverifikasi.';
        } else {
            $order->update([
                'payment_status' => Order::PAYMENT_DITOLAK,
            ]);
            $message = 'Pembayaran ditolak.';
        }

        ActivityLogger::log('verify_payment', 'Order', $order->id, [
            'action'         => $action,
            'payment_status' => $order->payment_status,
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', $message);
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);
        $order->delete();

        ActivityLogger::log('delete_order', 'Order', $order->id);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    public function create() { abort(404); }
    public function store($r) { abort(404); }
    public function edit(Order $order) { abort(404); }
}