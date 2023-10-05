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
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif'],
                'topics' => ['required', 'array'],
                'topics.*' => ['string'],
                'blog_category_id' => ['required']
            ];
        }

        protected function prepareForValidation(): void {
            $this->merge([
                'topics' => json_decode($this->topics),
            ]);
        }
    }
