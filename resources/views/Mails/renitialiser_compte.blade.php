<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
        <title>Abbour'Stock Dépôt | Récupération</title> 
        <link rel = "icon" href = "{{asset('images/favicon.png')}}">
    </head>
    <body>
        <div class = "container mt-5">
            <div class = "mt-4 p-5 bg-light text-dark rounded">
                <p>Bonjour <b>{{$mailData['fullname']}}</b>,<br>
                    Nous vous envoyons cet e-mail car vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur ce lien pour créer un nouveau mot de passe.
                    <a href = "http://127.0.0.1:8000/reset-password/{{$mailData['token']}}/{{$mailData['id_user']}}">Réinitialisez votre mot de passe</a>
                </p> 
                <p>
                    Si vous rencontrez des difficultés lors de la configuration de votre compte, vous pouvez nous envoyer un e-mail à : <b>abbourstock@gmail.com</b>.
                </p>
            </div>
        </div>
        <hr>
        <div class = "container d-flex align-items-center justify-content-center mt-5">
            <div class = "card bg-light" style = "width:450px">
                <div class = "card-body">
                    <p class = "card-text">Vous recevez des e-mails concernant la récupération de votre compte.</p>
                    <p>Cet e-mail est pour {{$mailData['fullname']}}. (Utilisateur de l'application).</p>
                    <p>Copyright © <?php echo date("F Y");?> <b>Abbour'Stock Dépôt</b>.</p>
                </div>
            </div>
        </dv>
    </body>
</html>