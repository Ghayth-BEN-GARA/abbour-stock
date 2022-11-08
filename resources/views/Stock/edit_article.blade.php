<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Article</title> 
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
                    <h1 class = "app-page-title">Article</h1>
                    <div class = "row gy-4">
                        <div class = "col-12 col-lg-12">
                            <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                <div class = "app-card-header p-3 border-bottom-0">
                                    <div class = "row align-items-center gx-3">
                                        <div class = "col-auto">
                                            <div class = "app-icon-holder">
                                                <i class = "lni lni-layers"></i>
                                            </div>
                                        </div>
                                        <div class = "col-auto">
                                            <h4 class = "app-card-title">Modifier l'article</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-body px-4 w-100">
                                    @if(empty($article))
                                        <div class="alert alert-warning d-flex align-items-center" role = "alert">
                                            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            <div class = "mx-2">
                                                Aucun article avec cette référence actuellement trouvé.
                                            </div>
                                        </div>
                                    @else
                                        <div class = "alert alert-warning d-flex align-items-center" role = "alert">
                                            <div class = "mx-3">
                                                <h5 class = "text-bold">Note :</h5>
                                                <p class = "text-sm text-gray">
                                                    Un article nommé <b>{{$article->designation}}</b> identifié par le référence <b>{{$article->getReferenceArticleAttribute()}}</b> est enregistré en stock prêt à être modifier. En effet, la derniére référence enregistré est <b>{{$last_reference}}</b>.
                                                </p>
                                            </div>
                                        </div>
                                        <form class = "settings-form" name = "f2" id = "f2" method = "post" action = "{{url('/update-article')}}" onsubmit = "validerPrixMarge()">
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
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Référence</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "number" class = "form-control" id = "reference" name = "reference" placeholder = "Entrez la référence d'article.." value = "{{$article->getReferenceArticleAttribute()}}" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Désignation</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "designation" name = "designation" placeholder = "Entrez la désignation d'article.." value = "{{$article->designation}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Description</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "description" name = "description" placeholder = "Entrez la description d'article.." value = "{{$article->description}}" required>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Catégorie</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <select name = "categorie" id = "categorie" class = "form-control" required>
                                                                <option value = "Titre" disabled>Sélectionnez la catégorie d'article</option>
                                                                @if(empty($categories))
                                                                    <option value = "Aucun">Aucun</option>
                                                                @else
                                                                    @foreach($categories as $data)
                                                                        <option value = "{{$data->getNomCategorieAttribute()}}" <?php echo isset($article['categorie']) && $article['categorie'] == $data['nom_categorie'] ? 'selected' : '' ?>>{{$data->getNomCategorieAttribute()}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Date de création</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control-plaintext text-capitalize" id = "date_creation" name = "date_creation" placeholder = "Entrez la date de création d'article.." value = "<?php setlocale (LC_TIME, 'fr_FR.utf8','fra'); echo strftime("%A %d %B %Y",strtotime(strftime($article['date_creation_article'])))?>" required disabled>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Quantité</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "number" class = "form-control" id = "quantite" name = "quantite" placeholder = "Entrez la quantité d'article.." value = "{{$article->getQuantiteStockAttribute()}}" required disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item border-bottom py-3">
                                                <div class = "row justify-content-between align-items-center">
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Prix d'achat (DT)</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "prix_achat" name = "prix_achat" placeholder = "Entrez le prix d'achat d'article.." value = "{{str_replace( ',', '', $article->getPrixAchatArticleAttribute())}}" onkeypress = "return (event.charCode>=46 && event.charCode<=57)" required>
                                                            <p class = "form-text text-danger" id = "erreur_prix"></p>
                                                        </div>
                                                    </div>
                                                    <div class = "col-auto col-lg-6">
                                                        <div class = "item-label">
                                                            <strong>Marge (%)</strong>
                                                        </div>
                                                        <div class = "item-data">
                                                            <input type = "text" class = "form-control" id = "marge" name = "marge" placeholder = "Entrez la marge d'article.." value = "{{number_format($article->getMargePrixAttribute(),2)}}" onkeypress = "return (event.charCode>=46 && event.charCode<=57)" required>
                                                            <p class = "form-text text-danger" id = "erreur_marge"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "item py-3">
                                                <div class = "item-data">
                                                    <button type = "submit" class = "btn app-btn-primary">Modifier cet article</button>
                                                    <button type = "reset" class = "btn app-btn-info">Annuler</button>
                                                </div>
                                            </div> 
                                        </form>
                                    @endif
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