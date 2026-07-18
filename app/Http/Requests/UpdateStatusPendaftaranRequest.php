<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusPendaftaranRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status_pendaftaran' => 'required|in:pending,approved,rejected',
        ];
    }
    
    public function messages(): array
    {
        return [
            'status_pendaftaran.required' => 'Status pendaftaran harus dipilih.',
            'status_pendaftaran.in' => 'Status pendaftaran tidak valid.',
        ];
    }
}
