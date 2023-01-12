<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Emplacement</title> 
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
                            <h1 class = "app-page-title mb-0">Emplacement</h1>
                        </div>
                    </div>
                    <div class = "tab-content" id = "orders-table-tab-content">
                        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
                            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                                <div class = "app-card-body">
                                    <div class = "table-responsive">
                                        <table class = "table table-bordered mb-0 text-left">
                                            <thead>
                                                <tr>
                                                    <th class = "cell">Référence</th>
                                                    <th class = "cell">Désignation</th>
                                                    <th class = "cell">Description</th>
                                                    <th class = "cell">Emplacement</th>
                                                    <th class = "cell">Description</th>
                                                    <th class = "cell">Informations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(empty($details_article))
                                                    <div class="alert alert-warning d-flex align-items-center" role = "alert">
                                                        <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                            <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                        </svg>
                                                        <div class = "mx-2">
                                                            Aucun article avec cette référence actuellement trouvé.
                                                        </div>
                                                    </div>
                                                @else
                                                    <tr>
                                                        <td class = "cell">
                                                            <p>
                                                                {{$details_article->reference_article}}
                                                            </p>
                                                        </td>
                                                        <td class = "cell">
                                                            <p>
                                                                {{$details_article->designation}}
                                                            </p>
                                                        </td>
                                                        <td class = "cell">
                                                            <p>
                                                                {{$details_article->description}}
                                                            </p>
                                                        </td>
                                                        <td class = "cell">
                                                            <p>
                                                                {{$details_article->emplacement_article_creer}}
                                                            </p>
                                                        </td>
                                                        <td class = "cell">
                                                            <p>
                                                                {{$details_article->stock_article_creer}}
                                                            </p>
                                                        </td>
                                                        <td class = "cell">
                                                            <p>
                                                                <a href = "{{url('/article?reference_article='.$details_article->reference_article)}}" class = "btn app-btn-secondary">Plus d'informations</a>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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