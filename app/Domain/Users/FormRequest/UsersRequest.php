<?php

namespace App\Domain\Users\Formrequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Users\Services\UsersService;

class UsersRequest extends FormRequest
{
    public function __construct(
        protected UsersService $service
    )
    {
        $this->service = $service;
    }

    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required',
            function ($attribute, $value, $fail) {
                $isDuplicate = $this->service->isDuplicate(['name' => $value], $this->route('userId'));
                if ($isDuplicate) {
                    $fail('Este email já está em uso. Por favor, escolha um diferente.');
                }
            }],
            'cellphone' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Este nome é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        
        throw new HttpResponseException(
            response()->json([
                'errors' => $errors,
            ], 422)
        );
    }
}
