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
                    <livewire:validation-prix-achat-facture/>
                </div>
                <div class = "app-utility-item app-notifications-dropdown dropdown"> 
                    <livewire:demande-modification-type-notification/>
                </div>
                <div class = "app-utility-item">
                    <a href = "{{url('/parametres')}}" title = "Settings">
                        <i class = "lni lni-cog icon"></i>
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