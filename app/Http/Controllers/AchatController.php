<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Categorie;

    class AchatController extends Controller{
        public function ouvrirAutres(){
            return view('Achats.autres');
        }

        public function gestionAddCategorie(Request $request){
            if($this->checkCategorie($request->categorie)){
                return back()->with('erreur2', "Une autre catégorie contenant ce nom a été trouvée.");
            }

            else if($this->creerCategorie($request->categorie)){
                return back()->with('success2', "La catégorie a été créée avec succès. Vous pouvez créer un nouvel article de cette catégorie maintenant.");
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
    }
?>
