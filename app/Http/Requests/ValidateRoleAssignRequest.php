<?php

    namespace App\Http\Requests;

    use App\Models\Role;
    use Illuminate\Foundation\Http\FormRequest;

    class ValidateRoleAssignRequest extends FormRequest {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules() {
            $roles = [Role::ADMIN, Role::SUPER_ADMIN, Role::WRITTER];

            return [
                'role' => ['required', 'string', function ($attribute, $value, $fail) use ($roles) {
                    if (!in_array($value, $roles)) {
                        $fail($attribute.' is invalid.');
                    }
                },]
            ];
        }
    }
