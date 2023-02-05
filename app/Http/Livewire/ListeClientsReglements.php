<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Client;

    class ListeClientsReglements extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.liste-clients-reglements', [
    		    'clients' => Client::where('matricule_client', 'like', '%'.$this->search.'%')
                ->orWhere('nom_client', 'like', '%'.$this->search.'%')
                ->orWhere('prenom_client', 'like', '%'.$this->search.'%')
                ->orWhere('email_client', 'like', '%'.$this->search.'%')
                ->orderBy('matricule_client', 'asc')
                ->paginate(10, array('clients.*'))
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
