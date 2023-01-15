<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Validations</title> 
        @include('Layout.head_app')
        <link rel = "stylesheet" href = "{{asset('css/pagination.css')}}">
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
			                <h1 class = "app-page-title mb-0">Validations</h1>
				        </div>
                    </div>
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
                    @if(!empty($liste_validations_prix_achats) && ($liste_validations_prix_achats->count()))
                        @foreach($liste_validations_prix_achats as $data)
                            <div class = "app-card app-card-notification shadow-sm mb-4">
                                <div class = "app-card-header px-4 py-3">
                                    <div class = "row g-3 align-items-center">
                                        <div class = "col-12 col-lg-auto text-center text-lg-start">
                                            <div class = "app-icon-holder icon-holder-mono">
                                                <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-receipt" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
	                                                <path fill-rule = "evenodd" d = "M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
	                                                <path fill-rule = "evenodd" d = "M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
	                                            </svg>
                                            </div>
                                        </div>
                                        <div class = "col-12 col-lg-auto text-center text-lg-start">
                                            <div class = "notification-type mb-2">
                                                <span class = "badge bg-secondary">Prix d'achat</span>
                                            </div>
                                            <h4 class = "notification-title mb-1">Validation de nouveau prix d'achat</h4>
                                            <ul class = "notification-meta list-inline mb-0">
							                    <li class = "list-inline-item">{{App\Http\Controllers\DemandeModificationTypeController::getDifferenceDate($data->date_validation_new_prix_article)}}</li>
							                    <li class = "list-inline-item">|</li>
							                    <li class = "list-inline-item">Système</li>
						                    </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-body p-4">
                                    <div class = "notification-content">
                                        Bonjour {{auth()->user()->getFullNameUserAttribute()}} ! Vous avez une nouvelle modification de prix d'achat pour une facture référencié par <b>{{$data->reference_facture}}</b>. Cette validation est nécessaire pour l'article <b>{{$data->designation}}</b> référencié par <b>{{$data->reference_article}}</b>.
                                    </div>
                                </div>
                                <div class = "app-card-footer px-4 py-3">
                                    <a class = "action-link" href = "{{url('/valider-prix-article?id_validation='.$data->id_validation_prix_article)}}">
                                        Valider le prix
                                        <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-arrow-right ms-2" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
                                            <path fill-rule = "evenodd" d = "M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning d-flex align-items-center" role = "alert">
                            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div class = "mx-2">
                                Aucune validation de prix d'achat actuellement trouvée.
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