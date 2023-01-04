<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Categorie;
    use App\Models\Article;
    use App\Models\Fournisseur;
    use App\Models\FactureAchat;
    use App\Models\ReglementAchat;

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
            return Categorie::where('nom_categorie', '=', $categorie)->exists();
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

        public function ouvrirAddFactureAchat(){
            $last_reference = $this->getLastReferenceArticle();
            $fournisseurs = $this->getListeFournisseur();

            return view('Achats.add_facture_achat1', compact('last_reference', 'fournisseurs'));
        }

        public function getListeFournisseur(){
            return Fournisseur::all();
        }

        public function checkFactureAchat($reference_facture){
            return FactureAchat::where('reference_facture', '=', $reference_facture)->exists();
        }

        public function gestionCreerFactureAchat(Request $request){
            if($this->checkFactureAchat($request->reference_facture)){
                return back()->with('erreur', "Une autre facture d'achat identifié par cette référence est déjà créé.");
            }

            else if($this->creerFactureAchat($request->reference_facture, $request->matricule, $request->date, $request->heure, $request->type, $request->responsable, auth()->user()->getIdUserAttribute())){
                if($this->creerReglementAchat($request->montant, $request->date, "Facture", $request->reference_facture, $request->matricule)){
                    return redirect('/add-articles-facture-achat?reference_facture='.$request->reference_facture);
                }

                else{
                    return redirect('/erreur');
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function creerFactureAchat($reference_facture, $matricule, $date, $heure, $type, $responsable, $id_user){
            $facture_achat = new FactureAchat();
            $facture_achat->setReferenceFactureAttribute($reference_facture);
            $facture_achat->setMatriculeFournisseurAttribute($matricule);
            $facture_achat->setDateFactureAttribute($date);
            $facture_achat->setHeureFactureAttribute($heure);
            $facture_achat->setTypeFactureAttribute($type);
            $facture_achat->setResponsableFactureAttribute($responsable);
            $facture_achat->setIdUserAttribute($id_user);

            return $facture_achat->save();
        }

        public function creerReglementAchat($paye, $date, $type, $reference_facture, $matricule){
            $reglementAchat = new ReglementAchat();

            if($paye == null || $paye == ""){
                $reglementAchat->setPayeReglementAchatAttribute(0.000);
            }

            else{
                $reglementAchat->setPayeReglementAchatAttribute($paye);
            }

            $reglementAchat->setDateReglementAchatAttribute($date);
            $reglementAchat->setTypeReglementAchatAttribute($type);
            $reglementAchat->setReferenceFactureAchatAttribute($reference_facture);
            $reglementAchat->setMatriculeFournisseurAttribute($matricule);

            return $reglementAchat->save();
        }

        public function ouvrirAddArticleFactureAchat(Request $request){
            $fournisseurs = $this->getInformationsFournisseurFactureAchat($request->input('reference_facture'));
            $reference_facture = $request->input('reference_facture');
            $categories = $this->listeCategorieAvecAucun();
            $last_reference_article = $this->getLastReferenceArticle();

            return view('Achats.add_facture_achat2', compact('fournisseurs', 'reference_facture', 'categories', 'last_reference_article'));
        }

        public function getInformationsFournisseurFactureAchat($reference_facture){
            return FactureAchat::join('fournisseurs', 'factures_achats.matricule_fournisseur', '=', 'fournisseurs.matricule_fournisseur')
            ->where('factures_achats.reference_facture', '=', $reference_facture)
            ->first();
        }

        public function listeCategorieAvecAucun(){
            return Categorie::all();
        }

        public function getArticleSearchByDesignation(Request $request){
            if($request->get('query') != ''){
                $article = Article::where('designation', 'LIKE', '%'.$request->get('query').'%')->get();
            }
            
            $data = array();
            foreach ($article as $art){
                $data[] = $art->getDesignationArticleAttribute(); 
            }
            echo json_encode($data);
        }

        public function getInformationsArticleByDesignation(Request $request){
            $article = Article::join('stocks','stocks.reference_article','=','articles.reference_article')
            ->where('articles.designation', 'LIKE', $request->designation)->first();

            $data = array(
                'designation' => $article->getDesignationArticleAttribute(),
                'reference' => $article->getReferenceArticleAttribute(),
                'categorie' => $article->getCategorieArticleAttribute(),
                'prix' => $article->prix_achat_article
            );

            echo json_encode($data);
        }

        public function getArticleSearchByReference(Request $request){
            if($request->get('query') != ''){
                $article = Article::where('reference_article', 'LIKE', '%'.$request->get('query').'%')->get();
            }
            
            $data = array();
            foreach ($article as $art){
                $data[] = $art->getReferenceArticleAttribute().""; 
            }
            echo json_encode($data);
        }

        public function getInformationsArticleByReference(Request $request){
            $article = Article::join('stocks','stocks.reference_article','=','articles.reference_article')
            ->where('articles.reference_article', 'LIKE', $request->reference)->first();

            $data = array(
                'reference' => $article->getReferenceArticleAttribute(),
                'designation' => $article->getDesignationArticleAttribute(),
                'categorie' => $article->getCategorieArticleAttribute(),
                'prix' => $article->prix_achat_article
            );

            echo json_encode($data);
        }
    }
?>
