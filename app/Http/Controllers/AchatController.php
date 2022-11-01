<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Categorie;
    use App\Models\Article;

    class AchatController extends Controller{
        public function ouvrirAutres(){
            $categories = $this->listeCategorieSansAucun();
            return view('Achats.autres', compact('categories'));
        }

        public function gestionAddCategorie(Request $request){
            if($this->checkCategorie($request->categorie)){
                return back()->with('erreur2', "Une autre catégorie contenant ce nom a été trouvée.");
            }

            else if($this->creerCategorie($request->categorie)){
                return back()->with('success2', "La catégorie a été créée avec succès. Vous pouvez créer un nouvel article de cette catégorie maintenant.");
            }

            else{
                return redirect('/erreur');
            }
        }

        public function checkCategorie($categorie){
            return (Categorie::where('nom_categorie', '=', $categorie)->exists());
        }

        public function creerCategorie($categorie){
            $cat = new Categorie();
            $cat->setNomCategorieAttribute($categorie);
            return $cat->save();
        }

        public static function getLastReferenceArticle(){
            if(Article::count() == 0){
                return 0;
            }

            else{
                return Article::orderBy('reference_article','desc')->first()->getReferenceArticleAttribute();
            }
        }

        public function listeCategorieSansAucun(){
            return Categorie::where('nom_categorie', '<>', 'Aucun')->get();
        }

        public function checkArticle($reference){
            return (Article::where('reference_article', '=', $reference)->exists());
        }

        public function gestionAddArticle(Request $request){
            if($this->checkArticle($request->reference)){
                return back()->with('erreur', "Un autre article identifié par cette référence est déjà créé.");
            }

            else if($this->creerArticle($request->reference, $request->designation, $request->description, $request->cat)){
                return back()->with('success', "Le nouveau article a été créée avec succès.");
            }

            else{
                return redirect('/erreur');
            }
        }

        public function creerArticle($reference, $designation, $description, $categorie){
            $article = new Article();
            $article->setReferenceArticleAttribute($reference);
            $article->setDesignationArticleAttribute($designation);

            if($description != null){
                $article->setDescriptionArticleAttribute($description);
            }

            $article->setCategorieArticleAttribute($categorie);
            return $article->save();
        }
    }
?>
