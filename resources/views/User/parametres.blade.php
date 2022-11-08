<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Paramétres</title> 
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
                    <h1 class = "app-page-title">Paramétres</h1>
                    <hr class = "mb-4">
                    <div class = "row g-4 settings-section">
                        <div class = "col-12 col-md-4">
                            <h3 class = "section-title">Compte</h3>
                            <div class = "section-intro">
                                Déterminez l'état de votre compte en modifiant votre disponibilité.
                            </div>
                        </div>
                        <div class = "col-12 col-md-8">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <form class = "settings-form" name = "f1" id = "f1" method = "post" action = "#">
                                        @csrf
                                        @if (Session::has('erreur1'))
                                            <div class = "alert alert-danger d-flex align-items-center" role = "alert">
                                                <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                    <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class = "mx-2">
                                                    {{session()->get('erreur1')}}
                                                </div>
                                            </div>         
                                        @elseif (Session::has('success1'))
                                            <div class = "alert alert-success d-flex align-items-center" role = "alert">
                                                <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                    <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class = "mx-2">
                                                    {{session()->get('success1')}}
                                                </div>
                                            </div>         
                                        @endif
                                        <div class = "mb-2">
                                            <strong>Utilisateur : </strong>
                                            {{auth()->user()->getFullNameUserAttribute()}}
                                        </div>
                                        <div class = "mb-2">
                                            <strong>Session : </strong> 
                                            @if(auth()->user()->getStateUserAttribute() == "Activé")
                                                <span class = "badge bg-success">{{auth()->user()->getStateUserAttribute()}}</span>
                                            @else
                                                <span class = "badge bg-danger">{{auth()->user()->getStateUserAttribute()}}</span>
                                            @endif
                                        </div>
                                        <div class = "mb-2">
                                            <strong>Date d'expiration : </strong>
                                            Non défini
                                        </div>
                                        <div class = "row justify-content-between">
                                            <div class = "col-auto">
                                                @if(auth()->user()->getStateUserAttribute() == "Activé")
								                    <a class = "btn app-btn-primary" href = "{{url('/update-state?resp=Desactivé')}}">Désactiver</a>
                                                @else
                                                    <a class = "btn app-btn-primary" href = "{{url('/update-state?resp=Activé')}}">Activer</a>
                                                @endif
								            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class = "mb-4">
                    <div class = "row g-4 settings-section">
                        <div class = "col-12 col-md-4">
                            <h3 class = "section-title">Adresse e-mail</h3>
                            <div class = "section-intro">
                                Modifier votre adresse e-mail en suivant le lien ci-dessous.
                            </div>
                        </div>
                        <div class = "col-12 col-md-8">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <form class = "settings-form" name = "f2" id = "f2" method = "post" action = "#">
                                        <div class = "mb-2">
                                            <strong>Adresse e-mail : </strong>
                                            <input type = "email" class = "form-control" id = "new_email" name = "new_email" placeholder = "Entrez votre nouvelle adresse email.." value = "{{auth()->user()->getEmailUserAttribute()}}" disabled required>
                                        </div>
                                        <div class = "row justify-content-between">
                                            <div class = "col-auto">
                                                @if(auth()->user()->getTypeUserAttribute() == "Administrateur")
                                                    <p class = "text-danger my-1">Vous n'êtes pas autorisé à modifier votre adresse e-mail.</p>
                                                @else
                                                    <a href = "{{url('/edit-email')}}" class = "btn app-btn-primary2">Modifier</a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class = "mb-4">
                    <div class = "row g-4 settings-section">
                        <div class = "col-12 col-md-4">
                            <h3 class = "section-title">Mot de passe</h3>
                            <div class = "section-intro">
                                Gérez votre mot de passe enregistrée dans l'application web.
                            </div>
                        </div>
                        <div class = "col-12 col-md-8">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <form class = "settings-form" name = "f3" id = "f3" method = "post" action = "#">
                                        <div class = "mb-2">
                                            <strong>Mot de passe : </strong>
                                            <input type = "password" class = "form-control" id = "new_password" name = "new_password" placeholder = "Entrez votre nouvelle mot de passe.." value = "{{auth()->user()->getPasswordUserAttribute()}}" disabled required>
                                        </div>
                                        <div class = "row justify-content-between">
                                            <div class = "col-auto">
                                                <p class = "my-1">Mot de passe crypté.</p>
                                                <a href = "{{url('/edit-password')}}" class = "btn app-btn-primary2">Modifier</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class = "app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>