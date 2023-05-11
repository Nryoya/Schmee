<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
            'email' => ['required', 'email:filter', 'exists:users,email']
        ];
    }

    /**
     * バリデーションメッセージのカスタマイズ
     * 
     * @return array
     */
    public function messages() {
        return [
            'email.required' => ':attributeを入力してください',
            'email.email' => '正しいメールアドレスを入力してください',
            'email.exists' => '登録している:attributeを入力してください'
        ];
    }

    /**
     * attribute名をカスタマイズ
     *
     * @return array
     */
    public function attribute() {
        return [
            'email' => 'メールアドレス',
        ];
    }
}
