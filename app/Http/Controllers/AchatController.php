<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Categorie;
    use App\Models\Article;
    use App\Models\Fournisseur;
    use App\Models\FactureAchat;
    use App\Models\ReglementAchat;
    use App\Models\FactureArticleAchat;
    use App\Models\ValidationPrixArticleFactureAchat;
    use App\Models\Stock;
    use App\Models\HistoriquePrixArticle;

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
                return back()->with('success', $request->reference);
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

            else if($this->creerFactureAchat($request->reference_facture, $request->matricule, $request->date, $request->heure, $request->type, $request->paiement, $request->responsable, $request->nom_fournisseur, auth()->user()->getIdUserAttribute())){
                if($this->creerReglementAchat($request->montant, $request->date, "Facture", $request->reference_facture, $request->matricule, $request->nom_fournisseur)){
                    return redirect('/add-articles-facture-achat?reference_facture='.$request->reference_facture."/".$request->nom_fournisseur);
                }

                else{
                    return redirect('/erreur');
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function creerFactureAchat($reference_facture, $matricule, $date, $heure, $type, $paiement, $responsable, $nom_fournisseur, $id_user){
            $facture_achat = new FactureAchat();
            $facture_achat->setReferenceFactureAttribute($reference_facture."/".$nom_fournisseur);
            $facture_achat->setMatriculeFournisseurAttribute($matricule);
            $facture_achat->setDateFactureAttribute($date);
            $facture_achat->setHeureFactureAttribute($heure);
            $facture_achat->setTypeFactureAttribute($type);
            $facture_achat->setPaiementFactureAttribute($paiement);
            $facture_achat->setResponsableFactureAttribute($responsable);
            $facture_achat->setIdUserAttribute($id_user);

            return $facture_achat->save();
        }

        public function creerReglementAchat($paye, $date, $type, $reference_facture, $matricule, $nom_fournisseur){
            $reglementAchat = new ReglementAchat();

            if($paye == null || $paye == ""){
                $reglementAchat->setPayeReglementAchatAttribute(0.000);
            }

            else{
                $reglementAchat->setPayeReglementAchatAttribute($paye);
            }

            $reglementAchat->setDateReglementAchatAttribute($date);
            $reglementAchat->setTypeReglementAchatAttribute($type);
            $reglementAchat->setReferenceFactureAchatAttribute($reference_facture."/".$nom_fournisseur);
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
                'designation' => $article->getDesignationArticleAttribute()."",
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

        public function storeArticlesToFactureAchat(Request $request){
            $designation_article = $request->designation_achat;
            $reference_article = $request->reference_achat;
            $categorie_article = $request->categorie_achat;
            $quantite_article = $request->quantite_achat;
            $prix_article = $request->prix_achat;
            $reference_facture = $request->reference_facture;
            $somme_facture_achat = 0;

            foreach($reference_article as $key => $insert){
                if(!$this->checkArticleExist($reference_article[$key])){
                    $enregistrementArticle = [
                        'reference_article' => $reference_article[$key],
                        'designation' => $designation_article[$key],
                        'categorie' => $categorie_article[$key]
                    ];

                    Article::insert([$enregistrementArticle]);
                }

                $enregistrementListeArticles = [
                    'quantite_article' => $quantite_article[$key],
                    'prix_unitaire_article' => $prix_article[$key],
                    'reference_article' => $reference_article[$key],
                    'reference_facture' => $request->reference_facture                   
                ];

                FactureArticleAchat::insert([$enregistrementListeArticles]); 
                $somme_facture_achat = $somme_facture_achat + ($prix_article[$key] * $quantite_article[$key]);
            
                if(!$this->checkArticleCreerDansStock($reference_article[$key])){
                    $this->creerStock($quantite_article[$key], $prix_article[$key], $reference_article[$key]);
                }

                else{
                    if($prix_article[$key] == $this->getPrixAchatArticle($reference_article[$key])){
                        $this->updateQuantiteStock($reference_article[$key],$quantite_article[$key]);
                    }

                    else{
                        if($this->checkValidationNewPrixArticleAchatExiste($reference_article[$key])){
                            $this->updateValidationNewPrixArticleAchatExiste($reference_article[$key],$prix_article[$key]);
                            $this->updateQuantiteStock($reference_article[$key],$quantite_article[$key]);
                        }

                        else{
                            $this->creerValidationNewPrixArticleAchatExiste($reference_article[$key], $prix_article[$key], $reference_facture);
                            $this->updateQuantiteStock($reference_article[$key],$quantite_article[$key]);
                        }
                    }
                }
            }

            if($this->getPaiementFactureAchat($reference_facture) == "Totale"){
                $this->updatePaiementFactureAchat($reference_facture, $somme_facture_achat);
            }

            $this->updateNetFactureAchat($reference_facture, $somme_facture_achat);
            return redirect('/add-facture-achat')->with('success', "Bravo ! La nouvelle facture d'achat a été enregistrée avec succès.");
        }

        public function checkArticleExist($reference_article){
            return (Article::where('reference_article', '=', $reference_article)->exists());
        }

        public function getPaiementFactureAchat($reference_facture){
            return FactureAchat::where('reference_facture', '=', $reference_facture)->first()->getPaiementFactureAttribute();
        }

        public function updatePaiementFactureAchat($reference_facture, $montant_paye){
            return ReglementAchat::where('reference_facture_achat', '=', $reference_facture)->update([
                'paye_reglement_achat' => $montant_paye
            ]);
        }

        public function updateNetFactureAchat($reference_facture, $montant_paye){
            return ReglementAchat::where('reference_facture_achat', '=', $reference_facture)->update([
                'net_reglement_achat' => $montant_paye
            ]);
        }

        public function checkArticleCreerDansStock($reference_article){
            return Stock::where('reference_article', '=', $reference_article)->exists();
        }

        public function creerStock($quantite_article, $prix_article, $reference_article){
            $stock_table = new Stock();
            $stock_table->setQuantiteStockAttribute($quantite_article);
            $stock_table->setPrixAchatArticleAttribute($prix_article);
            $stock_table->setReferenceArticleAttribute($reference_article);
            return $stock_table->save();
        }

        public function getPrixAchatArticle($reference_article){
            return Stock::where('reference_article','=',$reference_article)->first()->getPrixAchatArticleAttribute();
        }

        public function updateQuantiteStock($reference_article, $quantite_article){
            return Stock::where('reference_article', '=', $reference_article)->increment('quantite_stock', $quantite_article);
        }

        public function checkValidationNewPrixArticleAchatExiste($reference_article){
            return ValidationPrixArticleFactureAchat::where('reference_article', '=', $reference_article)->exists();
        }

        public function updateValidationNewPrixArticleAchatExiste($reference_article, $prix_article){
            return ValidationPrixArticleFactureAchat::where('reference_article',$reference_article)->update([
                'new_prix_unitaire_article' => $prix_article
            ]);
        }

        public function creerValidationNewPrixArticleAchatExiste($reference_article, $prix_article, $reference_facture){
            $validation = new ValidationPrixArticleFactureAchat();
            $validation->setNewPrixArticleAttribute($prix_article);
            $validation->setReferenceArticleAttribute($reference_article);
            $validation->setReferenceFactureAchatAttribute($reference_facture);
            return $validation->save();
        }

        public function gestionValidationNewPrixAchat(Request $request){
            $detailsValidation = $this->getDetailsNewValidation($request->id_validation_prix_article);

            if($this->creerHistoriquePrixAchat($detailsValidation->getNewPrixArticleAttribute(), $detailsValidation->getDateValidationNewPrixArticleAttribute(), $detailsValidation->getReferenceArticleAttribute(), $detailsValidation->getReferenceFactureAchatAttribute())){
                $this->deleteValidationArticlePrixAchat($request->id_validation_prix_article);

                if($this->updatePrixAchat($request->reference_article, $request->new_prix_article)){
                    return redirect('/article?reference_article='.$request->reference_article)->with('success', ''); 
                }

                else{
                    return redirect('/article?reference_article='.$request->reference_article)->with('erreur', ''); 
                }
            }

            else{
                return redirect('/article?reference_article='.$request->reference_article)->with('erreur'); 
            }
        }

        public function getDetailsNewValidation($id_validation){
            return ValidationPrixArticleFactureAchat::where('id_validation_prix_article', '=', $id_validation)->first();
        }

        public function creerHistoriquePrixAchat($prix, $date_creation, $reference_article, $reference_facture){
            $historique_prix = new HistoriquePrixArticle();
            $historique_prix->setPrixUnitaireArticleAttribute($prix);
            $historique_prix->setDateCreationPrixAttribute($date_creation);
            $historique_prix->setReferenceArticleAttribute($reference_article);
            $historique_prix->setReferenceFactureAttribute($reference_facture);

            return $historique_prix->save();
        }

        public function deleteValidationArticlePrixAchat($id_validation){
            return ValidationPrixArticleFactureAchat::where('id_validation_prix_article', '=', $id_validation)->delete();
        }

        public function updatePrixAchat($reference_article, $new_prix){
            return Stock::where('reference_article', '=', $reference_article)->update([
                'prix_achat_article' => $new_prix
            ]);
        }

        public function ouvrirListeEmplacementAchat(){
            $liste_validations_prix_achats = $this->getListeValidationNewPrixAchat();
            return view("Achats.liste_validations_prix_achat", compact("liste_validations_prix_achats"));
        }

        public function getListeValidationNewPrixAchat(){
            return ValidationPrixArticleFactureAchat::join("articles", "articles.reference_article", "=", "validation_prix_articles_factures.reference_article")
            ->get();
        }

        public function ouvrirValidationPrixArticle(Request $request){
            $details_validation = $this->getValidationPrixAchatArticleNewPrixAchat($request->input("id_validation"));
            return view("Achats.validation_prix_article", compact("details_validation"));
        }

        public function getValidationPrixAchatArticleNewPrixAchat($id_validation){
            return ValidationPrixArticleFactureAchat::join("articles", "articles.reference_article", "=", "validation_prix_articles_factures.reference_article")
            ->where("validation_prix_articles_factures.id_validation_prix_article", "=", $id_validation)
            ->first();
        }

        public static function getAncienPrixAchat($reference_article){
            return Stock::where("reference_article", "=", $reference_article)
            ->first()->getPrixAchatArticleAttribute();
        }

        public function gestionAnnulerValidationNewPrixArticle(Request $request){
            if($this->deleteValidationArticlePrixAchat($request->input('id_validation'))){
                return redirect('/article?reference_article='.$request->input('reference_article'))->with('primary', ''); 
            }

            else{
                return redirect('/article?reference_article='.$request->input('reference_article'))->with('erreur'); 
            }
        }

        public function ouvrirListeFacturesAchats(){
            return view("Achats.liste_factures_achats");
        }

        public function ouvrirFactureAchat(Request $request){
            $reference_facture = $request->input("reference_facture");
            return view("Achats.achat", compact("reference_facture"));
        }

        public function gestionDeleteFacture(Request $request){
            $this->gestionDeleteStock($this->listeArticlesFactureAchat($request->input('reference_facture')));
            $this->deleteReglementFactureAchat($request->input('reference_facture'));
            $this->deleteFactureAchat($request->input('reference_facture'));
            return back()->with('success', "La facture d'achat a été supprimer avec succés. Notez bien que vous pouvez créer une autre achat à tout moment.");
        }

        public function removeQuantiteFromStock($reference_article, $quantite_article){
            return Stock::where('reference_article', '=', $reference_article)->increment('quantite_stock', -$quantite_article);
        }

        public function listeArticlesFactureAchat($reference_facture){
            return FactureArticleAchat::where('reference_facture', '=', $reference_facture)->get();
        }

        public function gestionDeleteStock($articles){
            foreach ($articles as $data) {
                $this->removeQuantiteFromStock($data->getReferenceArticleAttribute(), $data->getQuantiteArticleAttribute());
            }
        }

        public function deleteFactureAchat($reference_facture){
            return FactureAchat::where('reference_facture', $reference_facture)->delete();
        }

        public function deleteReglementFactureAchat($reference_facture){
            return ReglementAchat::where('reference_facture_achat', '=', $reference_facture)->delete();
        }
    }
?>
