<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Utilisateurs</title> 
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
			                <h1 class = "app-page-title mb-0">Utilisateurs</h1>
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
                    @if(!empty($liste_new_users) && ($liste_new_users->count()))
                        @foreach($liste_new_users as $data)
                            <div class = "app-card app-card-notification shadow-sm mb-4">
                                <div class = "app-card-header px-4 py-3">
                                    <div class = "row g-3 align-items-center">
                                        <div class = "col-12 col-lg-auto text-center text-lg-start">						        
				                            <img class = "profile-image" src = "{{URL::asset('/images/user.png')}}" alt = "Photo de profil">
					                    </div>
                                        <div class = "col-12 col-lg-auto text-center text-lg-start">
                                            <div class = "notification-type mb-2">
                                                <span class = "badge bg-info">En attente</span>
                                            </div>
                                            <h4 class = "notification-title mb-1 text-capitalize">Demande d'un utilisateur</h4>
                                            <ul class = "notification-meta list-inline mb-0">
                                                <li class = "list-inline-item">{{App\Http\Controllers\DemandeModificationTypeController::getDifferenceDate($data->getDateCreationUserAttribute())}}</li>
                                                <li class = "list-inline-item">|</li>
                                                <li class = "list-inline-item">{{$data->prenom}} {{$data->nom}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-body p-4">
                                    <div class = "notification-content">
                                        L'utilisateur {{$data->prenom}} {{$data->nom}} vous a envoyé une demande d'un nouveau utilisateur. Merci de répondre à cette demande le plutôt possible.
                                    </div>
                                </div>
                                <div class = "app-card-footer px-4 py-3">
                                    <a class = "action-link mx-2" href = "{{url('/accept-new-user?id_temp_user='.$data->id_temp_users)}}" style = "color:inherit">
                                        Accepter la demande <i class = "lni lni-checkmark-circle"></i>
                                    </a>
                                    <a class = "action-link" href = "{{url('/annuler-new-user?id_temp_user='.$data->id_temp_users)}}" style = "color:inherit">
                                        Refuser la demande <i class = "lni lni-thumbs-down"></i>
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
                                Aucun nouveau utilisateur actuellement trouvé.
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