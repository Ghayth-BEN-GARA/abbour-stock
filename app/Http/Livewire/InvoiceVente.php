<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use App\Models\FactureVente;
    use App\Models\Client;
    use App\Models\FactureArticleVente;
    use App\Models\Article;
    use App\Models\ReglementVente;
    use App\Models\Stock;

    class InvoiceVente extends Component{
        public function render(){
            return view('livewire.invoice-vente');
        }

        public function getInformationsFacture($reference_facture){
            return FactureVente::where('reference_facture', '=', $reference_facture)
            ->join("clients", 'clients.matricule_client', '=', 'factures_ventes.matricule_client')
            ->first();
        }

        public function getListeArticleFacture($reference_facture){
            return FactureArticleVente::where('factures_articles_ventes.reference_facture', "=", $reference_facture)
            ->join("articles", "articles.reference_article", "=", "factures_articles_ventes.reference_article")
            ->join("stocks", "stocks.reference_article", "=", "factures_articles_ventes.reference_article")
            ->orderBy('articles.designation', 'asc')
            ->get();
        }

        public function getDetailsReglement($reference_facture){
            return ReglementVente::where('reference_facture_vente', '=', $reference_facture)->first();
        }

        public function calculerPrixVente($prix_achat, $marge_prix){
            return str_replace( ',', '', number_format((($prix_achat * $marge_prix) / 100) + $prix_achat, 3));
        }

        public function calculerPrixVenteAvecRemiseFactureVente($prix, $quantite, $remise){
            $prix_total = number_format($prix * $quantite, 3);
            return str_replace( ',', '', number_format($prix_total - (($prix_total * $remise) / 100), 3));
        }

        public function calculerPrixVenteSansRemiseFactureVente($prix, $quantite){
            $prix_total = number_format($prix * $quantite, 3);
            return str_replace( ',', '', number_format($prix_total, 3));
        }

        public function calculerTotaleAvecRemise($totale, $remise){
            return str_replace( ',', '', number_format($totale - (($totale * $remise) / 100), 3));
        }
    }
?>
