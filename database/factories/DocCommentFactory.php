<?php

    namespace Database\Factories;

    use App\Models\Doc;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class DocCommentFactory extends Factory {
        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition() {
            return [
                'doc_id' => Doc::all()->random(),
                'user_id' => User::all()->random(),
                'message' => $this->faker->realText(400)
            ];
        }
    }
