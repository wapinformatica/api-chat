<?php

namespace App\Http\Requests\Api\Message;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class TextRequest extends FormRequest
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
            'phone' => 'required|min:8',
            'message' => 'required',
            'key_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'O campo Telefone é obrigatório.',
            'phone.min' => 'O campo Senha deve ter no minímo 8 caracteres.',
            'message.required' => 'O campo Mensagem é obrigatório.',
            'key_name.required' => 'O campo Chave Key é obrigatório.',
        ];
    }

    protected function failedValidation(Validator $validator){

        throw (new ValidationException($validator, response()->json([
            'errors' => $validator->errors()
        ], 401)));

    }
}
