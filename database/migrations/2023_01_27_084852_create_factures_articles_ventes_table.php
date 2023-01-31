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
            Schema::create('factures_articles_ventes', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id('id_facture_article_vente');
                $table->integer('quantite_article')->default('0');
                $table->integer('remise_article')->default('0');
                $table->bigInteger('reference_article')->unsigned()->index();
                $table->bigInteger('reference_facture')->unsigned()->index();
                $table->foreign('reference_article')->references('reference_article')->on('articles')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('reference_facture')->references('reference_facture')->on('factures_ventes')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('factures_articles_ventes');
        }
    };
?>
