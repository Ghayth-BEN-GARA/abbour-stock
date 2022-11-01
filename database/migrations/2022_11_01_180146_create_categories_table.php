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
            Schema::create('categories', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->string('nom_categorie', 700)->primary()->default('Aucun');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('categories');
        }
    };
?>
