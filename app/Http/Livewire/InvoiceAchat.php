<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use App\Models\FactureAchat;
    use App\Models\Fournisseur;
    use App\Models\FactureArticleAchat;
    use App\Models\Article;

    class InvoiceAchat extends Component{
        public function render(){
            return view('livewire.invoice-achat');
        }

        public function getInformationsFacture($reference_facture){
            return FactureAchat::where('reference_facture', '=', $reference_facture)
            ->join("fournisseurs", 'fournisseurs.matricule_fournisseur', '=', 'factures_achats.matricule_fournisseur')
            ->first();
        }

        public function getListeArticleFacture($reference_facture){
            return FactureArticleAchat::where('factures_articles_achats.reference_facture', "=", $reference_facture)
            ->join("articles", "articles.reference_article", "=", "factures_articles_achats.reference_article")
            ->orderBy('articles.designation', 'asc')
            ->get();
        }
    }
?>
