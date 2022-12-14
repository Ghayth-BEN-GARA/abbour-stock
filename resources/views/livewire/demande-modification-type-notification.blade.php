<div>
    @if(auth()->user()->getTypeUserAttribute() == "Administrateur")
        <a class = "dropdown-toggle no-toggle-arrow" id = "notifications-dropdown-toggle" data-bs-toggle = "dropdown" href = "javascript:void(0)" role = "button" aria-expanded = "false" title = "Notifications">
            <i class = "lni lni-alarm icon"></i>
            @if($nbr_demandes > 0)
                <span class = "icon-badge">{{$nbr_demandes}}</span>
            @endif
        </a>
        <div class = "dropdown-menu p-0" aria-labelledby = "notifications-dropdown-toggle">
            <div class = "dropdown-menu-header p-3">
				<h5 class = "dropdown-menu-title mb-0">Notifications</h5>
			</div>
            <div class = "dropdown-menu-content">
                @if($nbr_demandes > 0)
                    @foreach($liste_demandes as $data)
                        <div class = "item p-3">
                            <div class = "row gx-2 justify-content-between align-items-center">
                                <div class = "col-auto">
                                    <img class = "profile-image" src = "{{$data->image}}" alt = "Photo de profil">
                                </div>
                                <div class = "col">
                                    <div class = "info">
                                        <div class = "desc">
                                            <a href = "{{url('/demande-update-type-compte?id_demande='.$data->getIdDemandeAttribute())}}" style = "color:inherit">
                                                {{$data->prenom}} {{$data->nom}} a créé une demande pour modifier le type de son compte.
                                            </a>
                                        </div>
                                        <div class = "meta">
                                            {{App\Http\Controllers\DemandeModificationTypeController::getDifferenceDate($data->getDateTimeDemandeAttribute())}}
                                        </div>
                                    </div>
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
                                        Aucune demande de modification de compte actuellement trouvée.
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
				<a href = "{{url('/liste-demandes-modification-type-compte')}}" style = "color:black">Afficher toutes les notifications</a>
		    </div>
        </div>
    @endif
</div>
