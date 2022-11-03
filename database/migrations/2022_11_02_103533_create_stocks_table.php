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
            Schema::create('stocks', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id('id_stock');
                $table->integer('quantite_stock')->default(0);
                $table->decimal('prix_achat_article', 10,3)->default(0.000);
                $table->decimal('marge_prix',10,3)->default(20.000);
                $table->bigInteger('reference_article')->unsigned()->index();
                $table->foreign('reference_article')->references('reference_article')->on('articles')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('stocks');
        }
    };
?>
