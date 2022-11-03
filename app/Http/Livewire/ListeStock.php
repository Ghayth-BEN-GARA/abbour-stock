<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Stock;
    use App\Models\Article;

    class ListeStock extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.liste-stock', [
    		    'stocks' => Stock::join('articles', 'articles.reference_article', '=', 'stocks.reference_article')
                ->where('articles.designation', 'like', '%'.$this->search.'%')
                ->orWhere('stocks.reference_article', 'like', '%'.$this->search.'%')
                ->orWhere('articles.description', 'like', '%'.$this->search.'%')
                ->orderBy('articles.reference_article','asc')
                ->paginate(10, array('stocks.*', 'articles.*'))
    	    ]);
        }

        public function setPage($url){
            $this->currentPage = explode('page=',$url)[1];
            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }

        public function calculerPrixVente($prix_achat, $marge_prix){
            return str_replace( ',', '',number_format((($prix_achat * $marge_prix) / 100) + $prix_achat,3));
        }
    }
?>
