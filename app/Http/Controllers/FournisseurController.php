<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use App\Models\Journal;
    use App\Models\Fournisseur;

    class FournisseurController extends Controller{
        public function ouvrirAddFournisseur(){
            return view('Fournisseurs.add_fournisseur');
        }

        public function gestionCreerFournisseur(Request $request){
            if($this->checkMatriculeFournisseur($request->matricule)){
                return back()->with('erreur', "Un autre fournisseur créé avec cette matricule.");
            }

            else if($this->checkEmailFournisseur($request->email)){
                return back()->with('erreur', "Un autre fournisseur créé avec cette adresse email.");
            }

            else if($this->checkMobile1Fournisseur($request->mobile1)){
                return back()->with('erreur', "Un autre fournisseur créé avec ce numéro mobile.");
            }

            else if(Str::length($request->mobile1) != 8){
                return back()->with('erreur', "Vérifiez que le numéro mobile est composé de 8 chiffres.");
            }

            else if($this->creerFournisseur($request->fullname, $request->matricule, $request->email, $request->adresse, $request->mobile1, $request->mobile2)){
                if($this->creerJounral("Création d'un nouveau fournisseur", "Créer un nouveau compte pour le fournisseur ".$request->fullname." en ajoutant les informations requises.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Un nouveau fournisseur a été créé avec succès. Vous pouvez désormais le consulter à tout moment.");
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function creerJounral($tache, $description, $id_user){
            $journal = new Journal();
            $journal->setTacheJournalAttribute($tache);
            $journal->setDescriptionJournalAttribute($description);
            $journal->setIdUserAttribute($id_user);
            return $journal->save();
        }

        public function creerFournisseur($fullname, $matricule, $email, $adresse, $mobile1, $mobile2){
            $founisseur = new Fournisseur();
            $founisseur->setFullNameFournisseurAttribute($fullname);
            $founisseur->setMatriculeFournisseurAttribute($matricule);
            $founisseur->setEmailFournisseurAttribute($email);
            $founisseur->setAdresseFournisseurAttribute($adresse);
            $founisseur->setMobile1FournisseurAttribute($mobile1);
            if($mobile2 != null || $mobile2 != ""){
                $founisseur->setMobile2FournisseurAttribute($mobile2);
            }
            
            return $founisseur->save();
        }

        public function checkMatriculeFournisseur($matricule){
            return (Fournisseur::where('matricule_fournisseur', '=', $matricule)->exists());
        }

        public function checkEmailFournisseur($email){
            return (Fournisseur::where('email_fournisseur', '=', $email)->exists());
        }

        public function checkMobile1Fournisseur($mobile){
            return (Fournisseur::where('mobile1_fournisseur', '=', $mobile)->exists());
        }
    }
?>