<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use App\Models\User;
    use App\Models\DemandeModificationType;

    class DemandeModificationTypeNotification extends Component{
        public function render(){
            $nbr_demandes = $this->getNbrDemande();
            $liste_demandes = $this->getListeDemandeModificationType();

            return view('livewire.demande-modification-type-notification', compact('nbr_demandes', 'liste_demandes'));
        }

        public function getNbrDemande(){
            return DemandeModificationType::where('etat_demande', '=', '0')->count();
        }

        public function getListeDemandeModificationType(){
            return (DemandeModificationType::join('users', 'users.id_user', '=', 'demandes_modification_type.id_user')
                ->where('demandes_modification_type.etat_demande', '=', '0')
                ->orderBy('demandes_modification_type.date_time_demande','desc')
                ->get());
        }
    }
?>
