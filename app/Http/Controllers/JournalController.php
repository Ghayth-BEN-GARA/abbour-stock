<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Journal;

    class JournalController extends Controller{

        public function ouvrirJournales(){
            $journal = $this->getListeJournal(auth()->user()->getIdUserAttribute());
            return view('User.journales', compact('journal'));
        }

        public function getListeJournal($id_user){
            return (Journal::where('id_user', '=', $id_user)->paginate(10));
        }

        public function gestionDeleteJournalProfil(){
            if($this->getListeJournal(auth()->user()->getIdUserAttribute())->count() == 0){
                return back()->with('erreur', "Vous ne pouvez pas supprimer un journal d'authentification déjà vide.");
            }

            else if($this->deleteJournal(auth()->user()->getIdUserAttribute())){
                return back()->with('success', "Votre journal d'authentification a été effacé avec succès.");
            }

            else{
                return redirect('/erreur');
            }
        }

        public function deleteJournal($id_user){
            return Journal::where('id_user',$id_user)->delete();
        }
    }
?>
