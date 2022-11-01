<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Accueil</title> 
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
                    <h1 class = "app-page-title">Stock</h1>
                    <div class = "app-card shadow-sm mb-4 border-left-decoration">
                        <div class = "inner">
                            <div class = "app-card-body p-4">
                                <div class = "row gx-5 gy-3">
                                    <div class = "col-12 col-lg-12">
                                        <div>
                                            Grâce à cette fonctionnalité, vous pouvez importer une liste d'articles enregistrés au préalable dans un fichier excel. Notez bien que vous ne pouvez importer ce fichier Excel qu'une seule fois. Si une liste est déjà importée, vous en serez averti dans cette interface.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "row g-4 mb-4">
                        <div class = "col-12 col-lg-12">
                            <div class = "app-card app-card-chart h-100 shadow-sm">
                                <div class = "app-card-header p-3 border-0">
						            <h4 class = "app-card-title">Importation</h4>
					            </div>
                                <div class = "app-card-body p-4">	
                                    <form class = "settings-form" name = "f" id = "f" method = "post" action = "#" enctype = "multipart/form-data">
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
                                        @if($etat->getEtatImportationArticleAttribute() == 0)
                                            <div class = "item py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-12">
                                                        <div class = "item-label">
                                                            <strong>Articles</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "file" class = "form-control" id = "stock" name = "stock" accept = ".xlsx, .xls, .csv" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class = "form-text text-danger">Seuls les fichiers excel sont autorisés *</p>
                                            </div>
                                            <div class = "item py-3">
                                                <div class = "item-data">
                                                    <button type = "submit" class = "btn app-btn-primary">Créer un nouveau stock</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class = "item py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-12">
                                                        <div class = "item-label">
                                                            <strong>Articles</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "file" class = "form-control" id = "stock" name = "stock" accept = ".xlsx, .xls, .csv" required disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class = "form-text text-danger">Une autre liste d'articles est déjà importée *</p>
                                            </div>
                                            <div class = "item py-3">
                                                <div class = "item-data">
                                                    <button type = "submit" class = "btn app-btn-primary" disabled>Créer un nouveau stock</button>
                                                </div>
                                            </div>
                                        @endif
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