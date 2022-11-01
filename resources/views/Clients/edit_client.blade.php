<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Client</title> 
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
                    <h1 class = "app-page-title">Client</h1>
                    <div class = "row gy-4">
                        <div class = "col-12 col-lg-12">
                            <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                <div class = "app-card-header p-3 border-bottom-0">
                                    <div class = "row align-items-center gx-3">
                                        <div class = "col-auto">
                                            <div class = "app-icon-holder">
                                                <i class = "lni lni-network"></i>
                                            </div>
                                        </div>
                                        <div class = "col-auto">
                                            <h4 class = "app-card-title">Modifier le client</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-body px-4 w-100">
                                    @if(empty($client))
                                        <div class="alert alert-warning d-flex align-items-center" role = "alert">
                                            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            <div class = "mx-2">
                                                Aucun client avec cette matricule actuellement trouvé.
                                            </div>
                                        </div>
                                    @else
                                        <form class = "settings-form" name = "f" id = "f" method = "post" action = "{{url('/modifier-client')}}">
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
                                                            <strong>Nom</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "nom" name = "nom" placeholder = "Entrez le nom de client.." value = "{{$client->getNomClientAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Prénom</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "prenom" name = "prenom" placeholder = "Entrez le prénom de client.." value = "{{$client->getPrenomClientAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Matricule </strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "matricule" name = "matricule" placeholder = "Entrez la matricule de client.." value = "{{$client->getMatriculeClientAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Adresse email</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "email" class = "form-control" id = "email" name = "email" placeholder = "Entrez l'adresse email de client.." value = "{{$client->getEmailClientAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Adresse</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "adresse" name = "adresse" placeholder = "Entrez l'adresse de client.." value = "{{$client->getAdresseClientAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Numéro mobile</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "phone" class = "form-control" id = "mobile" name = "mobile" placeholder = "Entrez le numéro mobile de client.." value = "{{$client->getMobileClientAttribute()}}" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                            <input type = "hidden" name = "matricule_client" id = "matricule_client" value = "{{$_GET['matricule_client']}}">
                                            <div class = "item py-3">
                                                <div class = "item-data">
                                                    <button type = "submit" class = "btn app-btn-primary">Modifier ce client</button>
                                                    <button type = "reset" class = "btn app-btn-info">Annuler</button>
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