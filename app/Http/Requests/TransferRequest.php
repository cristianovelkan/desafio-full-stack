<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TransferRequest extends FormRequest
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
            'value' => 'required|numeric|gt:0',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::notIn([Auth::user()->id]),
            ],
            'date' => 'nullable|date_format:Y-m-d|after_or_equal:today',
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
            'value.required' => 'O valor da transferência deve ser informado.',
            'value.numeric' => 'O valor deve ser um número.',
            'value.gt' => 'O valor da transferência deve ser maior que 0.',
            'user_id.required' => 'O usuário destinatário deve ser informado.',
            'user_id.exists' => 'O usuário destinatário informado é inválido.',
            'user_id.not_in' => 'Você não pode transferir para você mesmo.',
            'date.date_format' => 'A data informada é inválida.',
            'date.after_or_equal' => 'A data informada deve ser igual ou posterior a hoje.',
        ];
    }
}
