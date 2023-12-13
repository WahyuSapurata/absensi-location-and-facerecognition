<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGajiRequest extends FormRequest
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
            'uuid_user' => 'required',
            'jumlah_gaji' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'uuid_user.required' => 'Kolom user harus di isi.',
            'jumlah_gaji.required' => 'Kolom jumlah gaji harus di isi.',
        ];
    }
}
