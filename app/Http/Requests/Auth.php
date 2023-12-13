<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Auth extends FormRequest
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
            'nip' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nip.required' => 'Kolom nip harus di isi',
            'password.required' => 'Kolom password harus di isi'
        ];
    }

    public function getCredentials()
    {
        $nip = $this->get('nip');

        if ($nip) {
            return [
                'nip' => $nip,
                'password' => $this->get('password')
            ];
        }

        return $this->only('nip', 'password');
    }
}
