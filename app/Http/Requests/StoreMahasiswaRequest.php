<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'npm' => ['required', 'digits:10', 'unique:mahasiswas,npm'],
            'nama' => ['required', 'string', 'max:50'],
            'nidn' => ['nullable', 'exists:dosens,nidn'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'npm.digits' => 'NPM harus terdiri dari 10 digit angka.',
            'npm.unique' => 'NPM ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah dipakai akun lain.',
        ];
    }
}
