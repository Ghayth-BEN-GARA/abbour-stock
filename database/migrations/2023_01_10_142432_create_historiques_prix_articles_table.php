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
            Schema::create('historiques_prix_articles', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id("id_historique_prix");
                $table->decimal('prix_unitaire_article', 10,3)->default('0.000');
                $table->datetime('date_creation_prix_article')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
                $table->bigInteger('reference_article')->unsigned()->index()->nullable();
                $table->string('reference_facture',999);
                $table->foreign('reference_article')->references('reference_article')->on('articles')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('reference_facture')->references('reference_facture')->on('factures_achats')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('historiques_prix_articles');
        }
    };
?>
