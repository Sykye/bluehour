<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isUser();
    }

    public function rules(): array
    {
        return [
            'payment_proof' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:3072', // 3MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_proof.required' => 'Bukti pembayaran wajib diupload.',
            'payment_proof.file'     => 'File tidak valid.',
            'payment_proof.mimes'    => 'Bukti pembayaran harus berformat JPG, JPEG, PNG, atau WEBP.',
            'payment_proof.max'      => 'Ukuran file maksimal 3MB.',
        ];
    }
}
