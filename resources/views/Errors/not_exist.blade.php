<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>Abbour'Stock Dépôt | Page non disponible</title> 
        @include('Layout.head_not_exist')
        <link rel = "stylesheet" href = "{{asset('css/style1.css')}}">
    </head>
    <body>
	    <div id = "notfound">
		    <div class = "notfound">
			    <div class = "notfound-404">
				    <h1>500</h1>
			    </div>
			    <h2>Oops! Page non disponible</h2>
			    <p>
                    La page que vous recherchez a peut-être été supprimée, son nom a changé ou est temporairement indisponible.
                    <a href = "{{url('/')}}">Retour à la page d'authentification</a>
                </p>
			    <div class = "notfound-social">
				    <a href = "https://www.facebook.com/Abbour.Stock.Depot"><i class = "fab fa-facebook-f"></i></a>
				    <a href = "https://www.instagram.com/abbour.stock.depot/?next=%2F&hl=fr"><i class = "fab fa-instagram"></i></a>
				    <a href = "abbourstock@gmail.com"><i class = "fab fa-google"></i></a>
			    </div>
		    </div>
	    </div>
        <footer class = "app-auth-footer">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
    </body>
</html>