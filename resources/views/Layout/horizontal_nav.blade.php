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
        </div>
    </div>
</div>