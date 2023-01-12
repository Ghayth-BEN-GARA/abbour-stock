<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('temp_users', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id("id_temp_users");
                $table->string('email', 999)->default("Aucun");
                $table->string('password', 999)->default("Aucun");
                $table->string('nom',500)->default('Aucun');
                $table->string('prenom',500)->default('Aucun');
                $table->datetime('date_creation')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('temp_users');
        }
    };
?>
