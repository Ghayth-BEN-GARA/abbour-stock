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
                    <form class = "settings-form" name = "f" id = "f" method = "post" action = "{{url('/creer-facture-achat')}}" onsubmit = "validerCreerFacture()">
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
                                                        <select class = "form-control" name = "nom_fournisseur" id = "nom_fournisseur" onchange = "effacerErreurFournisseur()" required>
                                                            <option value = "Titre" disabled selected>Sélectionnez le fournisseur..</option>
                                                            @if(!empty($fournisseurs))
                                                                @foreach ($fournisseurs as $data)
                                                                    <option value = "{{$data->getMatriculeFournisseurAttribute()}}">{{$data->getFullNameFournisseurAttribute()}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type = "hidden" placeholder = "Saisissez la matricule de fournisseur.." id = "matricule" name = "matricule" required />
                                        <p class = "form-text text-danger" id = "erreur_matricule_fournisseur"></p>
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
                                                <h4 class = "app-card-title">Date et heure</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "item-label">
                                                        <strong>Date</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "date" class = "form-control" name = "date" id = "date" placeholder = "Entrez la date de la facture d'achat.." required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "item-label">
                                                        <strong>Heure</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "time" class = "form-control" name = "heure" id = "heure" placeholder = "Entrez l'heure de la facture d'achat.." required>
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
                                                    <i class = "lni lni-cart"></i>
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
                                                        <input type = "text" class = "form-control" name = "reference_facture" id = "reference_facture" placeholder = "Entrez la référence de la facture d'achat.." required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "item-label">
                                                        <strong>Type</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <select class = "form-control" name = "type" id = "type" onchange = "effacerErreurType()" required>
                                                            <option value = "Titre" disabled selected>Sélectionnez le type de facture..</option>
                                                            <option value = "BL">BL</option>
                                                            <option value = "FACT">FACT</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class = "form-text text-danger" id = "erreur_type_facture"></p>
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
                                                <h4 class = "app-card-title">Paiement</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "container row item-label">
                                                        <div class = "form-check mb-3 col-lg-6">
                                                            <input class = "form-check-input" type = "radio" value = "Totale" id = "totale" name = "paiement" onclick = "disableInputMontant()" checked/>
                                                            <strong class = "form-check-label">Totale</strong>
                                                        </div>
                                                        <div class = "form-check mb-3 col-lg-6">
                                                            <input class = "form-check-input" type = "radio" value = "Tranche" id = "tranche" name = "paiement" onclick = "enableInputMontant()"/>
                                                            <strong class = "form-check-label">Tranche</strong>
                                                        </div>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "text" class = "form-control" name = "montant" id = "montant" placeholder = "Entrez le montant de la facture d'achat.." onkeypress = "return (event.charCode>=46 && event.charCode<=57)" oninput = "effacerErreurMontant()" disabled required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class = "form-text text-danger" id = "erreur_paiement_facture"></p>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 col-lg-6">
                                <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                    <div class = "app-card-header p-3 border-bottom-0">
                                        <div class = "row align-items-center gx-3">
                                            <div class = "col-auto">
                                                <div class = "app-icon-holder">
                                                    <i class = "lni lni-user"></i>
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
                                                    <div class = "item-label">
                                                        <strong>Client</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "text" class = "form-control" name = "client" id = "client" placeholder = "Entrez le client de la facture d'achat.." value = "Mhamed Abbour" required disabled>
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
                                                    <i class = "lni lni-users"></i>
                                                </div>
                                            </div>
                                            <div class = "col-auto">
                                                <h4 class = "app-card-title">Responsable</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "app-card-body px-4 w-100">
                                        <div class = "item py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-auto col-lg-12">
                                                    <div class = "item-label">
                                                        <strong>Responsable</strong>
                                                    </div>
                                                    <div class = "item-data">
                                                        <input type = "text" class = "form-control" name = "responsable" id = "responsable" placeholder = "Entrez la responsable de la facture d'achat.." required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "item py-3">
                                <div class = "item-data">
                                    <button type = "submit" class = "btn app-btn-primary">Créer une nouvelle facture d'achat</button>
                                    <button type = "reset" class = "btn app-btn-info">Annuler</button>
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
        <script src = "{{asset('js/jquery.js')}}"></script> 
    </body>
</html>