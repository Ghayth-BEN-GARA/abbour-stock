<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Mail;
    use App\Models\User;
    use App\Models\Journal;
    use App\Models\TempUser;
    use App\Models\PasswordReset;
    use Session;
    use App\Mail\EnvoyerMailResetPassword;

    class AuthentificationUserController extends Controller{
        
        public function ouvrirSignin(){
            return view('Authentification.signin');
        }

        public function ouvrirSignup(){
            return view('Authentification.signup');
        }

        public function gestionConnexion(Request $request){
            if(!$this->checkUser($request->email)){
                return back()->with('erreur', "Aucun compte trouvé avec cette adresse email.");
            }

            else if(!$this->checkCredentials($request)){
                return back()->with('erreur', "Vérifiez vos paramètres de connexion et réessayez une autre fois.");
            }

            else if($this->signin($request->email)){
                return redirect('home');
            }

            else{
                return ('/erreur');
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
            return $this->creerJounral("Authentification", "Se connecter avec l'adresse e-mail et le mot de passe.", $this->getId($email));
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
            if($this->creerJounral("Déconnexion", "Se déconnecter de la session et revenir à la page d'authentification.", $this->getIdUserConnected())){
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

        public function ouvrirForgetPassword(){
            return view('Authentification.forget_password1');
        }

        public function gestionRecuperationCompte(Request $request){
            if(!$this->checkUser($request->email)){
                return back()->with('erreur', "Aucun compte trouvé avec cette adresse email.");
            }

            else if($this->sendTokenResetPassword($request->email, $this->getId($request->email), $this->generateToken())){
                return back()->with('success', "Veuillez vérifier votre boîte e-mail. Nous avons envoyé un lien de réinitialisation de mot de passe.");
            }

            else{
                return redirect('/erreur');
            }
        }

        public function generateToken(){
            return Str::random(64);
        }

        public function createPasswordReset($id_user, $token){
            $passwordReset = new PasswordReset();
            $passwordReset->setTokenAttribute($token);
            $passwordReset->setIdUserAttribute($id_user);
            
            return $passwordReset->save();
        }

        public function updatePasswordReset($id_user, $token){
            return PasswordReset::where('id_user', '=', $id_user)
                ->update([
                    'token' => $token
                ]);
        }

        public function checkTokenResetPassword($id_user, $token){
            return PasswordReset::where('id_user', '=', $id_user)->where('token', '=', $token)->exists();
        }

        public function gestionInsertUpdateTokenResetPassword($id_user, $token){
            if($this->checkTokenResetPassword($id_user, $token)){
                return $this->updatePasswordReset($id_user, $token);
            }

            else{
                return $this->createPasswordReset($id_user, $token);
            }
        }

        public function sendTokenResetPassword($email, $id_user, $token){
            if($this->gestionInsertUpdateTokenResetPassword($this->getId($email), $token)){
                $mailData = [
                    'email' => $email,
                    'fullname' => $this->getFullNameUserAttribute($email),
                    'token' => $token,
                    'id_user' => $id_user
                ];

                return Mail::to($email)->send(new EnvoyerMailResetPassword($mailData));
            }

            else{
                return false;
            }
        }

        public function getFullNameUserAttribute($email){
            return (User::where('email', '=', $email)->first()->getFullNameUserAttribute());
        }

        public function ouvrirResetPassword($token, $id_user){
            $checkToken = $this->checkTokenResetPassword($id_user, $token);
            return view('Authentification.reset_password', compact('id_user', 'token', 'checkToken'));
        }

        public function gestionUpdateResetPassword(Request $request){
            if($this->checkEqualsPasswordsEntred($request->new_password, $request->confirm_password) != 0){
                return back()->with('erreur', 'Les deux mots de passe que vous avez saisis ne sont pas identiques.');
            }

            else if($this->editPassword($request->id_user, $request->new_password)){
                if($this->creerJounral("Récupération de compte", "Ajouter un nouveau mot de passe pour aprés la récupération de compte.", $request->id_user)){
                    return redirect('/');
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function checkEqualsPasswordsEntred($password1, $password2){
            return strcmp($password1, $password2);
        }

        public function editPassword($id_user, $password){
            return User::where('id_user', '=',$id_user)->update([
                'password' => bcrypt($password)
            ]);
        }

        public function gestionSignup(Request $request){
            if($this->checkUser($request->email)){
                return back()->with('erreur', "Un autre compte a été trouvé avec cette adresse email.");
            }

            else if($this->creerCompteSignup($request->email, $request->password, $request->nom, $request->prenom)){
                return redirect("/confirm-signup")->with('success', "Nous sommes très heureux de confirmer que votre demande de création d'un nouveau compte de type administrateur a été envoyée avec succès.");
            }

            else{
                return redirect('/erreur');
            }
        }

        public function creerCompteSignup($email, $password, $nom, $prenom){
            $temp_user = new TempUser();
            $temp_user->setEmailUserAttribute($email);
            $temp_user->setPasswordUserAttribute(bcrypt($password));
            $temp_user->setNomUserAttribute($nom);
            $temp_user->setPrenomUserAttribute($prenom);

            return $temp_user->save();
        }

        public function ouvrirConfirmSignup(){
            return view("Authentification.confirm_signup");
        }
    }
?>
