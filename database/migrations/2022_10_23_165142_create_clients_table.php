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
            Schema::create('clients', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->string('matricule_client', 999)->primary();
                $table->string('nom_client', 999)->default('Aucun');
                $table->string('prenom_client', 999)->default('Aucun');
                $table->string('email_client', 999)->default('Aucun');
                $table->string('adresse_client', 800)->default('Aucun');
                $table->integer('mobile_client')->default(0);
                $table->date('date_creation_client')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('clients');
        }
    };
?>
