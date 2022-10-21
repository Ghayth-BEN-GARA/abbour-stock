<div>
    @if(auth()->user()->getTypeUserAttribute() == "Administrateur")
        <a class = "dropdown-toggle no-toggle-arrow" id = "notifications-dropdown-toggle" data-bs-toggle = "dropdown" href = "javascript:void(0)" role = "button" aria-expanded = "false" title = "Notifications">
            <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-bell icon" fill = "#828d9f" xmlns = "http://www.w3.org/2000/svg">
                <path d = "M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/>
                <path fill-rule = "evenodd" d = "M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
            </svg>
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
                                <img class = "profile-image" src = "{{auth()->user()->getImageAttribute()}}" alt = "Photo de profil">
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
				<a href = "#" style = "color:black">Afficher toutes les notifications</a>
		    </div>
        </div>
    @endif
</div>
