<?php

    namespace Database\Seeders;

    use App\Models\Doc;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class DocSeeder extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('docs')->truncate();
            Doc::factory()->count(30)->create();
        }
    }
