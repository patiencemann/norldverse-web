<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateDocTopicsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('doc_topics', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('doc_id');
                $table->json('topics');
                $table->boolean('active_status')->nullable()->default(true);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('doc_topics');
        }
    }
