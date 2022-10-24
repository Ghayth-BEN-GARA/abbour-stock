<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Récupération</title> 
        @include('Layout.head_app')
    </head> 
    <body class = "app app-login p-0">
        <div class = "row g-0 app-auth-wrapper">
            <div class = "col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
                <div class = "d-flex flex-column align-content-end">
                    <div class = "app-auth-body mx-auto">	
                        <div class = "app-auth-branding mb-4">
                            <a class = "app-logo" href = "{{url('/')}}">
                                <img class = "logo-icon me-2" src = "{{asset('images/favicon.png')}}" alt = "Logo de l'application">
                            </a>
                        </div>
                        <div class = "auth-intro mb-4 text-left">
                            Veuillez entrer votre nouveau mot de passe pour terminer le processus de récupération de compte.
                        </div>
                        <div class = "auth-form-container text-start">
                            @if (Session::has('erreur'))
                                <div class="alert alert-danger d-flex align-items-center" role = "alert">
                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                        <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class = "mx-2">
                                        {{session()->get('erreur')}}
                                    </div>
                                </div>         
                            @endif
                            @if($checkToken == false)
                                <div class="alert alert-warning d-flex align-items-center" role = "alert">
                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                        <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class = "mx-2">
                                        Les paramétres ou l'utilisateur connecté n'est pas valide. Vous pouvez utiliser ce <a href = "{{url('/')}}" style = "color:#F7941E">lien</a> pour vous connecter à votre compte.
                                    </div>
                                </div>
                            @else
                                <form class = "auth-form resetpass-form" name = "f" id = "f" action = "{{url('/update-reset-password')}}" method = "post">
                                    @csrf
                                    <div class = "email mb-3">
                                        <label class = "mx-1">Nouveau mot de passe</label>
                                        <input type = "password" name = "new_password" id = "new_password" class = "form-control signin-password" placeholder = "Entrez votre nouveau mot de passe.." required>
                                    </div>
                                    <div class = "password mb-3">
                                        <label class = "mx-1">Confirmation de Mot de passe</label>
                                        <input type = "password" name = "confirm_password" id = "confirm_password" class = "form-control signin-password" placeholder = "Confirmez votre nouveau mot de passe.." required>
                                        <div class = "extra mt-3 row justify-content-between">
                                            <div class = "col-6">
                                                <div class = "forgot-password text-end">
                                                    <a href = "{{url('/')}}">Pas besoin de récupération?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type = "hidden" name = "id_user" id = "id_user" value = "{{$id_user}}" required>
                                    <div class = "text-center">
                                        <button type = "submit" class = "btn app-btn-primary w-100 theme-btn mx-auto">Réinitialiser le mot de passe</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    <footer class = "app-auth-footer">
                        @include('Layout.footer')
                    </footer>
                </div>
            </div>
            <div class = "col-12 col-md-5 col-lg-6 h-100 auth-background-col">
                <div class = "auth-background-holder"></div>
                <div class = "auth-background-mask"></div>
                <div class = "auth-background-overlay p-3 p-lg-5">
                    <div class = "d-flex flex-column align-content-end h-100">
                        <div class = "h-100"></div>
                        <div class = "overlay-content p-3 p-lg-4 rounded">
                            <h5 class = "mb-3 overlay-title">Abbour'Stock Dépôt</h5>
                            <div>
                                Abbour'Stock Dépôt est une application web e-commerce pour la gestion des stocks et des ventes développée avec laravel 9 par <a href = "https://www.facebook.com/profile.php?id=100075317294165">Ghayth Ben Gara</a> en 2022.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Layout.script')
    </body>
</html>