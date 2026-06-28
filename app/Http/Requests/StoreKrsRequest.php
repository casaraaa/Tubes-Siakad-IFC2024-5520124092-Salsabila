<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKrsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_matakuliah' => ['required', 'exists:matakuliahs,kode_matakuliah'],
        ];
    }
}
