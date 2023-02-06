<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Réglement</title> 
        @include('Layout.head_app')
        <link rel = "stylesheet" href = "{{asset('css/reglement.css')}}">
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
                            <h1 class = "app-page-title mb-0">Réglement</h1>
                        </div>
                    </div>
                    @if(empty($client))
                        <div class = "alert alert-warning d-flex align-items-center" role = "alert">
                            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div class = "mx-2">
                                Aucun réglement avec cette matricule actuellement trouvé.
                            </div>
                        </div>
                    @else
                        <div class = "all_page p-2">
                            <div class = "main-wrapper">
                                <div class = "main-content">
                                    <div class = "list-card">
                                        <div class = "item active">
                                            <div class = "top">
                                                <div class = "icon -left">
                                                    <img src = "{{asset('/images/logo-white1.svg')}}" alt = "Photo de logo1">
                                                </div>
                                            </div>
                                            <div class = "info">
                                                <div class = "card-info">
                                                    <div class = "text">Matricule</div>
                                                    <div class = "number">{{$client->getMatriculeClientAttribute()}}</div>
                                                </div>
                                                <div class = "icon -right">
                                                    <img src = "{{asset('/images/logo-white3.svg')}}" alt = "Photo de logo3">
                                                </div> 
                                            </div>
                                            <div class = "card-bottom">
                                                <div class = "name">{{$client->getPrenomClientAttribute()}} {{$client->getNomClientAttribute()}}</div>
                                                <div class = "date">
                                                    <div class = "key">Crée Le</div>
                                                    <div class = "number text-capitalize">
                                                        <?php
                                                            setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                            echo strftime("%A %d %B %Y",strtotime(strftime($client->getDateCreationClientAttribute())))  
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item">
                                            <div class = "top">
                                                <div class = "icon -left">
                                                    <img src = "{{asset('/images/logo1.svg')}}" alt = "Photo de logo3">
                                                </div>
                                            </div>
                                            <div class = "info">
                                                <div class = "card-info">
                                                    <div class = "text">Idnetifiant</div>
                                                    <div class = "number">1</div>
                                                </div>
                                                <div class = "icon -right">
                                                    <img src = "{{asset('/images/chip.svg')}}" alt = "Photo de chip">
                                                </div>
                                            </div>
                                            <div class = "card-bottom">
                                                <div class = "name">Mhamed Abbour</div>
                                                <div class = "date">
                                                    <div class = "key">Crée Le</div>
                                                    <div class = "value text-capitalize">
                                                        <?php
                                                            setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                            echo strftime("%A %d %B %Y",strtotime(strftime(auth()->user()->getDateCreationUserAttribute())))  
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "col-md-12 grid-margin transparent mt-4">
                                        <div class = "row">
                                            <div class = "col-md-4 mb-4 stretch-card transparent">
                                                <div class = "card card-tale">
                                                    <div class = "card-body">
                                                        <p class = "mb-1 h5 text-white">Somme</p>
                                                        <p class = "fs-30 mb-3">{{number_format($somme_reglement, 3)}} DT</p>
                                                        <p class = "text-capitalize mb-0">
                                                            <?php
                                                                setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                                echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($dernier_date_reglement))))  
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "col-md-4 mb-4 stretch-card transparent">
                                                <div class = "card card-dark-blue">
                                                    <div class = "card-body">
                                                        <p class = "mb-1 h5 text-white">Payé</p>
                                                        <p class = "fs-30 mb-3">{{number_format($account_reglement, 3)}} DT</p>
                                                        <p class = "text-capitalize mb-0">
                                                            <?php
                                                                setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                                echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($dernier_date_reglement))))  
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class = "col-md-4 mb-4 stretch-card transparent">
                                                <div class = "card card-light-blue">
                                                    <div class = "card-body">
                                                        <p class = "mb-1 h5 text-white">Crédit</p>
                                                        <p class = "fs-30 mb-3">{{number_format($somme_reglement - $account_reglement, 3)}} DT</p>
                                                        <p class = "text-capitalize mb-0">
                                                            <?php
                                                                setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                                echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($dernier_date_reglement))))  
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @livewire('liste-reglements-ventes-clients', ['matricule_client' => $client->matricule_client]) 
                                </div>
                                <div class = "main-sidebar">
                                    <div class = "box">
                                        <div class = "user">
                                            <div class = "avatar">
                                                <img src = "{{URL::asset('images/user.png')}}" alt = "Photo de profil">
                                            </div>
                                            <div class = "name">{{$client->getPrenomClientAttribute()}} {{$client->getNomClientAttribute()}}</div>
                                            <div class = "date text-desc">{{$client->getMatriculeClientAttribute()}}</div>
                                        </div>
                                        <div class = "divider-gray"></div>
                                        <div class = "card-info-box">
                                            <div class = "text-desc">Somme</div>
                                            <div class = "number">{{number_format($somme_reglement, 3)}} DT</div>
                                            <div class = "text-desc">Payé {{number_format($account_reglement, 3)}} DT</div>
                                        </div>
                                        <div class = "divider-gray"></div>
                                        <div class = "box-billing-plan">
                                            <div class = "head">
                                                <div class = "text-desc">Résumé</div>
                                                <div class = "title">Abbour'Stock Dépôt</div>
                                            </div>
                                            <div class = "note-box">
                                                <div class = "inner">
                                                    <div class = "icon ap lni lni-information"></div>
                                                    <div class = "text-content">
                                                        <p>   {{$nbr_reglement}} réglement(s) facture et libre créé</p>
                                                        <p class = "text-capitalize">   Debut :
                                                            <?php
                                                                setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                                echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($date_debut_reglement))))  
                                                            ?>
                                                        </p>
                                                        <p class = "text-capitalize">    Fin :
                                                            <?php
                                                                setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                                echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($dernier_date_reglement))))  
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <footer class = "app-auth-footer app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>