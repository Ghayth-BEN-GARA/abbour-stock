<div>
    @if(auth()->user()->getTypeUserAttribute() == "Administrateur")
        <a class = "dropdown-toggle no-toggle-arrow" id = "validation-dropdown-toggle" data-bs-toggle = "dropdown" href = "javascript:void(0)" role = "button" aria-expanded = "false" title = "Validations">
            <i class = "lni lni-tag icon"></i>
            @if($nbr_validations > 0)
                <span class = "icon-badge">{{$nbr_validations}}</span>
            @endif
        </a>
        <div class = "dropdown-menu p-0" aria-labelledby = "validation-dropdown-toggle">
            <div class = "dropdown-menu-header p-3">
				<h5 class = "dropdown-menu-title mb-0">Validations</h5>
			</div>
            <div class = "dropdown-menu-content">
                @if($nbr_validations > 0)
                    @foreach($liste_validations as $data)
                        <div class = "item p-3">
                            <div class = "row gx-2 justify-content-between align-items-center">
                                <div class = "col-auto">
                                    <div class = "app-icon-holder">
                                        <img class = "profile-image" src = "{{url('/images/article.png')}}" alt = "Photo de l'article">
                                    </div>
                                </div>
                                <div class = "col">
                                    <div class = "info">
                                        <div class = "desc">
                                            <a href = "#" style = "color:inherit">
                                                Suite à la création du facture d'achat référencée par <b>{{$data->reference_facture}}</b>, vous devez valider un article nommé <b>{{$data->designation}}</b> et référence par <b>{{$data->reference_article}}</b> en raison de modification de prix d'achat pour cet article.
                                            </a>
                                        </div>
                                        <div class = "meta">
                                            {{App\Http\Controllers\DemandeModificationTypeController::getDifferenceDate($data->date_validation_new_prix_article)}}
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
                                        Aucune validation de prix d'article actuellement trouvée.
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
        </div>
    @endif
</div>
