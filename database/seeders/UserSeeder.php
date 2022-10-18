<?php
    namespace Database\Seeders;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\User;

    class UserSeeder extends Seeder{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(){
            $user = new User();
            $user->setEmailUserAttribute('administrateur@administrateur.com');
            $user->setPasswordUserAttribute(bcrypt('admin'));
            $user->setCinUserAttribute('12345678');
            $user->setNomUserAttribute('Abbour');
            $user->setPrenomUserAttribute('Mhamad');
            $user->setGenreUserAttribute('Homme');
            $user->setNaissanceUserAttribute('1997-11-03');
            $user->setMobileUserAttribute('24513092');
            $user->setAdresseUserAttribute('Ghar El Melh');
            $user->setTypeUserAttribute('Administrateur');
            $user->save();
        }
    }
?>
