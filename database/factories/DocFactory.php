<?php

    namespace Database\Factories;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class DocFactory extends Factory {
        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition() {
            return [
                'user_id' => User::all()->random(),
                'title' => $this->faker->realText(),
                'caption' => $this->faker->realText(300),
                'contents' => $this->faker->realText(90000)
            ];
        }
    }
