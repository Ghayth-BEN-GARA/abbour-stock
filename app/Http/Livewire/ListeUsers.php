<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\User;

    class ListeUsers extends Component{
        public $search;
        public $type_compte = "Tout";
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            if($this->type_compte == "Tout"){
                return view('livewire.liste-users', [
                    'users' => User::where('type', '<>', 'Administrateur')
                    ->where([
                        ['id_user', '<>', auth()->user()->getIdUserAttribute()],
                        ['nom', 'like', '%'.$this->search.'%'],
                    ])
                    ->orWhere([
                        ['id_user', '<>', auth()->user()->getIdUserAttribute()],
                        ['prenom', 'like', '%'.$this->search.'%'],
                    ])
                    ->orWhere([
                        ['id_user', '<>', auth()->user()->getIdUserAttribute()],
                        ['email', 'like', '%'.$this->search.'%'],
                    ])
                    ->orderBy('prenom', 'asc')
                    ->paginate(10, array('users.*'))
                ]);
            }

            else{
                return view('livewire.liste-users', [
                    'users' => User::where('type', '<>', 'Administrateur')
                    ->where([
                        ['id_user', '<>', auth()->user()->getIdUserAttribute()],
                        ['nom', 'like', '%'.$this->search.'%'],
                        ['type', '=', $this->type_compte],
                    ])

                    ->orWhere([
                        ['id_user', '<>', auth()->user()->getIdUserAttribute()],
                        ['prenom', 'like', '%'.$this->search.'%'],
                        ['type', '=', $this->type_compte],
                    ])

                    ->orWhere([
                        ['id_user', '<>', auth()->user()->getIdUserAttribute()],
                        ['email', 'like', '%'.$this->search.'%'],
                        ['type', '=', $this->type_compte],
                    ])

                    ->orderBy('prenom', 'asc')
                    ->paginate(10, array('users.*'))
                ]);
            }
        }

        public function setPage($url){
            $this->currentPage = explode('page=',$url)[1];
            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }
    }
?>
