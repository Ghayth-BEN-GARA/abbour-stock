<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use App\Models\ValidationPrixArticleFactureAchat;
    use App\Models\Article;

    class ValidationPrixAchatFacture extends Component{
        public function render(){
            $nbr_validations = $this->getNbrValidation();
            $liste_validations = $this->getListeValidationPrix();

            return view('livewire.validation-prix-achat-facture', compact('nbr_validations', 'liste_validations'));
        }

        public function getNbrValidation(){
            return ValidationPrixArticleFactureAchat::count();
        }

        public function getListeValidationPrix(){
            return ValidationPrixArticleFactureAchat::join('articles', 'articles.reference_article', '=', 'validation_prix_articles_factures.reference_article')
                ->join('factures_achats', 'factures_achats.reference_facture', '=', 'validation_prix_articles_factures.reference_facture')
                ->orderBy('validation_prix_articles_factures.date_validation_new_prix_article','desc')
                ->get();
        }
    }
?>
