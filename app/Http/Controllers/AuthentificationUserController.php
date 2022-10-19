<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use App\Models\journal;
    use Session;

    class AuthentificationUserController extends Controller{
        
        public function ouvrirSignin(){
            return view('Authentification.signin');
        }

        public function ouvrirNotExist(){
            return view('Errors.not_exist');
        }

        public function gestionConnexion(Request $request){
            if(!$this->checkUser($request->email)){
                return back()->with('erreur', "Aucun compte trouvé avec cette adresse email.");
            }

            else if(!$this->checkCredentials($request)){
                return back()->with('erreur', "Vérifiez vos paramètres de connexion et réessayez.");
            }

            else if($this->signin($request->email)){
                return redirect('home');
            }

            else{
                return back()->with('erreur', "Pour des raisons techniques, vous ne pouvez pas vous connecter pour le moment.");
            }
        }

        public function checkUser($email){
            return (User::where('email', '=', $email)->exists());
        }

        public function checkCredentials($request){
            $credentials = request(['email', 'password']);
            return Auth::attempt($credentials);
        }

        public function signin($email){
            $this->creerSession($email, $this->getType($email));
            return $this->creerJounral("Connexion", "Connexion normale avec adresse e-mail et mot de passe.", $this->getId($email));
        }

        public function creerSession($email, $type){
            Session::put('email', $email);
            Session::put('type', $type);
        }

        public function getType($email){
            return User::where('email', '=', $email)->first()->getTypeUserAttribute();
        }

        public function creerJounral($tache, $description, $id_user){
            $journal = new Journal();
            $journal->setTacheJournalAttribute($tache);
            $journal->setDescriptionJournalAttribute($description);
            $journal->setIdUserAttribute($id_user);
            return $journal->save();
        }

        public function getId($email){
            return User::where('email', '=', $email)->first()->getIdUserAttribute();
        }

        public function ouvrirHome(){
            return view('home');
        }

        public function gestionDeconnexion(){
            if($this->creerJounral("Déconnexion", "Déconnexion de votre session utilisateur et quitter l'application", $this->getIdUserConnected())){
                if($this->logout()){
                    return redirect('/');
                }

                else{
                    return redirect('/erreur');
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function logout(){
            Session::forget('email');
            Session::forget('type');
            Session::flush();

            if (!Session::has('email')){
                return true;
            }
        }

        public function getIdUserConnected(){
            return auth()->user()->getIdUserAttribute();
        }

        public function ouvrirError(){
            return view('Errors.erreur');
        }
    }
?>
