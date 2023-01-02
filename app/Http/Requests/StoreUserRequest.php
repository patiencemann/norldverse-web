<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreUserRequest extends FormRequest {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            return [
                'name' => ['required', 'string'],
                'email' => ['required', 'string'],
                'password' => ['required', 'string']
            ];
        }
    }
