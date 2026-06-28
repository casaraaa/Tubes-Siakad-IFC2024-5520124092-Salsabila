<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_matakuliah' => ['required', 'exists:matakuliahs,kode_matakuliah'],
            'nidn' => ['required', 'exists:dosens,nidn'],
            'kelas' => ['required', 'string', 'max:1'],
            'hari' => ['required', 'string', 'max:10'],
            'jam' => ['required', 'date_format:H:i'],
        ];
    }
}
