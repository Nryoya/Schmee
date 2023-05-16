<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class articleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'ttl' => ['required', 'max:100'],
            'img' => [],
            'body' => ['required', 'max:250'],
            'grade' => [],
            'class' => [],
            'send_email' => [],
        ];
    }

    /**
     * バリデーションメッセージのカスタマイズ
     * @return array
     */
    public function messages()
    {
        return [
            'ttl.required' => ':attributeを入力してください',
            'ttl.max' => ':attributeは100文字以内で入力してください',
            'body.required' => ':attributeを入力してください',
            'body.max' => ':attributeは250文字以内で入力してください',
        ];
    }

    /**
     * attribute名をカスタマイズ
     * @return array
     */
    public function attributes()
    {
        return [
            'ttl' => 'タイトル',
            'body' => '記事内容'    
        ];
    }
}