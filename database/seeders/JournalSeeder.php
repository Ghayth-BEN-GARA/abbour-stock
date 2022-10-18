<?php
    namespace Database\Seeders;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Journal;

    class JournalSeeder extends Seeder{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(){
            $journal = new Journal();
            $journal->setTacheJournalAttribute('Inscription');
            $journal->setDescriptionJournalAttribute("Création d'un nouveau compte sur l'application après saisie des informations demandées.");
            $journal->setIdUserAttribute('1');
            $journal->save();
        }
    }
?>
