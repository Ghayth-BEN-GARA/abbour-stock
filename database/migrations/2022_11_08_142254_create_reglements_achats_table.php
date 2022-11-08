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
            Schema::create('reglements_achats', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id('id_reglement_achat');
                $table->decimal('net_reglement_achat', 10,3)->default(0.000);
                $table->decimal('paye_reglement_achat', 10,3)->default(0.000);
                $table->date('date_reglement_achat')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->string('type_reglement_achat')->default('Facture');
                $table->string('reference_facture_achat', 999);
                $table->string('matricule_fournisseur' ,999);
                $table->foreign('reference_facture_achat')->references('reference_facture')->on('factures_achats')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('matricule_fournisseur')->references('matricule_fournisseur')->on('fournisseurs')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('reglements_achats');
        }
    };
?>
