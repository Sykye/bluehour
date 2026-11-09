<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    // Admin bisa lihat semua order
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    // User hanya bisa lihat order miliknya, admin bisa lihat semua
    public function view(User $user, Order $order): bool
    {
        return $user->isAdmin() || $order->user_id === $user->id;
    }

    // Hanya user (bukan admin) yang bisa buat order
    public function create(User $user): bool
    {
        return $user->isUser();
    }

    // Hanya admin yang bisa update status
    public function update(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }

    // Admin bisa hapus (soft delete) order apa pun
    // User hanya bisa batalkan order miliknya yang masih bisa dibatalkan
    public function delete(User $user, Order $order): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isUser()
            && $order->user_id === $user->id
            && $order->canBeCancelled();
    }

    // User hanya bisa upload bukti bayar untuk order miliknya
    public function uploadPayment(User $user, Order $order): bool
    {
        return $user->isUser()
            && $order->user_id === $user->id
            && $order->canUploadPayment();
    }

    // Admin bisa verifikasi pembayaran
    public function verifyPayment(User $user, Order $order): bool
    {
        return $user->isAdmin()
            && $order->payment_status === Order::PAYMENT_MENUNGGU;
    }
}