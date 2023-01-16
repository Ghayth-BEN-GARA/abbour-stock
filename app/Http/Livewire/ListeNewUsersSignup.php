<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Carbon\Carbon;
    use App\Models\TempUser;

    class ListeNewUsersSignup extends Component{
        public function render(){
            $nbr_users = $this->getNbrNewUser();
            $liste_users = $this->getListeNewUsers();

            return view('livewire.liste-new-users-signup', compact('nbr_users', 'liste_users'));
        }

        public function getNbrNewUser(){
            return TempUser::count();
        }

        public function getListeNewUsers(){
            return TempUser::get();
        }

        public function getDifferenceDate($date){
            $currentDate = strtotime(Carbon::now('+01:00')->format('Y-m-d H:i:s'));
            $dateNotification = strtotime($date);
            $differenceDates = $currentDate - $dateNotification;

            if($differenceDates < 60){
                return ('Il y a quelques secondes.');
            }

            else if($differenceDates >= 60 && $differenceDates < 3600){
                return ("Il y a ".round($differenceDates / 60)." minutes.");
            }

            else if($differenceDates >= 3600 && $differenceDates < 86400){
                return ("Il y a ".round($differenceDates / 3600)." heures.");
            }

            else if($differenceDates >= 86400 && $differenceDates < 86400 * 30){
                return ("Il y a ".round($differenceDates / 86400)." jours.");
            }

            else if($differenceDates >= 86400 * 30 && $differenceDates < 86400 * 365){
                return ("Il y a ".round($differenceDates / 86400 * 30)." mois.");
            }

            else{
                return ("Il y a ".round($differenceDates / (86400 * 365))." ans.");
            }
        }

    }
?>
