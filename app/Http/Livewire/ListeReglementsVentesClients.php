<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use App\Models\Client;
    use App\Models\ReglementVente;

    class ListeReglementsVentesClients extends Component{
        public $matricule_client;

        public function render(){
            return view('livewire.liste-reglements-ventes-clients', [
    		    'reglements' => ReglementVente::join("clients", "clients.matricule_client", "=", "reglements_ventes.matricule_client")
                ->where('reglements_ventes.matricule_client', '=', $this->matricule_client)
                ->orderBy('reglements_ventes.date_reglement_vente', 'desc')
                ->paginate(10, array('clients.*', 'reglements_ventes.*'))
    	    ]);
        }
    }
?>
