<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'status'          => ['required', 'in:' . implode(',', Order::allStatuses())],
            'estimated_price' => [
                'nullable',
                'numeric',
                'min:0',
                'max:99999999',
                'required_if:status,' . Order::STATUS_MENUNGGU_PEMBAYARAN,
            ],
            'admin_notes'     => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required'                       => 'Status wajib dipilih.',
            'status.in'                             => 'Status tidak valid.',
            'estimated_price.required_if'           => 'Estimasi harga wajib diisi saat status menunggu pembayaran.',
            'estimated_price.numeric'               => 'Estimasi harga harus berupa angka.',
            'estimated_price.min'                   => 'Estimasi harga tidak boleh negatif.',
        ];
    }
}