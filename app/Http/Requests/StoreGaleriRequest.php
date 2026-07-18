<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriRequest extends FormRequest
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
            'judul_foto' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'file_foto' => 'required|array',
            'file_foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max per image
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'tanggal_pelaksanaan.required' => 'Tanggal pelaksanaan kegiatan wajib diisi.',
            'file_foto.required' => 'Silakan pilih foto terlebih dahulu.',
            'file_foto.*.image' => 'File yang diunggah harus berupa gambar.',
            'file_foto.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'file_foto.*.max' => 'Ukuran salah satu foto Anda terlalu besar! Maksimal 10 MB per foto.',
        ];
    }
}
