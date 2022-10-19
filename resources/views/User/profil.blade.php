<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Profil</title> 
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
                    <h1 class = "app-page-title">Mon Compte</h1>
                    <div class = "row gy-4">
                        <div class = "col-12 col-lg-6">
                            <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                <div class = "app-card-header p-3 border-bottom-0">
                                    <div class = "row align-items-center gx-3">
                                        <div class = "col-auto">
                                            <div class = "app-icon-holder">
                                                <i class = "lni lni-user"></i>
                                            </div>
                                        </div>
                                        <div class = "col-auto">
                                            <h4 class = "app-card-title">Profil</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-body px-4 w-100">
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
                                                <div class = "item-label mb-2">
                                                    <strong>Photo</strong>
                                                </div>
                                                <div class = "item-data">
                                                    <img class = "profile-image" src = "{{auth()->user()->getImageUserAttribute()}}" alt = "Photo de profil">
                                                </div>
                                            </div>
                                            <div class = "col text-end">
                                                <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
                                                <div class = "item-label">
                                                    <strong>Nom et prénom</strong>
                                                </div>
                                                <div class = "item-data">
                                                    {{auth()->user()->getFullNameUserAttribute()}}
                                                </div>
                                            </div>
                                            <div class = "col text-end">
										        <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
									        </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
                                                <div class = "item-label">
                                                    <strong>Genre</strong>
                                                </div>
                                                <div class = "item-data">
                                                    {{auth()->user()->getGenreUserAttribute()}}
                                                </div>
                                            </div>
                                            <div class = "col text-end">
										        <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
									        </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
                                                <div class = "item-label">
                                                    <strong>Date de naissance</strong>
                                                </div>
                                                <div class = "item-data text-capitalize">
                                                    <?php
                                                        setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                        echo strftime("%A %d %B %Y",strtotime(strftime(auth()->user()->getNaissanceUserAttribute())))  
                                                    ?>
                                                </div>
                                            </div>
                                            <div class = "col text-end">
										        <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
									        </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
                                                <div class = "item-label">
                                                    <strong>Adresse</strong>
                                                </div>
                                                <div class = "item-data">
                                                    {{auth()->user()->getAdresseUserAttribute()}}
                                                </div>
                                            </div>
                                            <div class = "col text-end">
										        <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
									        </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
                                                <div class = "item-label">
                                                    <strong>Mobile</strong>
                                                </div>
                                                <div class = "item-data">
                                                    (+216) {{auth()->user()->getFormattedMobileUserAttribute()}}
                                                </div>
                                            </div>
                                            <div class = "col text-end">
										        <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
									        </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
                                                <div class = "item-label">
                                                    <strong>Numéro de carte d'identité</strong>
                                                </div>
                                                <div class = "item-data">
                                                    {{auth()->user()->getFormattedCinUserAttribute()}}
                                                </div>
                                            </div>
                                            <div class = "col text-end">
										        <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
									        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-footer p-4 mt-auto">
                                    <a class = "btn app-btn-secondary" href = "#">Gérer le profil</a>
                                </div>
                            </div>
                        </div>
                        <div class = "col-12 col-lg-6">
                            <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                <div class = "app-card-header p-3 border-bottom-0">
                                    <div class = "row align-items-center gx-3">
                                        <div class = "col-auto">
                                            <div class = "app-icon-holder">
                                                <i class = "lni lni-control-panel"></i>
                                            </div>
                                        </div>
                                        <div class = "col-auto">
								            <h4 class = "app-card-title">Préférences</h4>
							            </div>
                                    </div>
                                </div>
                                <div class = "app-card-body px-4 w-100">
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
										        <div class = "item-label">
                                                    <strong>Adresse email</strong>
                                                </div>
									            <div class = "item-data">
                                                    {{auth()->user()->getEmailUserAttribute()}}
                                                </div>
									        </div>
                                            <div class = "col text-end">
                                                @if (session('type') == 'Administrateur')
                                                    <a class = "badge bg-danger" href = "javascript:void(0)">Indisponible</a>
                                                @else
                                                    <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
										        <div class = "item-label">
                                                    <strong>Type de compte</strong>
                                                </div>
									            <div class = "item-data text-capitalize">
                                                    {{auth()->user()->getTypeUserAttribute()}}
                                                </div>
									        </div>
                                            <div class = "col text-end">
                                                @if (session('type') == 'Administrateur')
                                                    <a class = "badge bg-danger" href = "javascript:void(0)">Indisponible</a>
                                                @else
                                                    <a class = "btn-sm app-btn-secondary" href = "#">Modifier</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
										        <div class = "item-label">
                                                    <strong>Mot de passe</strong>
                                                </div>
									            <div class = "item-data">
                                                    Mot de passe crypté en raison de la sécurité du compte
                                                </div>
									        </div>
                                            <div class = "col text-end">
                                                <a class = "btn-sm app-btn-secondary" href = "{{url('/edit-password')}}">Modifier</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = "item border-bottom py-3">
                                        <div class = "row justify-content-between align-items-center">
                                            <div class = "col-auto">
										        <div class = "item-label">
                                                    <strong>Date de création</strong>
                                                </div>
									            <div class = "item-data text-capitalize">
                                                    <?php
                                                        setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                        echo strftime("%A %d %B %Y",strtotime(strftime(auth()->user()->getDateCreationUserAttribute())))  
                                                    ?>
                                                </div>
									        </div>
                                            <div class = "col text-end">
                                                <a class = "badge bg-danger" href = "javascript:void(0)">Indisponible</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-footer p-4 mt-auto">
							        <a class = "btn app-btn-secondary" href = "#">Gérer les préférences</a>
						        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class = "app-auth-footer app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>