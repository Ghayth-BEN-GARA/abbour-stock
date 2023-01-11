<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Article;
    use App\Models\Stock;
    use App\Models\EmplacementArticle;

    class EmplacementController extends Controller{
        public function ouvrirAddEmplacementArticle(Request $request){
            $details_article = $this->getDetailsArticle($request->input('reference_article'));

            return view("Emplacements.add_emplacement_article", compact("details_article"));
        }

        public function getDetailsArticle($reference_article){
            return Article::where('reference_article', '=', $reference_article)->first();
        }

        public function gestionCreerEmplacementArticle(Request $request){
            if($this->checkEmplacementArticle($request->reference_article)){
                return back()->with('erreur', "Vous avez déjà défini l'emplacement de cet article.");
            }

            else if($this->creerEmplacementArticle($request->reference_article, $request->emplacement, $request->stock)){
                return back()->with('success', "Vous avez bien choisi l'emplacement de ce nouvel article. Notez que vous pouvez le modifier à tout moment.");
            }

            else{
                return redirect('/erreur');
            }
        }

        public function creerEmplacementArticle($reference_article, $emplacement, $stock){
            $emplacement_article = new EmplacementArticle();
            $emplacement_article->setEmplacementArticleCreerAttribute($emplacement);
            $emplacement_article->setStockArticleCreerAttribute($stock);
            $emplacement_article->setReferenceArticleAttribute($reference_article);

            return $emplacement_article->save();
        }

        public function ouvrirAddEmplacementArticleParReference(){
            $liste_article = $this->getListeArticle();

            return view("Emplacements.add_emplacement_article_par_reference", compact("liste_article"));
        }

        public function getListeArticle(){
            return Article::orderBy('designation', 'asc')->get();
        }

        public function gestionCreerEmplacementArticleParReference(Request $request){
            if($this->checkEmplacementArticle($request->article)){
                return back()->with('erreur', "Vous avez déjà défini l'emplacement de cet article.");
            }

            else if($this->creerEmplacementArticle($request->article, $request->emplacement, $request->stock)){
                return back()->with('success', "Vous avez bien choisi l'emplacement de ce nouvel article. Notez que vous pouvez le modifier à tout moment.");
            }

            else{
                return redirect('/erreur');
            }
        }

        public function checkEmplacementArticle($reference_article){
            return (EmplacementArticle::where('reference_article', '=', $reference_article)->exists());
        }
    }
?>
