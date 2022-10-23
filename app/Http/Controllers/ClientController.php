<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use App\Models\Journal;
    use App\Models\Client;

    class ClientController extends Controller{
        public function ouvrirAddClient(){
            return view('Clients.add_client');
        }

        public function gestionCreerClient(Request $request){
            if($this->checkMatriculeClient($request->matricule)){
                return back()->with('erreur', "Un autre client créé avec cette matricule.");
            }

            else if($this->checkEmailClient($request->email)){
                return back()->with('erreur', "Un autre client créé avec cette adresse email.");
            }

            else if($this->checkMobileClient($request->mobile)){
                return back()->with('erreur', "Un autre client créé avec ce numéro mobile.");
            }

            else if(Str::length($request->mobile) != 8){
                return back()->with('erreur', "Vérifiez que le numéro mobile est composé de 8 chiffres.");
            }

            else if($this->creerClient($request->nom, $request->prenom, $request->matricule, $request->email, $request->adresse, $request->mobile)){
                if($this->creerJounral("Création d'un nouveau client", "Créer un nouveau client ".$request->prenom." ".$request->nom." en ajoutant les informations requises.", auth()->user()->getIdUserAttribute())){
                    return back()->with('success', "Un nouveau client a été créé avec succès. Vous pouvez désormais le consulter à tout moment.");
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

        public function creerClient($nom, $prenom, $matricule, $email, $adresse, $mobile){
            $client = new Client();
            $client->setMatriculeClientAttribute($matricule);
            $client->setNomClientAttribute($nom);
            $client->setPrenomClientAttribute($prenom);
            $client->setEmailClientAttribute($email);
            $client->setAdresseClientAttribute($adresse);
            $client->setMobileClientAttribute($mobile);
            
            return $client->save();
        }

        public function checkMatriculeClient($matricule){
            return (Client::where('matricule_client', '=', $matricule)->exists());
        }

        public function checkEmailClient($email){
            return (Client::where('email_client', '=', $email)->exists());
        }

        public function checkMobileClient($mobile){
            return (Client::where('mobile_client', '=', $mobile)->exists());
        }
    }
?>
