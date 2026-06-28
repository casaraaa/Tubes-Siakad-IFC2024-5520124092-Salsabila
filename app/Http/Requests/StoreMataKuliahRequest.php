<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMataKuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_matakuliah' => ['required', 'string', 'max:8', 'unique:matakuliahs,kode_matakuliah'],
            'nama_matakuliah' => ['required', 'string', 'max:50'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
        ];
    }
}
