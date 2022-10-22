<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Préférences</title> 
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
                    <h1 class = "app-page-title">Préférences</h1>
                    <div class = "row gy-4">
                        <div class = "col-12 col-lg-6">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <form class = "settings-form" name = "f-email" id = "f-email" method = "post" action = "{{url('/update-email')}}">
                                        @csrf
                                        @if (Session::has('erreur3'))
                                            <div class = "alert alert-danger d-flex align-items-center" role = "alert">
                                                <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                    <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class = "mx-2">
                                                    {{session()->get('erreur3')}}
                                                </div>
                                            </div>         
                                        @elseif (Session::has('success3'))
                                            <div class = "alert alert-success d-flex align-items-center" role = "alert">
                                                <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                    <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class = "mx-2">
                                                    {{session()->get('success3')}}
                                                </div>
                                            </div>         
                                        @endif
                                        <div class = "mb-3">
                                            <label class = "form-label">
                                                Adresse email
                                                <span class = "ms-2" data-container = "body" data-bs-toggle = "popover" data-trigger = "hover" data-placement = "top">
                                                    <i class = "lni lni-envelope"></i>
                                                </span>
                                            </label>
                                            @if (session('type') == 'Administrateur')
                                                <input type = "email" class = "form-control" id = "new_email" name = "new_email" placeholder = "Entrez votre nouvelle adresse email.." value = "{{auth()->user()->getEmailUserAttribute()}}" required disabled>
                                                <p class = "form-text text-danger">La modification de l'adresse e-mail n'est pas disponible pour l'administrateur</p>
                                            @else
                                                <input type = "email" class = "form-control" id = "new_email" name = "new_email" placeholder = "Entrez votre nouvelle adresse email.." value = "{{auth()->user()->getEmailUserAttribute()}}" required>
                                            @endif
                                        </div>
                                        @if (session('type') == 'Administrateur')
                                            <button type = "submit" class = "btn app-btn-primary" disabled>Modifier</button>
                                        @else
                                            <button type = "submit" class = "btn app-btn-primary" >Modifier</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class = "col-12 col-lg-6">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <form class = "settings-form" name = "f-type" id = "f-type" method = "post" action = "{{url('/update-type-compte-user')}}">
                                        @csrf
                                        @if (Session::has('erreur2'))
                                            <div class = "alert alert-danger d-flex align-items-center" role = "alert">
                                                <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                    <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class = "mx-2">
                                                    {{session()->get('erreur2')}}
                                                </div>
                                            </div>         
                                        @elseif (Session::has('success2'))
                                            <div class = "alert alert-success d-flex align-items-center" role = "alert">
                                                <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                    <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class = "mx-2">
                                                    {{session()->get('success2')}}
                                                </div>
                                            </div>         
                                        @endif
                                        <div class = "mb-3">
                                            <label class = "form-label">
                                                Type de compte
                                                <span class = "ms-2" data-container = "body" data-bs-toggle = "popover" data-trigger = "hover" data-placement = "top">
                                                    <i class = "lni lni-user"></i>
                                                </span>
                                            </label>
                                            @if (session('type') == 'Administrateur')
                                                <input type = "text" class = "form-control" id = "type" name = "type" placeholder = "Entrez votre nouvel type.." value = "{{auth()->user()->getTypeUserAttribute()}}" required disabled>
                                                <p class = "form-text text-danger">La modification de type de compte n'est pas disponible pour l'administrateur</p>
                                            @else
                                                <select name = "new_type" id = "new_type" class = "form-control" required>
                                                    <option value = "Titre" disabled selected>Sélectionnez votre type..</option>
                                                    <option value = "Utilisateur" <?php echo auth()->user()->getTypeUserAttribute() != null && auth()->user()->getTypeUserAttribute() == 'Utilisateur' ? 'selected' : '' ?>>Utilisateur</option>
                                                    <option value = "Admin" <?php echo auth()->user()->getTypeUserAttribute() != null && auth()->user()->getTypeUserAttribute() == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                                </select>
                                            @endif
                                        </div>
                                        @if (session('type') == 'Administrateur')
                                            <button type = "submit" class = "btn app-btn-primary" disabled>Modifier</button>
                                        @else
                                            <button type = "submit" class = "btn app-btn-primary">Modifier</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class = "col-12 col-lg-6">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <form class = "settings-form" name = "f-date" id = "f-date" method = "post" action = "#">
                                        <div class = "mb-3">
                                            <label class = "form-label">
                                                Date de création de compte
                                                <span class = "ms-2" data-container = "body" data-bs-toggle = "popover" data-trigger = "hover" data-placement = "top">
                                                    <i class = "lni lni-agenda"></i>
                                                </span>
                                            </label>
                                            <input type = "text" class = "form-control-plaintext text-capitalize" id = "type" name = "type" placeholder = "Entrez votre nouvel type.."
                                                value = "<?php
                                                            setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                            echo strftime("%A %d %B %Y",strtotime(strftime(auth()->user()->getDateCreationUserAttribute())))  
                                                        ?>" 
                                                required disabled>
                                        </div>
                                        <p class = "form-text text-danger">La modification de date de création de compte n'est pas disponible pour aucune personne</p>
                                        <button type = "submit" class = "btn app-btn-primary" disabled>Modifier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class = "col-12 col-lg-6">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <form class = "settings-form" name = "f-password" id = "f-password" method = "post" action = "{{url('/update-password')}}">
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
                                        <div class = "mb-3">
                                            <label class = "form-label">
                                                Nouveau mot de passe
                                                <span class = "ms-2" data-container = "body" data-bs-toggle = "popover" data-trigger = "hover" data-placement = "top">
                                                    <i class = "lni lni-lock"></i>
                                                </span>
                                            </label>
                                            <input type = "password" class = "form-control" id = "new_password" name = "new_password" placeholder = "Entrez votre nouveau mot de passe.." required>
                                        </div>
                                        <div class = "mb-3">
                                            <label class = "form-label">
                                                Confirmation de mot de passe
                                                <span class = "ms-2" data-container = "body" data-bs-toggle = "popover" data-trigger = "hover" data-placement = "top">
                                                    <i class = "lni lni-lock"></i>
                                                </span>
                                            </label>
                                            <input type = "password" class = "form-control" id = "confirm_new_password" name = "confirm_new_password" placeholder = "Confirmez votre nouveau mot de passe.." required>
                                        </div>
                                        <button type = "submit" class = "btn app-btn-primary">Modifier</button>
                                    </form>
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