<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Client;
    use App\Models\ReglementVente;

    class ListeClientsReglements extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.liste-clients-reglements', [
    		    'clients' => Client::where('clients.matricule_client', 'like', '%'.$this->search.'%')
                ->join("reglements_ventes", 'reglements_ventes.matricule_client', '=', 'clients.matricule_client')
                ->orWhere('clients.nom_client', 'like', '%'.$this->search.'%')
                ->orWhere('clients.prenom_client', 'like', '%'.$this->search.'%')
                ->orWhere('clients.email_client', 'like', '%'.$this->search.'%')
                ->orderBy('clients.matricule_client', 'asc')
                ->paginate(10, array('clients.*', 'reglements_ventes.*'))
    	    ]);
        }

        public function setPage($url){
            $this->currentPage = explode('page=',$url)[1];
            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }
    }
?>
