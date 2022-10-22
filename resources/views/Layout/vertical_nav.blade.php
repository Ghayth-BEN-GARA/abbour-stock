<div id = "sidepanel-drop" class = "sidepanel-drop"></div>
<div class = "sidepanel-inner d-flex flex-column">
    <a href = "javascript:void(0)" id = "sidepanel-close" class = "sidepanel-close d-xl-none">&times;</a>
    <div class = "app-branding">
        <a class = "app-logo" href = "{{url('/home')}}">
            <img class = "logo-icon me-2" src = "{{asset('images/favicon.png')}}" alt = "Logo de l'application">
            <span class = "logo-text">Abbour'Stock Dépôt</span>
        </a>
    </div>
    <nav id = "app-nav-main" class = "app-nav app-nav-main flex-grow-1">
        <ul class = "app-menu list-unstyled accordion" id = "menu-accordion">
            <li class = "nav-item">
                <a class = "nav-link active" href = "{{url('/home')}}">
                    <span class = "nav-icon">
                        <i class = "lni lni-home"></i>
                    </span>
                    <span class = "nav-link-text">Accueil</span>
                </a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "{{url('/profil')}}">
                    <span class = "nav-icon">
                        <i class = "lni lni-user"></i>
                    </span>
                    <span class = "nav-link-text">Profil</span>
                </a>
            </li>
            @if (session('type') != 'Utilisateur')
                <li class = "nav-item has-submenu">
                    <a class = "nav-link submenu-toggle" href = "javascript:void(0)" data-bs-toggle = "collapse" data-bs-target = "#submenu-1" aria-expanded = "false" aria-controls = "submenu-1">
                        <span class = "nav-icon">
                            <i class = "lni lni-users"></i>
                        </span>
                        <span class = "nav-link-text">Utilisateurs</span>
                        <span class = "submenu-arrow">
		                    <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-chevron-down" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
	                            <path fill-rule = "evenodd" d = "M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
	                        </svg>
	                    </span>
                    </a>
                    <div id = "submenu-1" class = "collapse submenu submenu-1" data-bs-parent = "#menu-accordion">
                        <ul class = "submenu-list list-unstyled">
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "{{url('/add-user')}}">Créer</a>
                            </li>
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "{{url('/liste-users')}}">Gérer</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class = "nav-item has-submenu">
                    <a class = "nav-link submenu-toggle" href = "javascript:void(0)" data-bs-toggle = "collapse" data-bs-target = "#submenu-2" aria-expanded = "false" aria-controls = "submenu-2">
                        <span class = "nav-icon">
                            <i class = "lni lni-customer"></i>
                        </span>
                        <span class = "nav-link-text">Fournisseurs</span>
                        <span class = "submenu-arrow">
		                    <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-chevron-down" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
	                            <path fill-rule = "evenodd" d = "M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
	                        </svg>
	                    </span>
                    </a>
                    <div id = "submenu-2" class = "collapse submenu submenu-2" data-bs-parent = "#menu-accordion">
                        <ul class = "submenu-list list-unstyled">
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Créer</a>
                            </li>
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Gérer</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class = "nav-item has-submenu">
                    <a class = "nav-link submenu-toggle" href = "javascript:void(0)" data-bs-toggle = "collapse" data-bs-target = "#submenu-3" aria-expanded = "false" aria-controls = "submenu-3">
                        <span class = "nav-icon">
                            <i class = "lni lni-cart"></i>
                        </span>
                        <span class = "nav-link-text">Achats</span>
                        <span class = "submenu-arrow">
		                    <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-chevron-down" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
	                            <path fill-rule = "evenodd" d = "M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
	                        </svg>
	                    </span>
                    </a>
                    <div id = "submenu-3" class = "collapse submenu submenu-2" data-bs-parent = "#menu-accordion">
                        <ul class = "submenu-list list-unstyled">
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Créer</a>
                            </li>
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Gérer</a>
                            </li>
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Autre</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class = "nav-item has-submenu">
                    <a class = "nav-link submenu-toggle" href = "javascript:void(0)" data-bs-toggle = "collapse" data-bs-target = "#submenu-4" aria-expanded = "false" aria-controls = "submenu-4">
                        <span class = "nav-icon">
                            <i class = "lni lni-credit-cards"></i>
                        </span>
                        <span class = "nav-link-text">Réglements</span>
                        <span class = "submenu-arrow">
		                    <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-chevron-down" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
	                            <path fill-rule = "evenodd" d = "M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
	                        </svg>
	                    </span>
                    </a>
                    <div id = "submenu-4" class = "collapse submenu submenu-2" data-bs-parent = "#menu-accordion">
                        <ul class = "submenu-list list-unstyled">
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Créer un réglement libre</a>
                            </li>
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Gérer</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            <li class = "nav-item has-submenu">
                <a class = "nav-link submenu-toggle" href = "javascript:void(0)" data-bs-toggle = "collapse" data-bs-target = "#submenu-5" aria-expanded = "false" aria-controls = "submenu-5">
                    <span class = "nav-icon">
                        <i class = "lni lni-cart-full"></i>
                    </span>
                    <span class = "nav-link-text">Ventes</span>
                    <span class = "submenu-arrow">
                        <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-chevron-down" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
                            <path fill-rule = "evenodd" d = "M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </span>
                </a>
                <div id = "submenu-4" class = "collapse submenu submenu-2" data-bs-parent = "#menu-accordion">
                    <ul class = "submenu-list list-unstyled">
                        <li class = "submenu-item">
                            <a class = "submenu-link" href = "#">Caisse</a>
                        </li>
                        <li class = "submenu-item">
                            <a class = "submenu-link" href = "#">Gérer</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class = "nav-item has-submenu">
                <a class = "nav-link submenu-toggle" href = "javascript:void(0)" data-bs-toggle = "collapse" data-bs-target = "#submenu-6" aria-expanded = "false" aria-controls = "submenu-6">
                    <span class = "nav-icon">
                        <i class = "lni lni-network"></i>
                    </span>
                    <span class = "nav-link-text">Clients</span>
                    <span class = "submenu-arrow">
                        <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-chevron-down" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
                            <path fill-rule = "evenodd" d = "M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </span>
                </a>
                <div id = "submenu-4" class = "collapse submenu submenu-2" data-bs-parent = "#menu-accordion">
                    <ul class = "submenu-list list-unstyled">
                        <li class = "submenu-item">
                            <a class = "submenu-link" href = "#">Créer</a>
                        </li>
                        <li class = "submenu-item">
                            <a class = "submenu-link" href = "#">Gérer</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class = "nav-item has-submenu">
                <a class = "nav-link submenu-toggle" href = "javascript:void(0)" data-bs-toggle = "collapse" data-bs-target = "#submenu-7" aria-expanded = "false" aria-controls = "submenu-7">
                    <span class = "nav-icon">
                        <i class = "lni lni-bullhorn"></i>
                    </span>
                    <span class = "nav-link-text">Stock</span>
                    <span class = "submenu-arrow">
                        <svg width = "1em" height = "1em" viewBox = "0 0 16 16" class = "bi bi-chevron-down" fill = "currentColor" xmlns = "http://www.w3.org/2000/svg">
                            <path fill-rule = "evenodd" d = "M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </span>
                </a>
                <div id = "submenu-7" class = "collapse submenu submenu-2" data-bs-parent = "#menu-accordion">
                    <ul class = "submenu-list list-unstyled">
                        <li class = "submenu-item">
                            <a class = "submenu-link" href = "#">Disponibilité</a>
                        </li>
                        @if (session('type') != 'Utilisateur')
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Gérer</a>
                            </li>
                            <li class = "submenu-item">
                                <a class = "submenu-link" href = "#">Importer</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</div>