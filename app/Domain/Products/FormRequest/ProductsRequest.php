<?php

namespace App\Domain\Categories\Formrequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
            'name' => ['required',
            function ($attribute, $value, $fail) {
                $isDuplicate = $this->service->isDuplicate(['name' => $value], $this->route('productId'));
                if ($isDuplicate) {
                    $fail('Este email já está em uso. Por favor, escolha um diferente.');
                }
            }],
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este nome é obrigatório',
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
