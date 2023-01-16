<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Validation</title> 
        @include('Layout.head_app')
    </head> 
    <body class = "app">
        <header class = "app-header fixed-top">
            <div class = "app-header-inner"> 
                @include('Layout.horizontal_nav')
            </div>
            <div id = "app-sidepanel" class = "app-sidepanel"> 
                @include('Layout.vertical_nav')
            </div>
        </header>
        <div class = "app-wrapper">
            <div class = "app-content pt-3 p-md-3 p-lg-4">
                <div class = "container-xl">
                    <h1 class = "app-page-title">Validation</h1>
                    <div class = "row gy-4">
                        <div class = "col-12 col-lg-12">
                            <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                <div class = "app-card-header p-3 border-bottom-0">
                                    <div class = "row align-items-center gx-3">
                                        <div class = "col-auto">
                                            <div class = "app-icon-holder">
                                                <i class = "lni lni-dollar"></i>
                                            </div>
                                        </div>
                                        <div class = "col-auto">
                                            <h4 class = "app-card-title">Valider le prix d'achat</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-body px-4 w-100">
                                    @if(empty($details_validation))
                                        <div class="alert alert-warning d-flex align-items-center" role = "alert">
                                            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            <div class = "mx-2">
                                                Aucune validation avec cette identifiant actuellement trouvé.
                                            </div>
                                        </div>
                                    @else
                                        <form class = "settings-form" name = "f-validation-prix-achat2" id = "f-validation-prix-achat2" method = "post" action = "valider-new-prix-article" onsubmit = "validerValidationPrixArticle2()">
                                            @csrf
                                            @if (Session::has('erreur'))
                                                <div class = "alert alert-danger d-flex align-items-center" role = "alert">
                                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                        <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                    <div class = "mx-2">
                                                        {{session()->get('erreur')}}
                                                    </div>
                                                </div>         
                                            @elseif (Session::has('success'))
                                                <div class = "alert alert-success d-flex align-items-center" role = "alert">
                                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                        <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                    <div class = "mx-2">
                                                        {{session()->get('success')}}
                                                    </div>
                                                </div>         
                                            @endif
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Référence</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "number" class = "form-control" id = "reference_article2" name = "reference_article" placeholder = "Entrez la référence de l'article.." value = "{{$details_validation->reference_article}}" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Désignation</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "designation" name = "designation" placeholder = "Entrez la désignation de l'article.." value = "{{$details_validation->designation}}" required readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Ancien prix</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "ancien_prix" name = "ancien_prix" placeholder = "Entrez l'ancien prix d'achat de l'article.." value = "{{\App\Http\Controllers\AchatController::getAncienPrixAchat($details_validation->reference_article)}}" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Nouveau prix</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "new_prix" name = "new_prix_article" placeholder = "Entrez la nouveau prix de l'article.." value = "{{$details_validation->new_prix_article}}"  onkeypress = "return (event.charCode>=46 && event.charCode<=57)" oninput = "effacerErreurPrixArticle2()" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">

                                                    </div>

                                                    <div class = "col-auto col-lg-6">
                                                        <p class = "form-text text-danger mt-2" id = "erreur_prix_achat2"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type = "hidden" class = "form-control" id = "id_validation_prix_article2" name = "id_validation_prix_article" placeholder = "Entrez l'identifiant de validation de prix de l'article.." value = "{{$details_validation->id_validation_prix_article}}" readonly required>
                                            <div class = "item py-3">
                                                <div class = "item-data">
                                                    <button type = "submit" class = "btn app-btn-primary">Valider le prix d'achat</button>
                                                    <a href = "#" type = "button" class = "btn app-btn-info" onclick = "annulerValidationPrixAchat($('#id_validation_prix_article2').val(), $('#reference_article2').val())">Annuler</a>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class = "app-auth-footer app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>