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
                return back()->with('erreur2', "L'administrateur n'a pas encore répondu à votre dernière demande, vous ne pouvez donc pas faire une autre demande pour changer le type de votre compte.");
            }

            else if($this->getTypeUser() == $request->new_type){
                return back()->with('erreur2', "Vous avez choisir votre ancien type de compte.");
            }

            else if($this->creerDemandeModificationTypeUser($request->new_type, auth()->user()->getIdUserAttribute())){
                if($this->creerJounral("Modification de type de compte", "Choisir un nouveau type de compte d'utiliateur", auth()->user()->getIdUserAttribute())){
                    return back()->with('success2', "Votre demande de modification de rôle a été envoyée avec succès. Vous recevrez une notification avec une présentation de la décision dès que possible.");
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
            $currentDate = strtotime(Carbon::now('+02:00')->format('Y-m-d H:i:s'));
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
                if($this->creerJounral("Annulation de demande", "Annuler la demande de modification de type de compte envoyé à l'administrateur de l'application.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Votre demande de modification de type de compte a été annulé avec succès. Vous pouvez créer une nouvelle demande à tout moment.");
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
                if($this->envoyerEmailDecisionModificationTypeCompte($request->input('id_user'), $request->input('resp'))){
                    if($this->creerJounral("Gestion de la demande", "Vous avez bien géré la demande de modification de type de compte.", auth()->user()->getIdUserAttribute())){
                        return back()->with('success', "Votre demande de modification de type de compte a été géré avec succès. Vous pouvez créer une nouvelle demande à tout moment.");
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
    }
?>
