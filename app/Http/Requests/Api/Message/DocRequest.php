<?php

namespace App\Http\Requests\Api\Message;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class DocRequest extends FormRequest
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
            'file' => 'required',
            'key_name' => 'required',
            'extension'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Obrigatório informar o arquivo para envio',
            'phone.required' => 'O campo Telefone é obrigatório.',
            'phone.min' => 'O campo Senha deve ter no minímo 8 caracteres.',
            'key_name.required' => 'O campo Chave Key é obrigatório.',
            'extension.required' => 'O campo Chave extensão do arquivo é obrigatório.',
        ];
    }

    protected function failedValidation(Validator $validator){

        throw (new ValidationException($validator, response()->json([
            'errors' => $validator->errors()
        ], 401)));

    }
}
