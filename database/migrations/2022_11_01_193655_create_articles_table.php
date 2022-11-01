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
            Schema::create('articles', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id('reference_article');
                $table->string('designation',999)->default('Aucun');
                $table->string('description',999)->default('Aucun');
                $table->string('categorie',700)->default('Aucun');
                $table->date('date_creation_article')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
                $table->foreign('categorie')->references('nom_categorie')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('articles');
        }
    };
?>
