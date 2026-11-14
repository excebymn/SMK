<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    
    public function rules(): array
    {
        return [
            'nama_produk' => ['required', 'string', 'min:3', 'max:255'],
            'harga' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ];
    }
}
