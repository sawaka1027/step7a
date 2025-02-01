<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PruductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => 'required',
            'product_name' => 'required | max:255',
            'price' => 'required | numeric',
            'stock' => 'required | numeric',
        ];
    }
    public function attributes()
    {
        return [
            'company_id' => 'メーカー',
            'product_name' => '商品名',
            'price' => '価格',
            'stock' => '在庫数',
        ];
    }
    public function messages() {
        return [
            'company_id.required' => ':attributeは必須項目です。',
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max' => ':attributeは:max字以内で入力してください。',
            'price.required' => ':attributeは必須項目です。',
            'price.numeric' => ':attributeは数値を入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.numeric' => ':attributeは数値を入力してください。',
        ];
    }
}
