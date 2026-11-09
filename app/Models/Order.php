<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    // ── Status Pesanan ────────────────────────────────────
    const STATUS_MENUNGGU_ESTIMASI   = 'menunggu_estimasi';
    const STATUS_MENUNGGU_PEMBAYARAN = 'menunggu_pembayaran';
    const STATUS_DIPROSES            = 'diproses';
    const STATUS_PENJAHITAN          = 'penjahitan';
    const STATUS_FINISHING           = 'finishing';
    const STATUS_SELESAI             = 'selesai';
    const STATUS_DIKIRIM             = 'dikirim';
    const STATUS_DIBATALKAN          = 'dibatalkan';

    // ── Payment Status ────────────────────────────────────
    const PAYMENT_BELUM        = 'belum_bayar';
    const PAYMENT_MENUNGGU     = 'menunggu_verifikasi';
    const PAYMENT_TERVERIFIKASI = 'terverifikasi';
    const PAYMENT_DITOLAK      = 'ditolak';

    protected $fillable = [
        'user_id',
        'service_id',
        'notes',
        'reference_image',
        'lingkar_dada',
        'lingkar_pinggang',
        'lingkar_pinggul',
        'lebar_bahu',
        'panjang_lengan',
        'panjang_baju',
        'sumber_bahan',
        'design_image',
        'total_price',
        'estimated_price',
        'admin_notes',
        'payment_proof',
        'payment_status',
        'payment_verified_at',
        'status',
    ];

    protected $casts = [
        'total_price'          => 'decimal:2',
        'estimated_price'      => 'decimal:2',
        'lingkar_dada'         => 'decimal:2',
        'lingkar_pinggang'     => 'decimal:2',
        'lingkar_pinggul'      => 'decimal:2',
        'lebar_bahu'           => 'decimal:2',
        'panjang_lengan'       => 'decimal:2',
        'panjang_baju'         => 'decimal:2',
        'payment_verified_at'  => 'datetime',
    ];

    // ── Relationships ─────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // ── Helpers ───────────────────────────────────────────

    public static function allStatuses(): array
    {
        return [
            self::STATUS_MENUNGGU_ESTIMASI,
            self::STATUS_MENUNGGU_PEMBAYARAN,
            self::STATUS_DIPROSES,
            self::STATUS_PENJAHITAN,
            self::STATUS_FINISHING,
            self::STATUS_SELESAI,
            self::STATUS_DIKIRIM,
            self::STATUS_DIBATALKAN,
        ];
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            self::STATUS_MENUNGGU_ESTIMASI   => 'Menunggu Estimasi',
            self::STATUS_MENUNGGU_PEMBAYARAN => 'Menunggu Pembayaran',
            self::STATUS_DIPROSES            => 'Diproses',
            self::STATUS_PENJAHITAN          => 'Penjahitan',
            self::STATUS_FINISHING           => 'Finishing',
            self::STATUS_SELESAI             => 'Selesai',
            self::STATUS_DIKIRIM             => 'Dikirim',
            self::STATUS_DIBATALKAN          => 'Dibatalkan',
            default                          => ucfirst(str_replace('_', ' ', $status)),
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusLabel($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_MENUNGGU_ESTIMASI   => 'bg-amber-100 text-amber-800',
            self::STATUS_MENUNGGU_PEMBAYARAN => 'bg-orange-100 text-orange-800',
            self::STATUS_DIPROSES            => 'bg-blue-100 text-blue-800',
            self::STATUS_PENJAHITAN          => 'bg-indigo-100 text-indigo-800',
            self::STATUS_FINISHING           => 'bg-purple-100 text-purple-800',
            self::STATUS_SELESAI             => 'bg-emerald-100 text-emerald-800',
            self::STATUS_DIKIRIM             => 'bg-teal-100 text-teal-800',
            self::STATUS_DIBATALKAN          => 'bg-red-100 text-red-800',
            default                          => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            self::PAYMENT_BELUM         => 'Belum Bayar',
            self::PAYMENT_MENUNGGU      => 'Menunggu Verifikasi',
            self::PAYMENT_TERVERIFIKASI => 'Terverifikasi',
            self::PAYMENT_DITOLAK       => 'Ditolak',
            default                     => '-',
        };
    }

    public function getPaymentStatusColorAttribute(): string
    {
        return match ($this->payment_status) {
            self::PAYMENT_BELUM         => 'bg-gray-100 text-gray-700',
            self::PAYMENT_MENUNGGU      => 'bg-yellow-100 text-yellow-800',
            self::PAYMENT_TERVERIFIKASI => 'bg-emerald-100 text-emerald-800',
            self::PAYMENT_DITOLAK       => 'bg-red-100 text-red-800',
            default                     => 'bg-gray-100 text-gray-600',
        };
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, [
            self::STATUS_MENUNGGU_ESTIMASI,
            self::STATUS_MENUNGGU_PEMBAYARAN,
        ]);
    }

    public function canUploadPayment(): bool
    {
        return $this->status === self::STATUS_MENUNGGU_PEMBAYARAN
            && $this->estimated_price > 0
            && in_array($this->payment_status, [self::PAYMENT_BELUM, self::PAYMENT_DITOLAK]);
    }
}