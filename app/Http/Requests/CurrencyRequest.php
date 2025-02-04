<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CurrencyRequest extends FormRequest
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
            'currency_name' => 'required|string|max:150'
        ];
    }


        public function messages(): array
    {
        return [
            'currency_name.required' => 'valuta nomi yozilishi shart',
            'currency_name.max' => "valuta nomida eng ko'pi 150 ta harf yozish mumkin",
            'currency_name.string' => 'valuta nomi yozuv shaklida yozilishi shart'
        ];
    }


   
        protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}
