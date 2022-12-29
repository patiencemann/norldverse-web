<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateDocMediaTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('doc_media', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('doc_id');
                $table->string('file_url');
                $table->boolean('status')->default(true)->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('doc_media');
        }
    }
