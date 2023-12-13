<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataGuruRequest extends FormRequest
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
            'name' => 'required',
            'nip' => 'required|unique:users,nip,' . $this->route('params') . ',uuid',
            'unit' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus di isi.',
            'nip.required' => 'Kolom NIP harus di isi.',
            'nip.unique' => 'NIP sudah digunakan oleh pengguna lain.',
            'unit.required' => 'Kolom unit harus di isi.',
        ];
    }
}
