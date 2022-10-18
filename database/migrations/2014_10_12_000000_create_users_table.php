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
                $table->string('nom',500)->default('Aucun');
                $table->string('prenom',500)->default('Aucun');
                $table->string('genre',150)->default('Non spécifié');
                $table->date('naissance')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
                $table->integer('mobile', false, false)->default(0);
                $table->string('adresse',500)->default('Aucun');
                $table->string('image',999)->default('images/user.png');
                $table->string('type',150)->default('Utilisateur');
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
