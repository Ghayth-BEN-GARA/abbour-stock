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
            Schema::create('demandes_modification_type', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id('id_demande');
                $table->string('type_demande', 150)->default('User');
                $table->integer('etat_demande')->default(0);
                $table->datetime('date_time_demande')->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
                $table->bigInteger('id_user')->unsigned()->nullable();
                $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('demandes_modification_type');
        }
    };
?>
