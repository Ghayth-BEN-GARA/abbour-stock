<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use App\Models\Fournisseur;
    use App\Models\ReglementAchat;

    class ListeReglementsAchatsFournisseurs extends Component{
        public $matricule_fournisseur;

        public function render(){
            return view('livewire.liste-reglements-achats-fournisseurs', [
    		    'reglements' => ReglementAchat::join("fournisseurs", "fournisseurs.matricule_fournisseur", "=", "reglements_achats.matricule_fournisseur")
                ->where('reglements_achats.matricule_fournisseur', '=', $this->matricule_fournisseur)
                ->orderBy('reglements_achats.date_reglement_achat', 'desc')
                ->paginate(10, array('fournisseurs.*', 'reglements_achats.*'))
    	    ]);
        }
    }
?>
