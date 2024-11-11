<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Por favor, informe seu nome',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres',
            'email.required' => 'Por favor, informe seu e-mail',
            'email.email' => 'Por favor, informe um e-mail válido',
            'email.unique' => 'Este e-mail não está disponível',
            'password.required' => 'Por favor, informe sua senha',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'c_password.required' => 'Por favor, confirme sua senha',
            'c_password.same' => 'As senhas não conferem',
        ];
    }
}
