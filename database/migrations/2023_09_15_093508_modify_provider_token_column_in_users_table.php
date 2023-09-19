<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class ModifyProviderTokenColumnInUsersTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::table('users', function (Blueprint $table) {
                $table->longText('provider_token')->change();
                $table->longText('provider_remember_token')->change();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::table('users', function (Blueprint $table) {
                $table->text('provider_token')->change();
                $table->text('provider_remember_token')->change();
            });
        }
    }
