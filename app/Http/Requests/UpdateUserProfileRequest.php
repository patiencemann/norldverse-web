<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class UpdateUserProfileRequest extends FormRequest {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            return [
                'fullname' => ['string'],
                'bio' => ['string'],
                'position' => ['string'],
                'twitter_handler' => ['string']
            ];
        }
    }
