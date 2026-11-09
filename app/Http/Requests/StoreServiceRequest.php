<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price'       => ['required', 'numeric', 'min:0', 'max:99999999'],
            'image'       => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'is_active'   => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Nama layanan wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric'  => 'Harga harus berupa angka.',
            'image.mimes'    => 'Gambar harus berformat JPG, JPEG, PNG, atau WEBP.',
            'image.max'      => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}