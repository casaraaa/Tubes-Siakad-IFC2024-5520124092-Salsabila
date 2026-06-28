<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMataKuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ];
    }
}
