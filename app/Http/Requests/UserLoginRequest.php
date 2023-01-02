<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class UserLoginRequest extends FormRequest {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()  {
            return [
                "email" => ['required', 'string'],
                "password" => ['required', 'string']
            ];
        }
    }
