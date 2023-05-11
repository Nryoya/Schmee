<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class representativeRequest extends FormRequest
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
            'school_id' => [],
            'name' => ['required'],
            'email' => ['required', 'email:filter'],
            'password' => ['required'],
        ];
    }

    /**
     * メッセージのカスタマイズ
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => ':attributeを入力してください',
            'email.required' => ':attributeを入力してください',
            'email.email' => ':attributeは正しい形で入力してください',
        ];
    }

    /**
     * attribute名のカスタマイズ
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
        ];
    }
}
