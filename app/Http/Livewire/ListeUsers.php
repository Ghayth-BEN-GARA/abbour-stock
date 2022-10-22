<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\User;

    class ListeUsers extends Component{
        public $search;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
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

        public function setPage($url){
            $this->currentPage = explode('page=',$url)[1];
            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }
    }
?>
