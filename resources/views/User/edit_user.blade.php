<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Utilisateur</title> 
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
                    <h1 class = "app-page-title">Utilisateur</h1>
                    <div class = "row gy-4">
                        <div class = "col-12 col-lg-12">
                            <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                <div class = "app-card-header p-3 border-bottom-0">
                                    <div class = "row align-items-center gx-3">
                                        <div class = "col-auto">
                                            <div class = "app-icon-holder">
                                                <i class = "lni lni-user"></i>
                                            </div>
                                        </div>
                                        <div class = "col-auto">
                                            <h4 class = "app-card-title">Modifier l'utilisateur</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-body px-4 w-100">
                                    @if(empty($user))
                                        <div class="alert alert-warning d-flex align-items-center" role = "alert">
                                            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            <div class = "mx-2">
                                                Aucun utilisateur avec cette identification actuellement trouvé.
                                            </div>
                                        </div>
                                    @else
                                        <form class = "settings-form" name = "f" id = "f" method = "post" action = "{{url('/modifier-user')}}">
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
                                                            <input type = "text" class = "form-control" id = "nom" name = "nom" placeholder = "Entrez le nom d'utilisateur.." value = "{{$user->getNomUserAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Prénom</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "prenom" name = "prenom" placeholder = "Entrez le prénom d'utilisateur.." value = "{{$user->getPrenomUserAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Adresse email</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "email" class = "form-control" id = "email" name = "email" placeholder = "Entrez l'adresse email d'utilisateur.." value = "{{$user->getEmailUserAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Numéro de carte d'identité</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "number" class = "form-control" id = "cin" name = "cin" placeholder = "Entrez le numéro de carte d'identité d'utilisateur.." value = "{{$user->getCinUserAttribute()}}" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Genre</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <select name = "genre" id = "genre" class = "form-control" required>
                                                                <option value = "Titre" disabled selected>Sélectionnez le genre d'utilisateur..</option>
                                                                <option value = "Homme" <?php echo $user->getGenreUserAttribute() != null && $user->getGenreUserAttribute() == 'Homme' ? 'selected' : '' ?>>Homme</option>
                                                                <option value = "Femme" <?php echo $user->getGenreUserAttribute() != null && $user->getGenreUserAttribute() == 'Femme' ? 'selected' : '' ?>>Femme</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Date de naissance</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "date" class = "form-control" id = "date_naissance" name = "date_naissance" placeholder = "Entrez la date de naissance d'utilisateur.." value = "{{$user->getNaissanceUserAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Numéro mobile</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "phone" class = "form-control" id = "mobile" name = "mobile" placeholder = "Entrez le numéro mobile d'utilisateur.." value = "{{$user->getMobileUserAttribute()}}" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Adresse</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "adresse" name = "adresse" placeholder = "Entrez l'adresse' d'utilisateur.." value = "{{$user->getAdresseUserAttribute()}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Type de compte</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <select name = "type" id = "type" class = "form-control" required>
                                                                <option value = "Titre" disabled selected>Sélectionnez le type de compte d'utilisateur..</option>
                                                                <option value = "Utilisateur" <?php echo $user->getTypeUserAttribute() != null && $user->getTypeUserAttribute() == 'Utilisateur' ? 'selected' : '' ?>>Utilisateur</option>
                                                                <option value = "Admin" <?php echo $user->getTypeUserAttribute() != null && $user->getTypeUserAttribute() == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type = "hidden" id = "id_user" name = "id_user" value = "{{$_GET['id_user']}}">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>&nbsp;</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <button type = "submit" class = "btn app-btn-primary">Modifier ce compte</button>
                                                            <button type = "reset" class = "btn app-btn-info">Annuler</button>
                                                        </div>
                                                    </div>
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