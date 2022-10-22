<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Adresse e-mail</title> 
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
                    <h1 class = "app-page-title">Paramètres</h1>
                    <hr class = "mb-4">
                    <div class = "row g-4 settings-section">
                        <div class = "col-12 col-md-4">
                            <h3 class = "section-title">Adresse email</h3>
                            <div class = "section-intro">
                                Modifiez votre adresse e-mail enregistrée dans l'application Abbour'Stock Dépôt pour vous connecter rapidement.
                            </div>
                        </div>
                        <div class = "col-12 col-md-8">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <form class = "settings-form" name = "f" id = "f" method = "post" action = "{{url('/update-email')}}">
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
                                                Nouvelle adresse email
                                                <span class = "ms-2" data-container = "body" data-bs-toggle = "popover" data-trigger = "hover" data-placement = "top">
                                                    <i class = "lni lni-envelope"></i>
                                                </span>
                                            </label>
                                            <input type = "email" class = "form-control" id = "new_email" name = "new_email" placeholder = "Entrez votre nouvelle adresse email.." value = "{{auth()->user()->getEmailUserAttribute()}}" required>
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
        <footer class = "app-auth-footer">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>