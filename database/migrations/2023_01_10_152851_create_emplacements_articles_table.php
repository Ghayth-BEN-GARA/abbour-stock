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
            Schema::create('emplacements_articles', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id('id_emplacement_article');
                $table->string('emplacement_article_creer', 800)->default('Pas encore');
                $table->string('stock_article_creer', 800)->default('Pas encore');
                $table->bigInteger('reference_article')->unsigned()->index()->nullable();
                $table->foreign('reference_article')->references('reference_article')->on('articles')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('emplacements_articles');
        }
    };
?>
