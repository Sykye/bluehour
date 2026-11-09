<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isUser();
    }

    public function rules(): array
    {
        return [
            'service_id'      => ['required', 'exists:services,id'],
            'notes'           => ['nullable', 'string', 'max:1000'],
            'reference_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'design_image'    => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            // Ukuran Badan
            'lingkar_dada'    => ['nullable', 'numeric', 'min:30', 'max:200'],
            'lingkar_pinggang'=> ['nullable', 'numeric', 'min:30', 'max:200'],
            'lingkar_pinggul' => ['nullable', 'numeric', 'min:30', 'max:200'],
            'lebar_bahu'      => ['nullable', 'numeric', 'min:20', 'max:80'],
            'panjang_lengan'  => ['nullable', 'numeric', 'min:20', 'max:100'],
            'panjang_baju'    => ['nullable', 'numeric', 'min:30', 'max:200'],

            // Sumber Bahan
            'sumber_bahan'    => ['required', 'in:pelanggan,penjahit'],
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required'      => 'Pilih layanan terlebih dahulu.',
            'service_id.exists'        => 'Layanan yang dipilih tidak valid.',
            'reference_image.mimes'    => 'Gambar referensi harus berformat JPG, JPEG, PNG, atau WEBP.',
            'reference_image.max'      => 'Ukuran gambar referensi maksimal 2MB.',
            'design_image.mimes'       => 'File desain harus berformat JPG, JPEG, PNG, atau WEBP.',
            'design_image.max'         => 'Ukuran file desain maksimal 5MB.',
            'sumber_bahan.required'    => 'Pilih sumber bahan.',
            'sumber_bahan.in'          => 'Sumber bahan tidak valid.',
            'lingkar_dada.numeric'     => 'Lingkar dada harus berupa angka.',
            'lingkar_dada.min'         => 'Lingkar dada minimal 30 cm.',
            'lingkar_pinggang.numeric' => 'Lingkar pinggang harus berupa angka.',
            'lingkar_pinggul.numeric'  => 'Lingkar pinggul harus berupa angka.',
            'lebar_bahu.numeric'       => 'Lebar bahu harus berupa angka.',
            'panjang_lengan.numeric'   => 'Panjang lengan harus berupa angka.',
            'panjang_baju.numeric'     => 'Panjang baju harus berupa angka.',
        ];
    }
}