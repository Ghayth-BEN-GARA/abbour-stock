<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Stock</title> 
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
                            <h1 class = "app-page-title mb-0">Stock</h1>
                        </div>
                    </div>
                    <div class = "col-12 col-lg-12 mb-5">
                        <div class = "app-card app-card-settings shadow-sm p-4">
                            <div class = "app-card-body">
                                <p class = "form-text text-dark">Gérez la liste des articles dans le stock enregistrés sur l'application en toute sécurité. Vous pouvez consulter, modifier et rechercher un article existant dans le stock à tout moment.</p>      
                            </div>
                        </div>
                    </div>
                    <livewire:liste-stock/>
                </div>
            </div>
        </div>
        <footer class = "app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>