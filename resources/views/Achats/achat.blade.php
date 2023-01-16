<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Achat</title> 
        @include('Layout.head_app')
        <link rel = "stylesheet" href = "{{asset('css/facture.css')}}">
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
			                <h1 class = "app-page-title mb-0">Achats</h1>
				        </div>
                    </div>
                </div>
            </div>
            <livewire:invoice-achat/>
        </div>
        <footer class = "app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>