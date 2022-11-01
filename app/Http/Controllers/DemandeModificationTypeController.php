<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Mail;
    use App\Models\User;
    use App\Models\Journal;
    use App\Models\DemandeModificationType;
    use Carbon\Carbon;
    use App\Mail\EnvoyerNotificationDecisionAdministrateur;

    class DemandeModificationTypeController extends Controller{
    
        public function gestionCreateDemandeModificationType(Request $request){
            if($this->checkUserDemandeModificationType()){
                return back()->with('erreur2', "L'administrateur n'a pas encore répondu à votre dernière demande, vous ne pouvez donc pas faire une autre demande pour modifier votre type de compte.");
            }

            else if($this->getTypeUser() == $request->new_type){
                return back()->with('erreur2', "Vous avez choisi votre type de compte actuel.");
            }

            else if($this->creerDemandeModificationTypeUser($request->new_type, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification du type de compte", "Choisir un nouveau type de compte d'utilisateur.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success2', "Votre demande de changement de type de compte a été soumise avec succès. Vous recevrez une notification avec une présentation de la décision dès que la décision est prise.");
                }
            }
        }

        public function creerDemandeModificationTypeUser($type, $id_user){
            $demande = new DemandeModificationType();
            $demande->setTypeDemandeAttribute($type);
            $demande->setIdUserAttribute($id_user);
            return $demande->save();
        }

        public function checkUserDemandeModificationType(){
            return (DemandeModificationType::where('id_user', '=', auth()->user()->getIdUserAttribute())->where('etat_demande', '=', 0)->exists());
        }

        public function getTypeUser(){
            return User::where('id_user', '=', auth()->user()->getIdUserAttribute())->first()->getTypeUserAttribute();
        }

        public function creerJounral($tache, $description, $id_user){
            $journal = new Journal();
            $journal->setTacheJournalAttribute($tache);
            $journal->setDescriptionJournalAttribute($description);
            $journal->setIdUserAttribute($id_user);
            return $journal->save();
        }

        public function ouvrirMesDemandes(){
            $demandes = $this->getListeMesDemandes(auth()->user()->getIdUserAttribute());
            return view('User.mes_demandes', compact('demandes'));
        }

        public function getListeMesDemandes($id_user){
            return (DemandeModificationType::where('id_user', '=', $id_user)->paginate(10));
        }

        public static function getDifferenceDate($date){
            $currentDate = strtotime(Carbon::now('+01:00')->format('Y-m-d H:i:s'));
            $dateNotification = strtotime($date);
            $differenceDates = $currentDate - $dateNotification;

            if($differenceDates < 60){
                return ('Il y a quelques secondes.');
            }

            else if($differenceDates >= 60 && $differenceDates < 3600){
                return ("Il y a ".round($differenceDates / 60)." minutes.");
            }

            else if($differenceDates >= 3600 && $differenceDates < 86400){
                return ("Il y a ".round($differenceDates / 3600)." heures.");
            }

            else if($differenceDates >= 86400 && $differenceDates < 86400 * 30){
                return ("Il y a ".round($differenceDates / 86400)." jours.");
            }

            else if($differenceDates >= 86400 * 30 && $differenceDates < 86400 * 365){
                return ("Il y a ".round($differenceDates / 86400 * 30)." mois.");
            }

            else{
                return ("Il y a ".round($differenceDates / (86400 * 365))." ans.");
            }
        }

        public function gestionDeleteDemande(Request $request){
            if($this->deleteDemande($request->input('id_demande'))){
                if($this->creerJounral("Annulation de la demande de changement de type de compte", "Annuler la demande de changement de type de compte envoyée à l'administrateur de l'application.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Votre demande de changement de type de compte a été annulée avec succès. Vous pouvez créer une nouvelle demande à tout moment.");
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function deleteDemande($id_demande){
            return DemandeModificationType::where('id_demande',$id_demande)->delete();
        }

        public function ouvrirDemandeUpdateTypeCompte(Request $request){
            $demande = $this->getDetailsDemandeUpdateTypeAcount($request->input('id_demande'));
            return view('User.demande_update_type_compte', compact('demande'));
        }

        public function getDetailsDemandeUpdateTypeAcount($id_demande){
            return DemandeModificationType::join('users', 'users.id_user', '=', 'demandes_modification_type.id_user')
                    ->where('demandes_modification_type.id_demande', '=', $id_demande)
                    ->first();
        }

        public function gestionAccepterRefuserDemande(Request $request){
            if($this->updateDemandeModificationTypeCompte($request->input('id_demande'), $request->input('resp'))){
                if($this->updateTypeCompte($request->input('id_user'), $request->input('new_type'))){
                    if($this->envoyerEmailDecisionModificationTypeCompte($request->input('id_user'), $request->input('resp'))){
                        if($this->creerJounral("Gestion des demandes de changement de type de compte", "Vous avez traité avec succès la demande de changement de type de compte.", auth()->user()->getIdUserAttribute())){
                            return back()->with('success', "La demande de changement de type de compte a été traitée avec succès.");
                        }
                    }
                }
            }

            else{
                return redirect('/erreur');
            }
        }

        public function updateDemandeModificationTypeCompte($id_demande, $new_etat){
            return DemandeModificationType::where('id_demande', '=', $id_demande)->update([
                'etat_demande' => $new_etat
            ]);
        }

        public function envoyerEmailDecisionModificationTypeCompte($id_user, $new_etat){
            $mailData = [
                'email' => $this->getEmailAttribute($id_user),
                'prenom' => $this->getPrenomAttribute($id_user),
                'fullname' => $this->getFullNameAttribute($id_user),
                'etat_demande' => $new_etat
            ];
            return (Mail::to($this->getEmailAttribute($id_user))->send(new EnvoyerNotificationDecisionAdministrateur($mailData)));
        }

        public function getEmailAttribute($id_user){
            return User::where('id_user',$id_user)->first()->getEmailUserAttribute();
        }

        public function getPrenomAttribute($id_user){
            return User::where('id_user',$id_user)->first()->getPrenomUserAttribute();
        }

        public function getFullNameAttribute($id_user){
            return User::where('id_user',$id_user)->first()->getFullNameUserAttribute();
        }

        public function ouvrirListeDemandeModificationCompte(){
            $demandes = $this->getListeDemandeModificationTypeCompte();
            return view('User.liste_demandes_modification_type_compte', compact('demandes'));
        }

        public function getListeDemandeModificationTypeCompte(){
            return DemandeModificationType::join('users', 'users.id_user', '=', 'demandes_modification_type.id_user')
                ->where('demandes_modification_type.etat_demande', '=', '0')
                ->where('demandes_modification_type.id_user', '<>', auth()->user()->getIdUserAttribute())
                ->orderBy('demandes_modification_type.date_time_demande','desc')
                ->get();
        }

        public function updateTypeCompte($id_user, $new_type){
            if($new_type != 'null'){
                return User::where('id_user', '=', $id_user)->update([
                    'type' => $new_type
                ]);
            }

            else{
                return true;
            }
        }
    }
?>
