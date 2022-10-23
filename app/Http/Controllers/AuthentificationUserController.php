<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Mail;
    use App\Models\User;
    use App\Models\journal;
    use App\Models\PasswordReset;
    use Session;
    use App\Mail\EnvoyerMailResetPassword;

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
            return PasswordReset::where('id_user', '=', $id_user)->exists();
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
    }
?>
