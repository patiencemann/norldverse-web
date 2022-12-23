<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreDocRequest extends FormRequest {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            return [
                'title' => ['required', 'string'],
                'caption' => ['required', 'string'],
                'contents' => ['required', 'string'],
            ];
        }
    }
