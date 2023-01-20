<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Achats</title> 
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
                    <h1 class = "app-page-title">Achats</h1>
                    @if(is_null($reference_facture) || is_null($fournisseurs) || is_null($categories) || is_null($last_reference_article))
                        <div class="alert alert-warning d-flex align-items-center" role = "alert">
                            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div class = "mx-2">
                                Aucune facture d'achat avec cette référence actuellement trouvée.
                            </div>
                        </div>
                    @else
                        <form class = "settings-form" name = "f" id = "f" method = "post" action = "{{url('/creer-articles-facture-achat')}}">
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
                            <div class = "row gy-4">
                                <div class = "col-12 col-lg-6">
                                    <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                        <div class = "app-card-header p-3 border-bottom-0">
                                            <div class = "row align-items-center gx-3">
                                                <div class = "col-auto">
                                                    <div class = "app-icon-holder">
                                                        <i class = "lni lni-customer"></i>
                                                    </div>
                                                </div>
                                                <div class = "col-auto">
                                                    <h4 class = "app-card-title">Fournisseur</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "app-card-body px-4 w-100">
                                            <div class = "item py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-12">
                                                        <div class = "item-label">
                                                            <strong>Nom</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <p>{{$fournisseurs->fullname_fournisseur}}</p>
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
                                                        <i class = "lni lni-control-panel"></i>
                                                    </div>
                                                </div>
                                                <div class = "col-auto">
                                                    <h4 class = "app-card-title">Facture</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "app-card-body px-4 w-100">
                                            <div class = "item py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-12">
                                                        <div class = "item-label">
                                                            <strong>Référence</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <p>{{$reference_facture}}</p>
                                                            <input type = "hidden" value = "{{$reference_facture}}" name = "reference_facture" id = "reference_facture" required>
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
                                        <div class = "app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                                            <div class = "inner">
                                                <div class = "app-card-body p-3 p-lg-4">
                                                    <h6 class = "mb-3">Bonjour, {{auth()->user()->getFullNameUserAttribute()}} !</h6>
                                                    <div class = "row gx-5 gy-3">
                                                        <div class = "col-12 col-lg-12">
                                                            <div>
                                                                Il faut savoir que la dernière référence de l'article enregistrée dans votre base de données est <b>{{$last_reference_article}}</b>. Veuillez tenir compte de cette notification lorsque vous ajoutez un nouvel article à partir de cette interface.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "app-card-body px-4 w-100">
                                            <div class = "item py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>Désignation</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "search" name = "designation" id = "designation" class = "form-control" placeholder = "Désignation.." onkeypress = "return (event.charCode>64 && event.charCode<91) || (event.charCode>96 && event.charCode<123) || (event.charCode == 32) || (event.charCode>=48 && event.charCode<=57)" oninput = "effacerErreurDesignation()" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>Référence</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "search" name = "reference" id = "reference" class = "form-control" placeholder = "Référence.." onkeypress = "return event.charCode>=48 && event.charCode<=57" oninput = "effacerErreurReference()" value = "{{App\Http\Controllers\AchatController::getLastReferenceArticle() + 1}}" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>Catégorie</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <select class = "form-control" name = "categorie" id = "categorie" onchange = "effacerErreurCategorie()" required>
                                                            <option value = "Titre" disabled selected>Catégorie..</option>
                                                            @if(!empty($categories))
                                                                @foreach ($categories as $data)
                                                                    <option value = "{{$data->getNomCategorieAttribute()}}">{{$data->getNomCategorieAttribute()}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>Quantité</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "number" name = "quantite" id = "quantite" class = "form-control" placeholder = "Quantité.." onkeypress = "return event.charCode>=48 && event.charCode<=57" oninput = "effacerErreurQuantite()" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>Prix</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" name = "prix" id = "prix" class = "form-control" placeholder = "Prix.." onkeypress = "return (event.charCode>=46 && event.charCode<=57" oninput = "effacerErreurPrix()" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-1">
                                                        <div class = "item-label">
                                                            <strong>&ensp;</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            DT
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-1">
                                                        <div class = "item-label">
                                                            <strong>&ensp;</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <button type = "button" class = "btn3 app-btn-primary3" id = "button_create_article" name = "button_create_article" onclick = "gestionAjouterDesLignes()">Ajouter</button>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>&ensp;</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input class = "form-control-plaintext text-danger" id = "erreur_designation" style = "display:none; font-size:12px" value = "Designation obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>&ensp;</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input class = "form-control-plaintext text-danger" id = "erreur_reference" style = "display:none; font-size:12px" value = "Référence obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>&ensp;</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input class = "form-control-plaintext text-danger" id = "erreur_categorie" style = "display:none; font-size:12px" value = "Catégorie obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>&ensp;</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input class = "form-control-plaintext text-danger" id = "erreur_quantite" style = "display:none; font-size:12px" value = "Quantité obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
                                                        <div class = "item-label">
                                                            <strong>&ensp;</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input class = "form-control-plaintext text-danger" id = "erreur_prix" style = "display:none; font-size:12px" value = "Prix obligatoire">
                                                            <input class = "form-control-plaintext text-danger" id = "erreur_prix_non_valide" style = "display:none; font-size:12px" value = "Prix non valide">
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-2">
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
                                                    <h4 class = "app-card-title">Achats</h4>
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
                                                                    <th>Catégorie</th>
                                                                    <th>Quantité</th>
                                                                    <th>Prix Unitaire</th>
                                                                    <th>Prix Totale</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id = "body_facture_achat">
                                                                <tr id = "row_vide">
                                                                    <td colspan = "7" class = "text-center">
                                                                        <p>Votre facture d'achat est encore vide.</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <button type = "submit" class = "btn app-btn-primary btn-hover float-end mt-4" id = "button_create_facture_achat" name = "button_create_facture_achat" disabled>Créer une achat</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
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
                searchDesignationAutoComplete();
                searchReferenceAutoComplete();
            });
        </script>
    </body>
</html>