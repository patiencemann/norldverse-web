<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateDocsTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('docs', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->string('title');
                $table->longText('caption');
                $table->longText('contents');
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
            Schema::dropIfExists('docs');
        }
    }
