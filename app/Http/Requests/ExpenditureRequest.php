<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExpenditureRequest extends FormRequest
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
            'supplier_product_id' => 'required|numeric',
            'currency_id' => 'required|int',
            'total_price_UZS' => 'numeric',
            'total_price_USD' => 'numeric',
            'quantity_sold' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_product_id.required' => 'mahsulot va taminotchisini kiriting',
            'supplier_product_id.numeric' => 'mahsulot va taminotchisini raqam shaklida kiriting',
            'currency_id.required' => 'valuta kiriting',
            'currency_id.int' => 'valutani raqam shaklida kiriting',
            'total_price_UZS.numeric' => "so'mni raqam shaklida kiriting",
            'total_price_USD.numeric' => 'dollarni raqam shaklida kiriting',
            'quantity.numeric' => "miqdorni raqam shaklida kiriting",
            'quantity.required' => "miqdorni kiriting"
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
