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
            Schema::create('reglements_ventes', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id("id_reglement_vente");
                $table->decimal('somme_reglement_vente', 10,3)->default(0.000);
                $table->decimal('account_reglement_vente', 10,3)->default(0.000);
                $table->integer('remise_totale_vente')->default(0);
                $table->date('date_reglement_vente')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
                $table->string('type_reglement_vente')->default('Facture');
                $table->integer('reference_facture_vente')->default(0);
                $table->string('matricule_client' ,999);
                $table->foreign('matricule_client')->references('matricule_client')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('reglements_ventes');
        }
    };
?>
