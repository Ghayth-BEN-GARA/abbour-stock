<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Str;
    use App\Models\User;
    use App\Models\Journal;

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

            elseif($this->checkUserPassword(auth()->user()->getEmailUserAttribute(), $request->new_password)){
                return back()->with('erreur', 'Vous avez entré votre ancien mot de passe, nous ne pouvons donc pas le modifier actuellement.');
            }

            else if($this->editPassword($request->new_password)){
                if($this->creerJounral("Modification de mot de passe", "Ajout d'un nouveau mot de passe de compte", auth()->user()->getIdUserAttribute())){
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
                if($this->creerJounral("Modification du photo de profil", "Ajouter une nouvelle photo de profil pour votre compte", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre photo de profil a été changé avec succès. Vous pouvez maintenant consulter votre nouveau image.');
                }
            }

            else{
                return back()->with('erreur', "Vous n'êtes pas obligé de saisir la même photo de profil.");
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
                if($this->creerJounral("Modification du nom et prénom", "Ajouter un nouvau nom et prénom pour le compte", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre nom a été changé avec succès. Vous pouvez maintenant consulter vos nouveaux informations.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez saisir votre ancien nom et/ou prénom.");
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
                if($this->creerJounral("Modification du genre", "Choisir un nouveau genre d'utiliateur", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre genre a été changé avec succès. Vous pouvez maintenant consulter votre nouveau genre.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez saisir votre ancien genre.");
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
                if($this->creerJounral("Modification du date de naissance", "Choisir un nouveau date de naissance d'utiliateur", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre date de naissance a été changé avec succès. Vous pouvez maintenant consulter votre nouveau date de naissance.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez saisir votre ancien date de naissance.");
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
                if($this->creerJounral("Modification d'adresse", "Choisir une nouvelle adresse d'utiliateur", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre adresse a été changé avec succès. Vous pouvez maintenant consulter votre nouvelle adresse.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez saisir votre ancien adresse.");
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
                return back()->with('erreur', "Vérifiez que le numéro de mobile est composé de 8 chiffres.");
            }

            else if($this->checkUserMobile($request->new_mobile)){
                return back()->with('erreur', "Un autre compte créé avec ce numéro de mobile.");
            }

            else if($this->updateMobile($request->new_mobile, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification de numéro mobile", "Choisir un nouveau numéro mobile d'utiliateur", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', 'Votre numéro mobile a été changé avec succès. Vous pouvez maintenant consulter votre nouvelle numéro.');
                }
            }

            else{
                return back()->with('erreur', "Vous avez saisir votre ancien numéro mobile.");
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
                return back()->with('erreur', "Vérifiez que le numéro de carte d'identité est composé de 8 chiffres.");
            }

            else if($this->checkUserCin($request->new_cin)){
                return back()->with('erreur', "Un autre compte créé avec ce numéro de carte d'identité.");
            }

            else if($this->updateCin($request->new_cin, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification de numéro de carte d'identité", "Choisir un nouveau numéro de carte d'identité d'utiliateur", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Votre numéro de carte d'identité a été changé avec succès. Vous pouvez maintenant consulter votre nouvelle numéro de carte.");
                }
            }

            else{
                return back()->with('erreur', "Vous avez saisir votre ancien numéro de carte d'identité.");
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
                return back()->with('erreur', "Vérifiez que le numéro de carte d'identité est composé de 8 chiffres.");
            }

            else if($this->checkUserCin($request->new_cin)){
                return back()->with('erreur', "Un autre compte créé avec ce numéro de carte d'identité.");
            }

            else if(Str::length($request->new_mobile) != 8){
                return back()->with('erreur', "Vérifiez que le numéro de mobile est composé de 8 chiffres.");
            }

            else if($this->checkUserMobile($request->new_mobile)){
                return back()->with('erreur', "Un autre compte créé avec ce numéro de mobile.");
            }

            else if($this->updateProfil(auth()->user()->getIdUserAttribute(), $request->new_nom, $request->new_prenom, $request->new_genre, $request->new_cin, $request->new_date_naissance, $request->new_mobile, $request->new_adresse, $request)){
                if($this->creerJounral("Modification de profil", "Modifier les anciennes informations en ajoutant de nouvelles informations", auth()->user()->getIdUserAttribute())){
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
                return back()->with('erreur', "Un autre compte créé avec cette adresse email.");
            }

            else if($this->checkUserCin($request->cin)){
                return back()->with('erreur', "Un autre compte créé avec ce numéro de carte d'identité.");
            }

            else if(Str::length($request->cin) != 8){
                return back()->with('erreur', "Vérifiez que le numéro de carte d'identité est composé de 8 chiffres.");
            }

            else if($this->checkUserMobile($request->mobile)){
                return back()->with('erreur', "Un autre compte créé avec ce numéro mobile.");
            }

            else if(Str::length($request->mobile) != 8){
                return back()->with('erreur', "Vérifiez que le numéro mobile est composé de 8 chiffres.");
            }

            else if($this->storeUser($request->email, $request->password, $request->cin, $request->nom, $request->prenom, $request->genre, $request->naissance, $request->mobile, $request->adresse, $request->type)){
                if($this->creerJounral("Création d'un nouveau compte", "Créer un nouveau compte pour l'utilisateur ".$request->prenom." ".$request->nom."en ajoutant les informations requises.", $this->getIdUser($request->email))){
                    return back()->with('success', "Vos informations ont été modifiées avec succès. Vous pouvez désormais les consulter à tout moment.");
                }
            }

            else{
                return redirect('erreur');
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

        public function sauvegarderImage($request, $id_user){
            $filename = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('/images/'.$id_user, $filename , 'public');
            $img = '/storage/'.$path;
            return $img;
        }

        public function getIdUser($email){
            return User::where('email', '=', $email)->first()->getIdUserAttribute();
        }
    }
?>
