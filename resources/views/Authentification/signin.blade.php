<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Connexion</title>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <meta name = "description" content = "Abbour'Stock Dépôt - Application web pour la gestion de stock">
        <meta name = "author" content = "Ghayth Ben Gara">    
        <link rel = "shortcut icon" href = "{{asset('images/favicon.png')}}"> 
        <link rel = "stylesheet" href = "{{asset('css/style1.css')}}">
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
                        <h2 class = "auth-heading text-center mb-5">Se connecter à Abbour'Stock Dépôt</h2>
                        <div class = "auth-form-container text-start">
                            <form class = "auth-form login-form" name = "f" id = "f" action = "#" method = "post">
                                @csrf
                                <div class = "email mb-3">
                                    <label class = "mx-1">Adresse email</label>
                                    <input id = "email" name = "email" type = "email" class = "form-control signin-email" placeholder = "Entrez votre adresse email.." required>
                                </div>
                                <div class = "password mb-3">
                                    <label class = "mx-1">Mot de passe</label>
                                    <input id = "password" name = "password" type = "password" class = "form-control signin-password" placeholder = "Entrez votre mot de passe.." required>
                                    <div class = "extra mt-3 row justify-content-between">
                                        <div class = "col-6">
                                            <div class = "form-check">
                                                <input class = "form-check-input" type = "checkbox" value = "" id = "RememberPassword">
                                                <label class = "form-check-label">Souviens-toi de moi</label>
                                            </div>
                                        </div>
                                        <div class = "col-6">
                                            <div class = "forgot-password text-end">
                                                <a href = "#">Mot de passe oublié?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "text-center">
                                    <button type = "submit" class = "btn app-btn-primary w-100 theme-btn mx-auto">Se connecter</button>
                                </div>
                            </form>
                            <div class = "auth-option text-center pt-5">Pas de compte? S'inscrire
                                <a class = "text-link" href = "#" >içi</a>
                                .
                            </div>
                        </div>
                    </div>
                    <footer class = "app-auth-footer">
                        <div class = "container text-center py-3">
                            <small class = "copyright">
                                Développé avec
                                <span class = "sr-only">
                                    love
                                </span>
                                <i class = "fas fa-heart" style = "color: #fb866a;"></i>
                                par
                                <a class = "app-link" href = "https://www.facebook.com/profile.php?id=100075317294165" target = "_blank">Ghayth Ben Gara</a>
                                pour Abbour'Stock Dépôt
                            </small>
                        </div>
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
                                Abbour'Stock Dépôt est une application web e-commerce de gestion des stocks et des ventes développée avec laravel 9 par <a href = "https://www.facebook.com/profile.php?id=100075317294165">Ghayth Ben Gara</a> en 2022.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src = "{{asset('plugins/fontawesome/js/all.min.js')}}"></script>
    </body>
</html>