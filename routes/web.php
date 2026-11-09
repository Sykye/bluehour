<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

// ── Landing Page (publik) ────────────────────────────────
Route::get('/', function () {
    $services = Service::where('is_active', true)->take(6)->get();
    return view('welcome', compact('services'));
})->name('home');

// ── Halaman Layanan Publik ───────────────────────────────
Route::get('/layanan', function () {
    $services = Service::where('is_active', true)->paginate(12);
    return view('layanan', compact('services'));
})->name('layanan');

require __DIR__.'/auth.php';


// ── Dashboard (admin & user) ─────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});


// ── Profile (default Laravel Breeze/Jetstream) ───────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ── Admin Routes ─────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/test-admin', function () {
            return 'Anda masuk sebagai Admin ✅';
        });

        Route::resource('services', ServiceController::class);

        Route::resource('orders', AdminOrderController::class)
            ->only(['index', 'show', 'update', 'destroy']);

        // Verifikasi Pembayaran
        Route::post('/orders/{order}/verify-payment', [AdminOrderController::class, 'verifyPayment'])
            ->name('orders.verify-payment');

        Route::get('/activity-log', [ActivityLogController::class, 'index'])
            ->name('activity-log.index');
    });


// ── User Routes ──────────────────────────────────────────
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::resource('orders', UserOrderController::class)
            ->only(['index', 'create', 'store', 'show', 'destroy']);

        // Upload Bukti Pembayaran
        Route::post('/orders/{order}/upload-payment', [UserOrderController::class, 'uploadPayment'])
            ->name('orders.upload-payment');
    });