<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfilRequest extends FormRequest
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
        $rules = [
            'gambar_visi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'gambar_sejarah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ];

        $org_roles = [
            'org_kepsek', 'org_pembina', 'org_ketua', 'org_wakil', 'org_komandan', 'org_sekretaris', 'org_bendahara',
            'org_div_kesekretariatan', 'org_div_acara', 'org_div_humas', 'org_div_upacara', 'org_div_latihan'
        ];

        foreach ($org_roles as $role) {
            $rules[$role . '_foto'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240';
        }

        return $rules;
    }
    
    public function messages(): array
    {
        return [
            'image' => 'File yang diunggah harus berupa gambar.',
            'mimes' => 'Format gambar harus berupa jpeg, png, jpg, atau gif.',
            'max' => 'Ukuran gambar tidak boleh melebihi 10MB.'
        ];
    }
}
