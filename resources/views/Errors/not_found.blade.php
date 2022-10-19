<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Page introuvable</title> 
        @include('Layout.head_app')
    </head>
    <body class = "app app-404-page">   	
        <div class = "container mb-5">
	        <div class = "row">
		        <div class = "col-12 col-md-11 col-lg-7 col-xl-6 mx-auto">
			        <div class = "app-branding text-center mb-5">
		                <a class = "app-logo" href = "javascript:void(0)">
                            <img class = "logo-icon me-2" src = "{{asset('images/favicon.png')}}" alt = "Logo de l'application">
                            <span class = "logo-text">Abbour'Stock Dépôt</span>
                        </a>
		            </div>
			        <div class = "app-card p-5 text-center shadow-sm">
				        <h1 class = "page-title mb-4">
                            404
                            <br>
                            <span class = "font-weight-light">Page introuvable</span>
                        </h1>
				        <div class = "mb-4">
					        La page que vous recherchez a peut-être été supprimée, son nom a changé ou est temporairement indisponible.
				        </div>
                        @if (Session::has('email'))
				            <a class = "btn app-btn-primary" href = "{{url('/home')}}">Aller à la page d'accueil</a>
                        @else
                            <a class = "btn app-btn-primary" href = "{{url('/')}}">Aller à la page d'authentification</a>
                        @endif
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

