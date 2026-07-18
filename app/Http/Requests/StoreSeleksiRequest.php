<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSeleksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Use policy or middleware in real scenario
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'jenis_seleksi' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0|max:100', // Better to restrict numeric and range
            'keterangan' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_seleksi.required' => 'Jenis seleksi harus dipilih.',
            'nilai.required' => 'Nilai wajib diisi.',
            'nilai.numeric' => 'Nilai harus berupa angka.',
            'nilai.min' => 'Nilai minimal adalah 0.',
            'nilai.max' => 'Nilai maksimal adalah 100.',
        ];
    }
}
