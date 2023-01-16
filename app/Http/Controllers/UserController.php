<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Str;
    use App\Models\User;
    use App\Models\Journal;
    use App\Models\DemandeModificationType;
    use App\Models\TempUser;
    use Session;

    class UserController extends Controller{
        public function ouvrirProfil(){
            return view('User.profil');
        }

        public function ouvrirEditPassword(){
            return view('User.edit_password');
        }

        public function gestionUpdatePassword(Request $request){
            if($this->checkEqualsPasswordsEntred($request->new_password, $request->confirm_new_password) != 0){
                return back()->with('erreur', 'Les deux mots de passe que vous avez saisis ne sont pas identiques.');
            }

            else if($this->checkUserPassword(auth()->user()->getEmailUserAttribute(), $request->new_password)){
                return back()->with('erreur', 'Vous avez entré votre ancien mot de passe, nous ne pouvons donc pas le modifier actuellement.');
            }

            else if($this->editPassword($request->new_password)){
                if($this->creerJounral("Modification de mot de passe", "Ajouter un nouveau mot de passe pour sécuriser le compte.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre mot de passe a été changé avec succès. Vous pouvez maintenant utiliser votre nouveau mot de passe.');
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function checkUserPassword($email, $password){
            $credentials = [
                'email' => $email,
                'password' => $password
            ];

            return Auth::attempt($credentials);
        }

        public function checkEqualsPasswordsEntred($password1, $password2){
            return strcmp($password1, $password2);
        }

        public function editPassword($password){
            return User::where('email', '=', auth()->user()->getEmailUserAttribute())->update([
                'password' => bcrypt($password)
            ]);
        }

        public function creerJounral($tache, $description, $id_user){
            $journal = new Journal();
            $journal->setTacheJournalAttribute($tache);
            $journal->setDescriptionJournalAttribute($description);
            $journal->setIdUserAttribute($id_user);
            return $journal->save();
        }

        public function ouvrirEditPreferences(){
            return view('User.edit_preferences');
        }

        public function ouvrirEditPhoto(){
            return view('User.edit_photo');
        }

        public function gestionUpdatePhoto(Request $request){
            if($this->updatePhotoProfil($request, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification du photo de profil", "Ajouter une nouvelle photo de profil pour le compte.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre photo de profil a été modifiée avec succès. Vous pouvez maintenant voir votre nouvelle image.');
                }
            }

            else{
                return back()->with('erreur', "Vous n'êtes pas obligé de choisir la même photo de profil.");
            }
        }

        public function updatePhotoProfil($request, $id_user){
            $filename = time().$request->file('new_photo')->getClientOriginalName();
            $path = $request->file('new_photo')->storeAs('/images/'.$id_user, $filename , 'public');
            $img = '/storage/'.$path;

            return User::where('id_user', '=', $id_user)->update([
                    'image' => $img
            ]);
        }

        public function ouvrirEditName(){
            return view('User.edit_name');
        }

        public function gestionUpdateFullName(Request $request){
            if($this->updateFullName($request->new_nom, $request->new_prenom, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification du nom", "Ajouter un nouveau nom pour le compte.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre nom a été changé avec succès. Vous pouvez maintenant voir vos nouvelles informations.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez saisi votre ancien nom et/ou prénom.");
            }
        }

        public function updateFullName($nom, $prenom, $id_user){
            return User::where('id_user', '=', $id_user)->update([
                'nom' => $nom,
                'prenom' => $prenom
            ]);
        }

        public function ouvrirEditGenre(){
            return view('User.edit_genre');
        }

        public function gestionUpdateGenre(Request $request){
            if($this->updateGenre($request->new_genre, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification du genre", "Choisir un nouveau genre d'utilisateur.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre genre a été changé avec succès. Vous pouvez maintenant voir votre nouveau genre.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez entré votre ancien sexe.");
            }
        }

        public function updateGenre($genre, $id_user){
            return User::where('id_user', '=', $id_user)->update([
                'genre' => $genre
            ]);
        }

        public function ouvrirEditDateNaissance(){
            return view('User.edit_date_naissance');
        }

        public function gestionUpdateDateNaissance(Request $request){
            if($this->updateDateNaissance($request->new_date_naissance, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification du date de naissance", "Choisir un nouveau date de naissance d'utilisateur.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre date de naissance a été modifiée avec succès. Vous pouvez maintenant voir votre nouvelle date de naissance.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez entré votre ancienne date de naissance.");
            }
        }

        public function updateDateNaissance($date_naissance, $id_user){
            return User::where('id_user', '=', $id_user)->update([
                'naissance' => $date_naissance
            ]);
        }

        public function ouvrirEditAdresse(){
            return view('User.edit_adresse');
        }

        public function gestionUpdateAdresse(Request $request){
            if($this->updateAdresse($request->new_adresse, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification d'adresse", "Choisir une nouvelle adresse d'utilisateur.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre adresse a été modifiée avec succès. Vous pouvez maintenant consulter votre nouvelle adresse.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez entré votre ancienne adresse.");
            }
        }

        public function updateAdresse($adresse, $id_user){
            return User::where('id_user', '=', $id_user)->update([
                'adresse' => $adresse
            ]);
        }

        public function ouvrirEditMobile(Request $request){
            return view('User.edit_mobile');
        }

        public function gestionUpdateMobile(Request $request){
            if(Str::length($request->new_mobile) != 8){
                return back()->with('erreur', "Le numéro de mobile d'utilisateur doit être composé de 8 chiffres.");
            }

            else if($this->checkUserMobile($request->new_mobile)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec ce numéro mobile.");
            }

            else if($this->updateMobile($request->new_mobile, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification de numéro mobile", "Choisir un nouveau numéro de mobile d'utilisateur", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre numéro de mobile a été changé avec succès. Vous pouvez maintenant voir votre nouveau numéro.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez saisi votre ancien numéro de mobile.");
            }
        }

        public function updateMobile($mobile, $id_user){
            return User::where('id_user', '=', $id_user)->update([
                'mobile' => $mobile
            ]);
        }

        public function checkUserMobile($mobile){
            return (User::where('mobile', '=', $mobile)->where('id_user', '!=', auth()->user()->getIdUserAttribute())->exists());
        }

        public function ouvrirEditCin(){
            return view('User.edit_cin');
        }

        public function gestionUpdateCin(Request $request){
            if(Str::length($request->new_cin) != 8){
                return back()->with('erreur', "Le numéro de carte d'identité d'utilisateur doit être composé de 8 chiffres.");
            }

            else if($this->checkUserCin($request->new_cin)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec ce numéro de carte d'identité.");
            }

            else if($this->updateCin($request->new_cin, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification de numéro de carte d'identité", "Choisir un nouveau numéro de carte d'identité d'utilisateur.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Votre numéro de carte d'identité a été modifié avec succès. Vous pouvez maintenant voir votre nouveau numéro de carte d'identité.");
                }
            }

            else{
                return back()->with('erreur', "Vous avez entré votre ancien numéro de carte d'identité.");
            }
        }

        public function updateCin($cin, $id_user){
            return User::where('id_user', '=', $id_user)->update([
                'cin' => $cin
            ]);
        }

        public function checkUserCin($cin){
            return (User::where('cin', '=', $cin)->where('id_user', '!=', auth()->user()->getIdUserAttribute())->exists());
        }

        public function ouvrirEditProfil(){
            return view('User.edit_profil');
        }

        public function gestionUpdateProfil(Request $request){
            if(Str::length($request->new_cin) != 8){
                return back()->with('erreur', "Le numéro de carte d'identité d'utilisateur doit être composé de 8 chiffres.");
            }

            else if($this->checkUserCin($request->new_cin)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec ce numéro de carte d'identité.");
            }

            else if(Str::length($request->new_mobile) != 8){
                return back()->with('erreur', "Le numéro mobile d'utilisateur doit être composé de 8 chiffres.");
            }

            else if($this->checkUserMobile($request->new_mobile)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec ce numéro de mobile.");
            }

            else if($this->updateProfil(auth()->user()->getIdUserAttribute(), $request->new_nom, $request->new_prenom, $request->new_genre, $request->new_cin, $request->new_date_naissance, $request->new_mobile, $request->new_adresse, $request)){
                if($this->creerJounral("Modification de profil", "Modifier les anciennes informations en ajoutant de nouvelles informations.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Vos informations ont été modifiées avec succès. Vous pouvez désormais les consulter à tout moment.");
                }
            }

            else{
                return redirect('erreur');
            }
        }

        public function updateProfil($id_user, $nom, $prenom, $genre, $cin, $naissance, $mobile, $adresse, $request){
            if($request->new_photo == null || $request->new_photo == ""){
                $img = auth()->user()->getPhotoUserAttribute();
            }

            else{
                $filename = time().$request->file('new_photo')->getClientOriginalName();
                $path = $request->file('new_photo')->storeAs('/images/'.$id_user, $filename , 'public');
                $img = '/storage/'.$path;
            }

            return User::where('id_user', '=', $id_user)->update([
                'nom' => $nom,
                'prenom' => $prenom, 
                'genre' => $genre, 
                'cin' => $cin,
                'naissance' => $naissance,
                'mobile' => $mobile,
                'adresse' => $adresse,
                'image' => $img
            ]);
        }

        public function ouvrirAddUser(){
            return view('User.add_user');
        }

        public function gestionCreateUser(Request $request){
            if($this->checkUserEmail($request->email)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec cette adresse email.");
            }

            else if($this->checkUserCin($request->cin)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec ce numéro de carte d'identité.");
            }

            else if(Str::length($request->cin) != 8){
                return back()->with('erreur', "Le numéro de carte d'identité d'utilisateur doit être composé de 8 chiffres.");
            }

            else if($this->checkUserMobile($request->mobile)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec ce numéro mobile.");
            }

            else if(Str::length($request->mobile) != 8){
                return back()->with('erreur', "Le numéro de mobile d'utilisateur doit être composé de 8 chiffres.");
            }

            else if($this->storeUser($request->email, $request->password, $request->cin, $request->nom, $request->prenom, $request->genre, $request->naissance, $request->mobile, $request->adresse, $request->type)){
                if($this->creerJounral("Création d'un nouveau compte", "Créer un nouveau compte pour l'utilisateur ".$request->prenom." ".$request->nom." en ajoutant les informations nécessaires à cette création.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Un nouvel utilisateur a été créé avec succès. Vous pouvez désormais le consulter à tout moment.");
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function storeUser($email, $password, $cin, $nom, $prenom, $genre, $naissance, $mobile, $adresse, $type){
            $user = new User();
            $user->setEmailUserAttribute($email);
            $user->setPasswordUserAttribute(bcrypt($password));
            $user->setCinUserAttribute($cin);
            $user->setNomUserAttribute($nom);
            $user->setPrenomUserAttribute($prenom);
            $user->setGenreUserAttribute($genre);
            $user->setNaissanceUserAttribute($naissance);
            $user->setMobileUserAttribute($mobile);
            $user->setAdresseUserAttribute($adresse);
            $user->setTypeUserAttribute($type);
            return $user->save();
        }

        public function checkUserEmail($email){
            return (User::where('email', '=', $email)->exists());
        }

        public function getIdUser($email){
            return User::where('email', '=', $email)->first()->getIdUserAttribute();
        }

        public function ouvrirEditEmail(){
            return view('User.edit_email');
        }

        public function gestionUpdateEmail(Request $request){
            if($this->checkUserEmailUpdateUser($request->new_email)){
                return back()->with('erreur3', "Un autre fournisseur a déjà été créé un compte avec cette adresse email.");
            }

            else if($this->updateEmail($request->new_email)){
                $this->removeSessionEmail();
                $this->addSessionEmail($request->new_email);
                if($this->creerJounral("Modification d'adresse email", "Choisir une nouvelle adresse e-mail d'utilisateur.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success3', "Votre adresse e-mail a été modifiée avec succès. Vous pouvez maintenant voir votre nouvelle adresse e-mail.");
                }
            }

            else{
                return back()->with('erreur3', "Vous avez entré votre ancienne adresse e-mail.");
            }
        }

        public function updateEmail($email){
            return User::where('id_user', '=', auth()->user()->getIdUserAttribute())->update([
                'email' => $email
            ]);
        }

        public function removeSessionEmail(){
            Session::forget('email');
        }

        public function addSessionEmail($email){
            Session::put('email', $email);
        }

        public function checkUserEmailUpdateUser($email){
            return (User::where('email', '=', $email)->where('email','!=',auth()->user()->getEmailUserAttribute())->exists());
        }

        public function ouvrirEditTypeCompte(){
            return view('User.edit_type_compte');
        }

        public function ouvrirListeUsers(){
            return view ('User.liste_users');
        }

        public function ouvrirUser(Request $request){
            $user = $this->getInformationsUser($request->input('id_user'));
            return view('User.user', compact('user'));
        }

        public function getInformationsUser($id_user){
            return User::where('id_user', '=', $id_user)->first();
        }

        public function ouvrirEditUser(Request $request){
            $user = $this->getInformationsUser($request->input('id_user'));
            return view('User.edit_user', compact('user'));
        }

        public function gestionModifierUser(Request $request){
            if($this->checkUserEmail2($request->id_user, $request->email)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec cette adresse email.");
            }

            else if($this->checkUserCin2($request->id_user, $request->cin)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec ce numéro de carte d'identité.");
            }

            else if(Str::length($request->cin) != 8){
                return back()->with('erreur', "Le numéro de carte d'identité d'utilisateur doit être composé de 8 chiffres.");
            }

            else if($this->checkUserMobile2($request->id_user, $request->mobile)){
                return back()->with('erreur', "Un autre utilisateur a déjà été créé un compte avec ce numéro mobile.");
            }

            else if(Str::length($request->mobile) != 8){
                return back()->with('erreur', "Le numéro de mobile d'utilisateur doit être composé de 8 chiffres.");
            }

            else if($this->updateUser($request->nom, $request->prenom, $request->email, $request->cin, $request->genre, $request->date_naissance, $request->mobile, $request->adresse, $request->type, $request->id_user)){
                if($this->creerJounral("Modification des informations de l'utilisateur", "Modifier les informations de l'utilisateur ".$request->prenom." ".$request->nom." en ajoutant les informations nécessaires à cette modification.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Les informations utilisateur ont été modifiées avec succès. Vous pouvez désormais les consulter à tout moment.");
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function checkUserEmail2($id_user, $email){
            return (User::where('id_user', '!=', $id_user)->where('email', '=', $email)->exists());
        }

        public function checkUserCin2($id_user, $cin){
            return (User::where('id_user', '!=', $id_user)->where('cin', '=', $cin)->exists());
        }

        public function checkUserMobile2($id_user, $mobile){
            return (User::where('id_user', '!=', $id_user)->where('mobile', '=', $mobile)->exists());
        }

        public function updateUser($nom, $prenom, $email, $cin, $genre, $naissance, $mobile, $adresse, $type, $id_user){
            return User::where('id_user', '=', $id_user)->update([
                'nom' => $nom,
                'prenom' => $prenom, 
                'email' => $email, 
                'cin' => $cin,
                'genre' => $genre,
                'naissance' => $naissance,
                'mobile' => $mobile,
                'adresse' => $adresse, 
                'type' => $type
            ]);
        }

        public function ouvrirParametres(){
            return view('User.parametres');
        }

        public function gestionUpdateState(Request $request){
            if($this->updateState(auth()->user()->getIdUserAttribute(), $request->input('resp'))){
                if($this->creerJounral("Modification de l'état de compte d'utilisateur", "Modifier l'état de compte d'utilisateur.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success1', "L'état du compte a bien été modifié.");
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function updateState($id_user, $new_state){
            return User::where('id_user', '=', $id_user)->update([
                'state' => $new_state
            ]);
        }

        public function gestionAccepterNewUser(Request $request){
            $email = $this->getInformationsNewUser($request->input('id_temp_user'))->email;

            if($this->creerNewUtilisateur($this->getInformationsNewUser($request->input('id_temp_user'))->nom, $this->getInformationsNewUser($request->input('id_temp_user'))->prenom, $this->getInformationsNewUser($request->input('id_temp_user'))->email, $this->getInformationsNewUser($request->input('id_temp_user'))->password)){
                $this->deleteNewUser($request->input('id_temp_user'));
                return redirect("/liste-users")->with("email", $email);
            }

            else{
                return redirect("/erreur");
            }
        }

        public function getInformationsNewUser($id_temp_user){
            return TempUser::where('id_temp_users', '=', $id_temp_user)->first();
        }

        public function deleteNewUser($id_temp_user){
            return TempUser::where('id_temp_users', '=', $id_temp_user)->delete();
        }

        public function creerNewUtilisateur($nom, $prenom, $email, $password){
            $user = new User();
            $user->setNomUserAttribute($nom);
            $user->setPrenomUserAttribute($prenom);
            $user->setEmailUserAttribute($email);
            $user->setPasswordUserAttribute($password);
            $user->setTypeUserAttribute("Admin");
            
            return $user->save();
        }

        public function gestionAnnulerNewUser(Request $request){
            if($this->deleteNewUser($request->input('id_temp_user'))){
                return redirect("/liste-users");
            }

            else{
                return redirect("/erreur");
            }
        }

        public function ouvrirListeNewUsers(){
            $liste_new_users = $this->getListeNewUsers();
            return view("User.liste_new_users", compact("liste_new_users"));
        }

        public function getListeNewUsers(){
            return TempUser::get();
        }
    }
?>
