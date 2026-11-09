<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'        => 'Jahit Kemeja Pria',
                'description' => 'Pembuatan kemeja pria custom dengan bahan pilihan dan jahitan rapi berkualitas tinggi. Cocok untuk acara formal maupun kasual.',
                'price'       => 250000,
                'is_active'   => true,
            ],
            [
                'name'        => 'Jahit Gaun Wanita',
                'description' => 'Pembuatan gaun wanita elegan dengan desain custom sesuai keinginan. Tersedia berbagai model dari casual hingga pesta.',
                'price'       => 500000,
                'is_active'   => true,
            ],
            [
                'name'        => 'Jahit Jas / Blazer',
                'description' => 'Pembuatan jas atau blazer premium dengan fitting presisi. Ideal untuk kebutuhan bisnis dan acara formal.',
                'price'       => 750000,
                'is_active'   => true,
            ],
            [
                'name'        => 'Jahit Celana',
                'description' => 'Pembuatan celana pria/wanita custom. Tersedia berbagai model: chino, formal, cullotes, dan lainnya.',
                'price'       => 200000,
                'is_active'   => true,
            ],
            [
                'name'        => 'Jahit Kebaya',
                'description' => 'Pembuatan kebaya tradisional maupun modern dengan detail bordir dan payet sesuai permintaan.',
                'price'       => 600000,
                'is_active'   => true,
            ],
            [
                'name'        => 'Permak & Reparasi',
                'description' => 'Layanan permak pakaian: mengecilkan, membesarkan, mengganti resleting, memperbaiki jahitan, dan lainnya.',
                'price'       => 50000,
                'is_active'   => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
