<?php

namespace App\Domain\Products\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use App\Domain\Products\Services\ProductsService;
use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    public function __construct(
        protected ProductsService $service
    )
    {}

    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'title' => ['required',
            function ($attribute, $value, $fail) {
                $isDuplicate = $this->service->isDuplicate(['title' => $value], $this->route('productId'));
                if ($isDuplicate) {
                    $fail('Este nome já está em uso. Por favor, escolha um diferente.');
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
