<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Fournisseur;

    class ListeFournisseurs extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.liste-fournisseurs', [
    		    'fournisseurs' => Fournisseur::where('matricule_fournisseur', 'like', '%'.$this->search.'%')
                ->orWhere('fullname_fournisseur', 'like', '%'.$this->search.'%')
                ->orWhere('email_fournisseur', 'like', '%'.$this->search.'%')
                ->orWhere('adresse_fournisseur', 'like', '%'.$this->search.'%')
                ->orderBy('matricule_fournisseur', 'asc')
                ->paginate(10, array('fournisseurs.*'))
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
