<?php

    namespace Database\Seeders;

    use App\Models\DocComment;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class DocCommentSeeder extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            DB::table('doc_comments')->truncate();
            DocComment::factory()->count(40)->create();
        }
    }
