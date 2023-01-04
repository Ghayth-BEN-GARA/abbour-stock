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
            Schema::create('factures_achats', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->string('reference_facture', 999)->primary();
                $table->string('matricule_fournisseur', 999);
                $table->date('date_facture')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->time('heure_facture')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
                $table->string('type_facture', 4)->default('FACT');
                $table->string('paiement_facture', 100)->default('Totale');
                $table->string('responsable_facture', 999)->default('Aucun');
                $table->bigInteger('id_user')->unsigned()->nullable();
                $table->foreign('matricule_fournisseur')->references('matricule_fournisseur')->on('fournisseurs')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('factures_achats');
        }
    };
?>
