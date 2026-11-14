<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProdukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_produk' => ['sometimes', 'required', 'string', 'min:3', 'max:255'],
            'harga' => ['sometimes', 'required', 'numeric', 'min:0'],
            'stok' => ['sometimes', 'required', 'integer', 'min:0'],
        ];
    }
}
