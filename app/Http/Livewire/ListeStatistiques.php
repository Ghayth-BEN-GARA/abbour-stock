<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use App\Models\User;
    use App\Models\Fournisseur;
    use App\Models\Client;
    use App\Models\FactureAchat;
    use App\Models\Categorie;
    use App\Models\Article;
    use App\Models\HistoriquePrixArticle;
    use App\Models\FactureVente;

    class ListeStatistiques extends Component{
        public function render(){
            $nbr_users = $this->getNbrUsers();
            $nbr_fournisseurs = $this->getNbrFournisseurs();
            $nbr_clients = $this->getNbrClients();
            $nbr_achats = $this->getNbrFacturesAchats();
            $nbr_categories = $this->getNbrCategories();
            $nbr_articles = $this->getNbrArticles();
            $nbr_historiques_articles = $this->getNbrHistoriquesArticles();
            $nbr_ventes = $this->getNbrFacturesVentes();

            return view('livewire.liste-statistiques', compact("nbr_users", "nbr_fournisseurs", "nbr_clients", "nbr_achats", "nbr_categories", "nbr_articles", "nbr_historiques_articles", "nbr_ventes"));
        }

        public function getNbrUsers(){
            return User::count();
        }

        public function getNbrFournisseurs(){
            return Fournisseur::count();
        }

        public function getNbrClients(){
            return Client::count();
        }

        public function getNbrFacturesAchats(){
            return FactureAchat::count();
        }

        public function getNbrCategories(){
            return Categorie::count();
        }

        public function getNbrArticles(){
            return Article::count();
        }

        public function getNbrHistoriquesArticles(){
            return HistoriquePrixArticle::count();
        }

        public function getNbrFacturesVentes(){
            return FactureVente::count();
        }
    }
?>
