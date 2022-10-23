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

        public function ouvrirListeFournisseurs(){
            return view('Fournisseurs.liste_fournisseurs');
        }

        public function ouvrirFournisseur(Request $request){
            $fournisseur = $this->getInformationsFournisseur($request->input('matricule_fournisseur'));
            return view('Fournisseurs.fournisseur', compact('fournisseur'));
        }

        public function getInformationsFournisseur($matricule){
            return Fournisseur::where('matricule_fournisseur', '=', $matricule)->first();
        }

        public function ouvrirEditFournisseur(Request $request){
            $fournisseur = $this->getInformationsFournisseur($request->input('matricule_fournisseur'));
            return view('Fournisseurs.edit_fournisseur', compact('fournisseur'));
        }

        public function gestionModifierFournisseur(Request $request){
            if($this->checkMatriculeFournisseur2($request->input('matricule_fournisseur'), $request->matricule)){
                return back()->with('erreur', "Un autre fournisseur créé avec cette matricule.");
            }

            else if($this->checkEmailFournisseur2($request->input('matricule_fournisseur'), $request->email)){
                return back()->with('erreur', "Un autre fournisseur créé avec cette adresse email.");
            }

            else if(Str::length($request->mobile1) != 8){
                return back()->with('erreur', "Vérifiez que le numéro mobile est composé de 8 chiffres.");
            }

            else if($this->checkMobile1Fournisseur2($request->input('matricule_fournisseur'), $request->mobile1)){
                return back()->with('erreur', "Un autre fournisseur créé avec ce numéro mobile.");
            }

            else if($this->updateFournisseur($request->fullname, $request->matricule, $request->email, $request->adresse, $request->mobile1, $request->mobile2, $request->matricule_fournisseur)){
                if($this->creerJounral("Modification de fournisseur", "Modifier les information de fournisseur ".$request->fullname." en ajoutant les informations requises.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Le fournisseur a été modifié avec succès. Vous pouvez désormais le consulter à tout moment.");
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function checkMatriculeFournisseur2($matricule, $new_matricule){
            return (Fournisseur::where('matricule_fournisseur', '!=', $matricule)->where('matricule_fournisseur', '=', $new_matricule)->exists());
        }

        public function checkEmailFournisseur2($matricule, $email){
            return (Fournisseur::where('matricule_fournisseur', '!=', $matricule)->where('email_fournisseur', '=', $email)->exists());
        }

        public function checkMobile1Fournisseur2($matricule, $mobile){
            return (Fournisseur::where('matricule_fournisseur', '!=', $matricule)->where('mobile1_fournisseur', '=', $mobile)->exists());
        }

        public function updateFournisseur($fullname, $matricule, $email, $adresse, $mobile1, $mobile2, $matricule_fournisseur){
            return Fournisseur::where('matricule_fournisseur', '=', $matricule_fournisseur)->update([
                'fullname_fournisseur' => $fullname,
                'matricule_fournisseur' => $matricule, 
                'email_fournisseur' => $email,
                'adresse_fournisseur' => $adresse, 
                'mobile1_fournisseur' => $mobile1,
                'mobile2_fournisseur' => $mobile2
            ]);
        }
    }
?>
