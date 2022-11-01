<?php
    namespace Database\Seeders;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Categorie;

    class CategorieSeeder extends Seeder{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(){
            $categorie = new Categorie();
            $categorie->setNomCategorieAttribute('Aucun');
            $categorie->save();
        }
    }
?>
