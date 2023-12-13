<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJamKerjaRequest extends FormRequest
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
            'hari' => 'required',
            'jam_masuk' => 'required', // Menambahkan pengecualian untuk id saat melakukan update
            'jam_pulang' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'hari.required' => 'Kolom hari harus di isi.',
            'jam_masuk.required' => 'Kolom jam masuk harus di isi.',
            'jam_pulang.required' => 'Kolom jam pulang harus di isi.',
        ];
    }
}
