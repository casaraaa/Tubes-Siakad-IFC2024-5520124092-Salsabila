<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nidn' => ['required', 'digits:10', 'unique:dosens,nidn'],
            'nama' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'nidn.digits' => 'NIDN harus terdiri dari 10 digit angka.',
            'nidn.unique' => 'NIDN ini sudah terdaftar.',
        ];
    }
}
