<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Article;
    use App\Models\EmplacementArticle;

    class ListeEmplacementsArticles extends Component{
        public $search;
        public $type_cherche = "Tout";
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            if($this->type_cherche == "Tout"){
                return view('livewire.liste-emplacements-articles', [
                    'articles' => Article::join('emplacements_articles', 'articles.reference_article', 'emplacements_articles.reference_article')
                    ->where('articles.reference_article', 'like', '%'.$this->search.'%')
                    ->orWhere('articles.designation', 'like', '%'.$this->search.'%')
                    ->orWhere('emplacements_articles.emplacement_article_creer', 'like', '%'.$this->search.'%')
                    ->orWhere('emplacements_articles.stock_article_creer', 'like', '%'.$this->search.'%')
                    ->orderBy('articles.reference_article', 'asc')
                    ->paginate(10, array('articles.*', 'emplacements_articles.*'))
                ]);
            }

            else if($this->type_cherche == "Désignation"){
                return view('livewire.liste-emplacements-articles', [
                    'articles' => Article::join('emplacements_articles', 'articles.reference_article', 'emplacements_articles.reference_article')
                    ->where('articles.designation', 'like', '%'.$this->search.'%')
                    ->orderBy('articles.reference_article', 'asc')
                    ->paginate(10, array('articles.*', 'emplacements_articles.*'))
                ]);
            }

            else if($this->type_cherche == "Emplacement"){
                return view('livewire.liste-emplacements-articles', [
                    'articles' => Article::join('emplacements_articles', 'articles.reference_article', 'emplacements_articles.reference_article')
                    ->where('emplacements_articles.emplacement_article_creer', 'like', '%'.$this->search.'%')
                    ->orderBy('articles.reference_article', 'asc')
                    ->paginate(10, array('articles.*', 'emplacements_articles.*'))
                ]);
            }

            else if($this->type_cherche == "Référence"){
                return view('livewire.liste-emplacements-articles', [
                    'articles' => Article::join('emplacements_articles', 'articles.reference_article', 'emplacements_articles.reference_article')
                    ->where('articles.reference_article', 'like', '%'.$this->search.'%')
                    ->orderBy('articles.reference_article', 'asc')
                    ->paginate(10, array('articles.*', 'emplacements_articles.*'))
                ]);
            }

            else if($this->type_cherche == "Stock"){
                return view('livewire.liste-emplacements-articles', [
                    'articles' => Article::join('emplacements_articles', 'articles.reference_article', 'emplacements_articles.reference_article')
                    ->where('emplacements_articles.stock_article_creer', 'like', '%'.$this->search.'%')
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
