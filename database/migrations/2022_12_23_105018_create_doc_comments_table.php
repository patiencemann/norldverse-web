<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateDocCommentsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('doc_comments', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->unsignedBigInteger('doc_id');
                $table->unsignedBigInteger('user_id');
                $table->longText('message');
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
            Schema::dropIfExists('doc_comments');
        }
    }
