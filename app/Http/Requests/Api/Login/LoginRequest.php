<?php

namespace App\Http\Requests\Api\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'password' => 'required|min:8',
            'email' => 'required|max:191|email',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'O campo Senha é obrigatório.',
            'password.min' => 'O campo Senha deve ter no minímo 8 caracteres.',
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.max' => 'O campo e-mail deve ter no máximo 191 caracteres.',
            'email.email' => 'Informe um e-mail válido.',
        ];
    }

    protected function failedValidation(Validator $validator){

        throw (new ValidationException($validator, response()->json([
            'errors' => $validator->errors()
        ], 401)));

    }
}
