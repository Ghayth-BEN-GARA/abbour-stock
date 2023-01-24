<?php
    namespace Database\Seeders;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Client;

    class ClientSeeder extends Seeder{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(){
            $client = new Client();
            $client->setMatriculeClientAttribute(0);
            $client->setNomClientAttribute("Passager");
            $client->setPrenomClientAttribute("Passager");
            $client->setEmailClientAttribute("Aucun");
            $client->setAdresseClientAttribute("Aucun");
            $client->setMobileClientAttribute(0);

            return $client->save();
        }
    }
?>
