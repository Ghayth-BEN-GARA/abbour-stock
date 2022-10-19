<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\File;
    use App\Models\User;
    use App\Models\journal;

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
                if($this->creerJounral("Modification du photo de profil", "Modification de photo de profil de compte", auth()->user()->getIdUserAttribute())){
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
                if($this->creerJounral("Modification du nom et prénom", "Modification du nom et prénom d'utilisateur", auth()->user()->getIdUserAttribute())){
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
                if($this->creerJounral("Modification du genre", "Modification du genre d'utiliateur", auth()->user()->getIdUserAttribute())){
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
    }
?>
