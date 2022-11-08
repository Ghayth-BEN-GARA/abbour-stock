@livewireStyles
<div class = "container-fluid py-2">
    <div class = "app-header-content"> 
        <div class = "row justify-content-between align-items-center">
            <div class = "col-auto">
				<a id = "sidepanel-toggler" class = "sidepanel-toggler d-inline-block d-xl-none" href = "javascript:void(0)">
					<svg xmlns = "http://www.w3.org/2000/svg" width = "30" height = "30" viewBox = "0 0 30 30" role = "img">
                        <title>Menu</title>
                        <path stroke = "#F7941E" stroke-linecap = "round" stroke-miterlimit = "10" stroke-width = "2" d = "M4 7h22M4 15h22M4 23h22"></path>
                    </svg>
				</a>
			</div>
            <div class = "search-mobile-trigger d-sm-none col">
			    <i class = "search-mobile-trigger-icon fas fa-search"></i>
			</div>
            <div class = "app-search-box col">
                <form class = "app-search-form" id = "f-search" name = "f-search" method = "get" action = "#">
                    <input type = "text" placeholder = "Chercher des utilisateurs.." name = "search" id = "search" class = "form-control search-input" required>
                    <button type = "submit" class = "btn search-btn btn-primary" value = "Chercher">
                        <i class = "fas fa-search"></i>
                    </button> 
                </form>
            </div>
            <div class = "app-utilities col-auto">
                <div class = "app-utility-item app-notifications-dropdown dropdown"> 
                    <livewire:demande-modification-type-notification/>
                </div>
                <div class = "app-utility-item">
                    <a href = "{{url('/parametres')}}" title = "Settings">
                        <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-gear icon" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
                            <path fill-rule = "evenodd" d = "M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                            <path fill-rule = "evenodd" d = "M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                        </svg>
                    </a>
                </div>
                <div class = "app-utility-item">
                    <p>{{auth()->user()->getFullNameUserAttribute()}}</p>
                </div>
                <div class = "app-utility-item app-user-dropdown dropdown">
                    <a class = "dropdown-toggle" id = "user-dropdown-toggle" data-bs-toggle = "dropdown" href = "javascript:void(0)" role = "button" aria-expanded = "false">
                        <img src = "{{URL::asset(auth()->user()->getImageUserAttribute())}}" alt = "Photo de profil">
                    </a>
                    <ul class = "dropdown-menu" aria-labelledby = "user-dropdown-toggle">
                        <li>
                            <a class = "dropdown-item" href = "{{url('/profil')}}">Profil</a>
                        </li>
                        <li>
                            <hr class = "dropdown-divider">
                        </li>
                        @if(auth()->user()->getTypeUserAttribute() == "Administrateur")
                            <li>
                                <a class = "dropdown-item" href = "{{url('/liste-demandes-modification-type-compte')}}">Demandes</a>
                            </li>
                        @else
                            <li>
                                <a class = "dropdown-item" href = "{{url('/mes-demandes')}}">Mes demandes</a>
                            </li>
                        @endif
                        <li>
                            <hr class = "dropdown-divider">
                        </li>
                        <li>
                            <a class = "dropdown-item" href = "{{url('/journales')}}">Journales</a>
                        </li>
                        <li>
                            <hr class = "dropdown-divider">
                        </li>
                        <li>
                            <a class = "dropdown-item" href = "{{url('/parametres')}}">Paramétres</a>
                        </li>
                        <li>
                            <hr class = "dropdown-divider">
                        </li>
                        <li>
                            <a class = "dropdown-item" href = "{{url('/logout')}}">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@livewireScripts