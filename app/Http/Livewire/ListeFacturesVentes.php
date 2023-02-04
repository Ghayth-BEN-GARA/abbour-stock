<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Client;
    use App\Models\FactureVente;

    class ListeFacturesVentes extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.liste-factures-ventes', [
                'factures' => FactureVente::join('clients', 'clients.matricule_client', '=', 'factures_ventes.matricule_client')
                ->where('factures_ventes.reference_facture', 'like', '%'.$this->search.'%')
                ->orWhere('clients.matricule_client', 'like', '%'.$this->search.'%')
                ->orWhere('clients.nom_client', 'like', '%'.$this->search.'%')
                ->orWhere('clients.prenom_client', 'like', '%'.$this->search.'%')
                ->orderBy('factures_ventes.date_facture', 'asc')
                ->paginate(10, array('factures_ventes.*', 'clients.*'))
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
