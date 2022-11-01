<?php
    namespace Database\Seeders;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\EtatImportation;

    class EtatImportationSeeder extends Seeder{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(){
            $etat = new EtatImportation();
            $etat->setEtatImportationArticleAttribute(false);
            $etat->save();
        }
    }
?>
