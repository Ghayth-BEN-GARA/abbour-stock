<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Client;
    use App\Models\Article;
    use App\Models\FactureVente;
    use App\Models\Stock;
    use App\Models\FactureArticleVente;
    use App\Models\ReglementVente;

    class VenteController extends Controller{
        public function ouvrirCaisse(){
            $liste_clients = $this->getListeClientWithoutPassager();

            return view("Ventes.caisse", compact("liste_clients"));
        }

        public function getListeClientWithoutPassager(){
            return Client::where("matricule_client", "<>", 0)->orderBy("prenom_client", "asc")->get();
        }

        public function getArticleSearchByReference(Request $request){
            if($request->get('query') != ''){
                $article = Article::join("stocks", "articles.reference_article", "=", "stocks.reference_article")
                ->where('articles.reference_article', 'LIKE', '%'.$request->get('query').'%')
                ->get();
            }
            
            $data = array();

            foreach ($article as $art){
                $data[] = $art->getReferenceArticleAttribute().""; 
            }

            echo json_encode($data);
        }

        public function getInformationsArticleByReferenceFactureVente(Request $request){
            $article = Article::join('stocks','stocks.reference_article','=','articles.reference_article')
            ->where('articles.reference_article', 'LIKE', $request->reference)
            ->first();

            $data = array(
                'reference' => $article->getReferenceArticleAttribute(),
                'designation' => $article->getDesignationArticleAttribute(),
                'prix_vente' => $this->calculerPrixVente($article->prix_achat_article, $article->marge_prix)
            );

            echo json_encode($data);
        }

        public function calculerPrixVente($prix_achat, $marge_prix){
            return str_replace( ',', '', number_format((($prix_achat * $marge_prix) / 100) + $prix_achat,3));
        }

        public function calculerPrixVenteAvecRemise(Request $request){
            $prix_total = number_format($request->prix * $request->quantite, 3);
            return str_replace( ',', '', number_format($prix_total - (($prix_total * $request->remise) / 100), 3));
        }

        public function gestionCreerFactureVente(Request $request){
            $client = 0;
            $montant = 0.000;
            $remise = 0;

            $this->creerEnteteFactureVente($request->date, $request->heure, $request->livraison, auth()->user()->getIdUserAttribute(), $this->getMatriculeClientFacture($request->type_client, $request->nom_client));
            $somme_facture_vente = $this->storeArticleToFactureVente($request);

            if($request->type_client != "Passager"){
                $client = $request->nom_client;
            }

            if($request->montant_account_prix != "Montant"){
                $montant = $request->montant_account_prix;
            }

            if($request->montant_remise != "Remise"){
                $remise = $request->montant_remise;
            }

            if($this->creerReglementVente($somme_facture_vente, $montant, $remise, $this->getLastFactureVenteId(), $client)){
                return back();
            }
 
            else{
                redirect("/erreur");
            }
        }

        public function creerEnteteFactureVente($date, $heure, $livraison, $id_user, $client){
            $facture_vente = new FactureVente();
            $facture_vente->setDateFactureAttribute($date);
            $facture_vente->setHeureFactureAttribute($heure);
            $facture_vente->setLivraisonFactureAttribute($livraison);
            $facture_vente->setIdUserAttribute($id_user);
            $facture_vente->setMatriculeClientAttribute($client);

            return $facture_vente->save();
        }

        public function getMatriculeClientFacture($client, $matricule){
            if($client == "Passager"){
                return 0;
            }

            else{
                return $matricule;
            }
        }

        public function getQuantiteArticleDansStock(Request $request){
            return Stock::where("reference_article", "=", $request->reference_article)->first()->getQuantiteStockAttribute();
        }

        public function storeArticleToFactureVente($request){
            $designation_article = $request->designation_article;
            $reference_article = $request->reference_article;
            $quantite_article = $request->quantite_article;
            $prix_article = $request->prix_article;
            $remise_article = $request->remise_article;
            $reference_facture = $this->getLastFactureVenteId();
            $somme_facture_vente = 0;

            foreach($reference_article as $key => $insert){
                $enregistrementArticle = [
                    'reference_article' => $reference_article[$key],
                    'quantite_article' => $quantite_article[$key],
                    'remise_article' => $remise_article[$key],
                    'reference_facture' => $reference_facture
                ];

                FactureArticleVente::insert([$enregistrementArticle]);
                $somme_facture_vente = $somme_facture_vente + $this->calculerPrixVenteAvecRemiseFactureVente($prix_article[$key], $quantite_article[$key], $remise_article[$key]);
                $this->updateQuantiteStock($reference_article[$key], -$quantite_article[$key]);
            }

            return $somme_facture_vente;
        }

        public function getLastFactureVenteId(){
            return FactureVente::orderBy("reference_facture", "desc")->first()->getReferenceFactureAttribute();
        }

        public function calculerPrixVenteAvecRemiseFactureVente($prix, $quantite, $remise){
            $prix_total = number_format($prix * $quantite, 3);
            return str_replace( ',', '', number_format($prix_total - (($prix_total * $remise) / 100), 3));
        }

        public function creerReglementVente($somme, $account, $remise, $reference_facture, $client){
            $reglement = new ReglementVente();
            $reglement->setSommeReglementVenteAttribute($somme);
            $reglement->setAccountReglementVenteAttribute($account);
            $reglement->setRemiseReglementVenteAttribute($remise);
            $reglement->setReferenceFactureVenteAttribute($reference_facture);
            $reglement->setMatriculeClientAttribute($client);
            return $reglement->save();
        }

        public function updateQuantiteStock($reference_article, $quantite_article){
            return Stock::where('reference_article', '=', $reference_article)->increment('quantite_stock', $quantite_article);
        }
    }
?>
