<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Réglements</title> 
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
                        <div class = "row g-3 mb-4 align-items-center justify-content-between">
                            <div class = "col-auto">
			                    <h1 class = "app-page-title mb-0">Réglements</h1>
				            </div>
                        </div>
                        <div class = "col-12 col-lg-12 mb-5">
                            <div class = "app-card app-card-settings shadow-sm p-4">
                                <div class = "app-card-body">
                                    <p class = "form-text text-dark">Gérez la liste des réglements enregistrés dans l'application selon les clients en toute sécurité. Vous pouvez consulter, modifier et rechercher un client existant à tout moment.</p>      
                                </div>
                            </div>
                        </div>
                        <livewire:liste-clients-reglements/>
                    </div>
                </div>
            </div>
        <footer class = "app-auth-footer app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>