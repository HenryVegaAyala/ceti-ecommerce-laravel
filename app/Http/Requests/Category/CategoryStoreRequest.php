<?php

namespace App\Http\Requests\Category;

use App\Modules\Config\Request\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CategoryStoreRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'description' => 'required|nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es requerido',
            'name.string' => 'El campo nombre debe ser una cadena de texto',
            'name.max' => 'El campo nombre no debe exceder los 20 caracteres',
            'description.required' => 'El campo descripción es requerido',
            'description.string' => 'El campo descripción debe ser una cadena de texto',
            'description.max' => 'El campo descripción no debe exceder los 100 caracteres',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator The validator instance containing validation errors.
     *
     * @throws HttpResponseException Thrown when validation fails to return an error response.
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new ValidationException($validator);

        throw new HttpResponseException($this->errorResponse($response->errors()));
    }
}
