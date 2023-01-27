<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Client;
    use App\Models\Article;

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
                ->where("stocks.quantite_stock", ">", 0)
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
    }
?>
