<div>
    @if(auth()->user()->getTypeUserAttribute() == "Administrateur")
        <a class = "dropdown-toggle no-toggle-arrow" id = "new-users-dropdown-toggle" data-bs-toggle = "dropdown" href = "javascript:void(0)" role = "button" aria-expanded = "false" title = "Users">
            <i class = "lni lni-users icon"></i>
            @if($nbr_users > 0)
                <span class = "icon-badge">{{$nbr_users}}</span>
            @endif
        </a>
        <div class = "dropdown-menu p-0" aria-labelledby = "new-users-dropdown-toggle">
            <div class = "dropdown-menu-header p-3">
				<h5 class = "dropdown-menu-title mb-0">Utilisateurs</h5>
			</div>
            <div class = "dropdown-menu-content">
                @if($nbr_users > 0)
                    @foreach($liste_users as $data)
                        <div class = "item p-3">
                            <div class = "row gx-2 justify-content-between align-items-center">
                                <div class = "col-md-2">
                                    <img class = "profile-image" src = "{{URL::asset('images/user.png')}}" alt = "Photo de profil">
                                </div>
                                <div class = "col-md-6">
                                    <b>{{$data->getPrenomUserAttribute()}} {{$data->getNomUserAttribute()}}</b>                                           
                                    <p>Nouveau compte</p> 
                                </div>
                                <div class = "col-md-4 mt-3">
                                    <p>{{$this->getDifferenceDate($data->getDateCreationUserAttribute())}}</p>
                                </div>
                                <div class = "btn-group mt-3 mx-5 col-md-6 text-center">
                                    <a href = "{{url('/accept-new-user?id_temp_user='.$data->id_temp_users)}}" type = "button" class = "btn app-btn-primary btn-sm">Confirmer</a>
                                    <a href = "{{url('/annuler-new-user?id_temp_user='.$data->id_temp_users)}}" type = "button" class = "btn app-btn-secondary btn-sm mx-4">Annuler</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class = "item p-3">
                        <div class = "row gx-2 justify-content-between align-items-center">
                            <div class = "col-auto">
                                <img class = "profile-image" src = "{{auth()->user()->getImageUserAttribute()}}" alt = "Photo de profil">
                            </div>
                            <div class = "col">
                                <div class = "info">
                                    <div class = "desc">
                                        Aucune nouveau utilisateurs actuellement trouvé.
                                    </div>
                                    <div class = "meta">
                                        Maintenant
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class = "dropdown-menu-footer p-2 text-center">
				<a href = "#" style = "color:black">Afficher toutes les utilisateurs</a>
		    </div>
        </div>
    @endif
</div>
