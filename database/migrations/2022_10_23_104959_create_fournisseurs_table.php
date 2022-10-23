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
            Schema::create('fournisseurs', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->string('matricule_fournisseur', 999)->primary();
                $table->string('fullname_fournisseur', 999)->default('Aucun');
                $table->string('email_fournisseur', 999)->default('Aucun');
                $table->string('adresse_fournisseur', 800)->default('Aucun');
                $table->integer('mobile1_fournisseur')->default(0);
                $table->integer('mobile2_fournisseur')->default(0);
                $table->date('date_creation_fournisseur')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('fournisseurs');
        }
    };
?>
