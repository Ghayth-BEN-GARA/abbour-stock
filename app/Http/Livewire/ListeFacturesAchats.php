<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Fournisseur;
    use App\Models\FactureAchat;

    class ListeFacturesAchats extends Component{
        public $search;
        public $type_achats = "Tout";
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            if($this->type_achats == "Tout"){
                return view('livewire.liste-factures-achats', [
                    'factures' => FactureAchat::join('fournisseurs', 'fournisseurs.matricule_fournisseur', '=', 'factures_achats.matricule_fournisseur')
                    ->where('factures_achats.reference_facture', 'like', '%'.$this->search.'%')
                    ->orWhere('fournisseurs.fullname_fournisseur', 'like', '%'.$this->search.'%')
                    ->orWhere('fournisseurs.matricule_fournisseur', 'like', '%'.$this->search.'%')
                    ->orderBy('factures_achats.date_facture', 'desc')
                    ->paginate(10, array('factures_achats.*', 'fournisseurs.*'))
                ]);
            }

            else{
                return view('livewire.liste-factures-achats', [
                    'factures' => FactureAchat::where([
                        ['factures_achats.reference_facture', 'like', '%'.$this->search.'%'],
                        ['factures_achats.type_facture', '=', $this->type_achats],
                    ])
                    ->orWhere([
                        ['fournisseurs.fullname_fournisseur', 'like', '%'.$this->search.'%'],
                        ['factures_achats.type_facture', '=', $this->type_achats],
                    ])
                    ->orWhere([
                        ['fournisseurs.matricule_fournisseur', 'like', '%'.$this->search.'%'],
                        ['factures_achats.type_facture', '=', $this->type_achats],
                    ])
                    ->join('fournisseurs', 'fournisseurs.matricule_fournisseur', "=", 'factures_achats.matricule_fournisseur')
                    ->orderBy('factures_achats.date_facture', 'desc')
                    ->paginate(10, array('factures_achats.*', 'fournisseurs.*'))
                ]);
            }

        }

        public function setPage($url){
            $this->currentPage = explode('page=',$url)[1];
            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }
    }
?>
