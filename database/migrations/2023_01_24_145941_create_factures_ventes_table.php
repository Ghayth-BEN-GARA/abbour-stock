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
            Schema::create('factures_ventes', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id("reference_facture");
                $table->date('date_facture')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->time('heure_facture')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
                $table->string('livraison_facture', 20)->default('Livré');
                $table->bigInteger('id_user')->unsigned()->nullable();
                $table->string('matricule_client', 999)->default(0);
                $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('matricule_client')->references('matricule_client')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('factures_ventes');
        }
    };
?>
