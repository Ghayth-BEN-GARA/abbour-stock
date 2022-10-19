<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
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
                if($this->creerJounral("Modifier le mot de passe", "Ajouter un nouveau mot de passe de compte", auth()->user()->getIdUserAttribute())){
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
    }
?>
