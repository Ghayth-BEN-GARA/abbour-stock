<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Article;
    use App\Models\EmplacementArticle;

    class ListeEmplacementsArticles extends Component{
        public $search;
        public $emplacement_artice = "Tout";
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            if($this->emplacement_artice == "Tout"){
                return view('livewire.liste-emplacements-articles', [
                    'articles' => Article::join('emplacements_articles', 'articles.reference_article', 'emplacements_articles.reference_article')
                    ->where('articles.reference_article', 'like', '%'.$this->search.'%')
                    ->orWhere('articles.designation', 'like', '%'.$this->search.'%')
                    ->orderBy('articles.reference_article', 'asc')
                    ->paginate(10, array('articles.*', 'emplacements_articles.*'))
                ]);
            }

            else{
                return view('livewire.liste-emplacements-articles', [
                    'articles' => Article::where([
                        ['articles.reference_article', 'like', '%'.$this->search.'%'],
                        ['emplacements_articles.emplacement_article_creer', '=', $this->emplacement_artice],
                    ])
                    ->orWhere([
                        ['articles.designation', 'like', '%'.$this->search.'%'],
                        ['emplacements_articles.emplacement_article_creer', '=', $this->emplacement_artice],
                    ])
                    ->join('emplacements_articles', 'articles.reference_article', 'emplacements_articles.reference_article')
                    ->orderBy('articles.reference_article', 'asc')
                    ->paginate(10, array('articles.*', 'emplacements_articles.*'))
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
