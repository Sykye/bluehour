<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // ── Ukuran Badan ──────────────────────────────────
            $table->decimal('lingkar_dada', 6, 2)->nullable()->after('reference_image');
            $table->decimal('lingkar_pinggang', 6, 2)->nullable()->after('lingkar_dada');
            $table->decimal('lingkar_pinggul', 6, 2)->nullable()->after('lingkar_pinggang');
            $table->decimal('lebar_bahu', 6, 2)->nullable()->after('lingkar_pinggul');
            $table->decimal('panjang_lengan', 6, 2)->nullable()->after('lebar_bahu');
            $table->decimal('panjang_baju', 6, 2)->nullable()->after('panjang_lengan');

            // ── Sumber Bahan ──────────────────────────────────
            $table->enum('sumber_bahan', ['pelanggan', 'penjahit'])
                  ->default('penjahit')
                  ->after('panjang_baju');

            // ── Upload Desain Custom ──────────────────────────
            $table->string('design_image')->nullable()->after('sumber_bahan');

            // ── Estimasi Harga oleh Admin ─────────────────────
            $table->decimal('estimated_price', 12, 2)->nullable()->after('total_price');
            $table->text('admin_notes')->nullable()->after('estimated_price');

            // ── Pembayaran ────────────────────────────────────
            $table->string('payment_proof')->nullable()->after('admin_notes');
            $table->enum('payment_status', [
                'belum_bayar',
                'menunggu_verifikasi',
                'terverifikasi',
                'ditolak',
            ])->default('belum_bayar')->after('payment_proof');
            $table->timestamp('payment_verified_at')->nullable()->after('payment_status');
        });

        // ── Ubah status column dari enum ke string agar mendukung status baru ──
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status', 30)->default('menunggu_estimasi')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status', 30)->default('pending')->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'lingkar_dada',
                'lingkar_pinggang',
                'lingkar_pinggul',
                'lebar_bahu',
                'panjang_lengan',
                'panjang_baju',
                'sumber_bahan',
                'design_image',
                'estimated_price',
                'admin_notes',
                'payment_proof',
                'payment_status',
                'payment_verified_at',
            ]);
        });
    }
};
