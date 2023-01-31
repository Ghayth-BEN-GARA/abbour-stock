<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Caisse</title> 
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
                    <h1 class = "app-page-title">Caisse</h1>
                    <form class = "settings-form" name = "f-creer-facture-vente" id = "f-creer-facture-vente" method = "post" action = "{{url('/creer-facture-vente')}}" onsubmit = "validerFormulaireCreerFactureVente()">
                        @csrf
                        <div class = "row gy-4">
                            <div class = "col-12 col-lg-6">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-network"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Client</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "container row item-label">
                                                        <div class = "form-check mb-3 col-lg-6">
                                                            <input class = "form-check-input" type = "radio" value = "Passager" id = "passager" name = "type_client" onclick = "disableSelectClient()" checked/>
                                                            <strong class = "form-check-label">Passager</strong>
                                                        </div>
                                                        <div class = "form-check mb-3 col-lg-6">
                                                            <input class = "form-check-input" type = "radio" value = "Client" id = "client" name = "type_client" onclick = "enableSelectClient()"/>
                                                            <strong class = "form-check-label">Client</strong>
                                                        </div>
                                                    </div>
                                                    <div class = "item-data">
                                                        <select class = "form-control" name = "nom_client" id = "nom_client" onchange = "effacerErreurClient()" disabled required>
                                                            <option value = "Titre" disabled selected>Sélectionnez le client..</option>
                                                            @if(!empty($liste_clients))
                                                                @foreach ($liste_clients as $data)
                                                                    <option value = "{{$data->getMatriculeClientAttribute()}}">{{$data->getFullNameClientAttribute()}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class = "form-text text-danger" id = "erreur_client"></p>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 col-lg-6">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-credit-cards"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Livraison</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "container row item-label">
                                                        <div class = "form-check mb-3 col-lg-6">
                                                            <input class = "form-check-input" type = "radio" value = "Livré" id = "livre" name = "livraison" onclick = "disableMontantAccount()" checked/>
                                                            <strong class = "form-check-label">Livré</strong>
                                                        </div>
                                                        <div class = "form-check mb-3 col-lg-6">
                                                            <input class = "form-check-input" type = "radio" value = "Non Livré" id = "non_livre" name = "livraison" onclick = "enableMontantAccount()"/>
                                                            <strong class = "form-check-label">Non Livré</strong>
                                                        </div>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "text" class = "form-control" name = "montant_account_prix" id = "montant_account_prix" placeholder = "Entrez le montant payé.." onkeypress = "return (event.charCode>=46 && event.charCode<=57)" oninput = "effacerErreurMontantAccount()" value = "Montant" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class = "form-text text-danger" id = "erreur_montant_account"></p>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 col-lg-6">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-calendar"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Date</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "item-label">
                                                        <strong>Date De Vente</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "date" class = "form-control" name = "date" id = "date" placeholder = "Entrez la date de la vente.." value = "{{date('Y-m-d')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 col-lg-6">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-alarm-clock"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Heure</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "item-label">
                                                        <strong>Heure De Vente</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "time" class = "form-control" name = "heure" id = "heure" placeholder = "Entrez l'heure de la vente.." value = "{{date('h:i:s')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 col-lg-6">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-tag"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Remise</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "container row item-label">
                                                        <div class = "form-check mb-3 col-lg-6">
                                                            <input class = "form-check-input" type = "radio" value = "Remise Totale" id = "totale" name = "type_remise" onclick = "enableMontantRemise()" checked/>
                                                            <strong class = "form-check-label">Totale</strong>
                                                        </div>
                                                        <div class = "form-check mb-3 col-lg-6">
                                                            <input class = "form-check-input" type = "radio" value = "Remise Par Article" id = "par_article" name = "type_remise" onclick = "disableMontantRemise()"/>
                                                            <strong class = "form-check-label">Par Article</strong>
                                                        </div>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "text" class = "form-control" name = "montant_remise" id = "montant_remise" placeholder = "Entrez le remise.." onkeypress = "return (event.charCode>=48 && event.charCode<=57)" oninput = "effacerErreurMontantRemise()" value = "Remise" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class = "form-text text-danger" id = "erreur_montant_remise"></p>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 col-lg-6">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-apartment"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Société</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "item-label">
                                                        <strong>Société De Vente</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "text" class = "form-control mt-3" name = "societe" id = "societe" placeholder = "Entrez la société de vente.." value = "Abbour'Stock Dépôt" disabled required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 col-lg-12">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-bullhorn"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Article</h4>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>Référence</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "search" name = "reference_article_vente" id = "reference_article_vente" class = "form-control" placeholder = "Référence.." onkeypress = "return event.charCode>=48 && event.charCode<=57" oninput = "effacerErreurReferenceArticleVente()" value = "Référence" required>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>Désignation</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "search" name = "designation_article_vente" id = "designation_article_vente" class = "form-control" placeholder = "Désignation.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32) || (event.charCode>=48 && event.charCode<=57)" value = "Désignation" readonly required>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>Quantité</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "number" name = "quantite_article_vente" id = "quantite_article_vente" class = "form-control" placeholder = "Quantité.." onkeypress = "return event.charCode>=48 && event.charCode<=57" value = "0" oninput = "effacerErreurQuantiteArticleVente()" required>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>Prix</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "text" name = "prix_article_vente" id = "prix_article_vente" class = "form-control" placeholder = "Prix.." onkeypress = "return (event.charCode>=46 && event.charCode<=57" value = "0.000" readonly required>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>Remise</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "text" name = "remise_article_vente" id = "remise_article_vente" class = "form-control" placeholder = "Prix.." onkeypress = "return (event.charCode>=48 && event.charCode<=57)" value = "0" required oninput = "effacerErreurRemiseArticleVente()">
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-1">
                                                    <div class = "item-label">
                                                        <strong>&ensp;</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <button type = "button" class = "btn3 app-btn-primary3" id = "button_create_article_vente" name = "button_create_article_vente" onclick = "gestionAjouterDesLignesVente()">Ajouter</button>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>&ensp;</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <p class = "text-danger" id = "erreur_reference_article" style = "font-size:12px"></p>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>&ensp;</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <p class = "text-danger" id = "erreur_designation_article" style = "font-size:12px"></p>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>&ensp;</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <p class = "text-danger" id = "erreur_quantite_article" style = "font-size:12px"></p>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>&ensp;</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <p class = "text-danger" id = "erreur_prix_article" style = "font-size:12px"></p>
                                                        <p class = "text-danger" id = "erreur_prix_article_non_valide" style = "font-size:12px"></p>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-2">
                                                    <div class = "item-label">
                                                        <strong>&ensp;</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <p class = "text-danger" id = "erreur_remise_article" style = "font-size:12px"></p>
                                                    </div>
                                                </div>
                                                <div class = "col-auto col-lg-1">
                                                    <div class = "item-label">
                                                        
                                                    </div>
                                                    <div class = "item-data">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 col-lg-12">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-cart"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Ventes</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "table-wrapper table-responsive">
                                                    <table class = "table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Désignation</th>
                                                                <th>Référence</th>
                                                                <th>Quantité</th>
                                                                <th>Prix Unitaire</th>
                                                                <th>Remise</th>
                                                                <th>Prix Totale</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id = "body_facture_vente">
                                                            <tr id = "row_vide">
                                                                <td colspan = "7" class = "text-center">
                                                                    <p>Votre facture de vente est encore vide.</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <button type = "submit" class = "btn app-btn-primary btn-hover float-end mt-4" id = "button_create_facture_vente" name = "button_create_facture_vente" disabled>Créer une vente</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class = "app-auth-footer app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
        <script src = "{{url('js/jquery.js')}}"></script>
        <script src = "{{url('js/typeahead.min.js')}}"></script>
        <script>
            $(function(){
                searchReferenceArticleVenteAutoComplete();
            });
        </script>
    </body>
</html>