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
                                            <a href = "javascript:void(0)" style = "color:inherit;" data-bs-toggle = "modal" data-bs-target = "#validation-prix-achat-modal" type = "button" data-id-reference-article = "{{$data->reference_article}}" data-designation-article = "{{$data->designation}}" data-new-prix-article = "{{$data->new_prix_unitaire_article}}" data-id-validation-prix-article = "{{$data->id_validation_prix_article}}" data-ancien-prix-article = "{{$this->getAncienPrixAchat($data->reference_article)}}" class = "open_modal">
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
            <div class = "dropdown-menu-footer p-2 text-center">
				<a href = "{{url('/liste-validations-prix-achat')}}" style = "color:black">Afficher toutes les validations</a>
		    </div>
        </div>
    @endif
</div>
<div id = "validation-prix-achat-modal" class = "modal fade" tabindex = "-1" role = "dialog" aria-hidden = "true">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h5 class = "modal-title">Prix d'achat</h5>
                <button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>
            </div>
            <div class = "modal-body">
                <div class = "text-center mt-2 mb-4">
                    <a href = "javascript:void(0)" class = "text-success">
                        <span>
                            <img src = "{{URL::asset('/images/favicon.png')}}" alt = "Logo de l'application" height = 80/>
                        </span>
                        <h6 class = "mt-1">Validation de prix</h6>
                    </a>
                </div>
                <form action = "{{url('/valider-new-prix-article')}}" class = "ps-3 pe-3" method = "post" name = "f-validation-prix-achat" id = "f-validation-prix-achat" onsubmit = "validerValidationPrixArticle()">
                    @csrf
                    <div class = "item border-bottom py-3">
                        <div class = "row justify-content-between align-items-center">
                            <div class = "col-auto col-lg-6">
                                <div class = "item-label">
                                    <strong>Référence</strong>
                                </div>
                                <div class = "item-data">
                                    <input type = "number" class = "form-control" id = "reference_article" name = "reference_article" placeholder = "Entrez la référence de l'article.." readonly required>
                                </div>
                            </div>
                            <div class = "col-auto col-lg-6">
                                <div class = "item-label">
                                    <strong>Article</strong>
                                </div>
                                <div class = "item-data">
                                    <input type = "text" class = "form-control" id = "designation_article" name = "designation_article" placeholder = "Entrez la désignation de l'article.." readonly required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "item border-bottom py-3">
                        <div class = "row justify-content-between align-items-center">
                            <div class = "col-auto col-lg-6">
                                <div class = "item-label">
                                    <strong>Ancien Prix</strong>
                                </div>
                                <div class = "item-data">
                                    <input type = "text" class = "form-control" id = "ancien_prix_article" name = "ancien_prix_article" placeholder = "Entrez l'ancien prix de l'article.." onkeypress = "return (event.charCode>=46 && event.charCode<=57)" readonly required>
                                </div>
                            </div>
                            <div class = "col-auto col-lg-6">
                                <div class = "item-label">
                                    <strong>Nouveaux Prix</strong>
                                </div>
                                <div class = "item-data">
                                    <input type = "text" class = "form-control" id = "new_prix_article" name = "new_prix_article" placeholder = "Entrez le nouveaux prix de l'article.." onkeypress = "return (event.charCode>=46 && event.charCode<=57)" oninput = "effacerErreurPrixArticle()" required>
                                </div>
                            </div>
                            <p class = "form-text text-danger mt-2" id = "erreur_prix_achat"></p>
                        </div>
                    </div>
                    <div class = "item py-2 mx-auto text-center">
                        <button type = "submit" class = "btn app-btn-primary">Valider le prix</button>
                        <a href = "javascript:void(0)" type = "button" class = "btn app-btn-secondary" onclick = "annulerValidationPrixAchat($('#id_validation_prix_article').val(), $('#reference_article').val())">Annuler</a>
                    </div>
                    <input type = "hidden" class = "form-control" id = "id_validation_prix_article" name = "id_validation_prix_article" placeholder = "Entrez l'identifiant de validation de prix de l'article.." readonly required>
                </form>
            </div>
        </div>
    </div>
</div>

<script src = "{{asset('js/jquery.js')}}"></script>
<script> 
    $(function () {
        $(".open_modal").click(function () {
            var reference_article = $(this).data('id-reference-article');
            var designation_article = $(this).data('designation-article');
            var new_prix_article = $(this).data('new-prix-article');
            var id_validation_prix_article = $(this).data('id-validation-prix-article');
            var ancien_prix_article = $(this).data('ancien-prix-article');

            $("#reference_article").val(reference_article);
            $("#designation_article").val(designation_article);
            $("#new_prix_article").val(new_prix_article);
            $("#id_validation_prix_article").val(id_validation_prix_article);
            $("#ancien_prix_article").val(ancien_prix_article);
            $('.modal').appendTo("body") 
        })
    });
</script>
