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
            Schema::create('users', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id('id_user');
                $table->string('email', 999);
                $table->string('password', 999);
                $table->integer('cin', false, false)->default(0);
                $table->string('nom',500)->defaul('Aucun');
                $table->string('prenom',500)->defaul('Aucun');
                $table->string('genre',150)->defaul('Non spécifié');
                $table->date('naissance')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
                $table->integer('mobile', false, false)->default(0);
                $table->string('adresse',500)->defaul('Aucun');
                $table->string('image',800)->defaul('Aucun');
                $table->string('type',150)->defaul('Utilisateur');
                $table->date('date_creation')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('users');
        }
    };
?>
