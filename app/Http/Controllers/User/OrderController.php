<?php

namespace App\Http\Controllers\User;

use App\Helpers\ActivityLogger;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UploadPaymentRequest;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('service')->latest()->paginate(10);
        return view('user.orders.index', compact('orders'));
    }

    public function create()
    {
        $this->authorize('create', Order::class);
        $services = Service::where('is_active', true)->get();
        return view('user.orders.create', compact('services'));
    }

    public function store(StoreOrderRequest $request)
    {
        $this->authorize('create', Order::class);
        $validated = $request->validated();

        // Upload reference image
        if ($request->hasFile('reference_image')) {
            $validated['reference_image'] = FileUploadHelper::uploadImage(
                $request->file('reference_image'), 'orders/references'
            );
        }

        // Upload design image
        if ($request->hasFile('design_image')) {
            $validated['design_image'] = FileUploadHelper::uploadImage(
                $request->file('design_image'), 'orders/designs'
            );
        }

        $order = Order::create([
            'user_id'          => auth()->id(),
            'service_id'       => $validated['service_id'],
            'notes'            => $validated['notes'] ?? null,
            'reference_image'  => $validated['reference_image'] ?? null,
            'design_image'     => $validated['design_image'] ?? null,
            'lingkar_dada'     => $validated['lingkar_dada'] ?? null,
            'lingkar_pinggang' => $validated['lingkar_pinggang'] ?? null,
            'lingkar_pinggul'  => $validated['lingkar_pinggul'] ?? null,
            'lebar_bahu'       => $validated['lebar_bahu'] ?? null,
            'panjang_lengan'   => $validated['panjang_lengan'] ?? null,
            'panjang_baju'     => $validated['panjang_baju'] ?? null,
            'sumber_bahan'     => $validated['sumber_bahan'],
            'total_price'      => 0, // akan diisi admin via estimasi
            'status'           => Order::STATUS_MENUNGGU_ESTIMASI,
            'payment_status'   => Order::PAYMENT_BELUM,
        ]);

        $order->load('service');

        ActivityLogger::log('create_order', 'Order', $order->id, [
            'service_id'   => $order->service_id,
            'service'      => $order->service->name,
            'sumber_bahan' => $order->sumber_bahan,
        ]);

        return redirect()->route('user.orders.index')
            ->with('success', 'Pesanan berhasil dibuat! Tunggu estimasi harga dari admin.');
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        $order->load('service');
        return view('user.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);
        $order->update(['status' => Order::STATUS_DIBATALKAN]);

        ActivityLogger::log('cancel_order', 'Order', $order->id);

        return redirect()->route('user.orders.index')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    /**
     * Upload bukti pembayaran
     */
    public function uploadPayment(UploadPaymentRequest $request, Order $order)
    {
        $this->authorize('uploadPayment', $order);

        // Hapus bukti lama jika ada
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $path = FileUploadHelper::uploadImage(
            $request->file('payment_proof'), 'orders/payments'
        );

        $order->update([
            'payment_proof'  => $path,
            'payment_status' => Order::PAYMENT_MENUNGGU,
        ]);

        ActivityLogger::log('upload_payment', 'Order', $order->id);

        return redirect()->route('user.orders.show', $order)
            ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }

    public function edit(Order $order) { abort(404); }
    public function update($r, Order $order) { abort(404); }
}