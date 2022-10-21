<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
        <title>Abbour'Stock Dépôt | Décision de l'administrateur</title> 
        <link rel = "icon" href = "{{asset('images/favicon.png')}}">
    </head>
    <body>
        <div class = "container mt-5">
            <div class = "mt-4 p-5 bg-light text-dark rounded">
                <p>Bonjour <b>{{$mailData['fullname']}}</b>,<br>
                    Suite à votre demande de modification de type de votre compte, l'administrateur a décidé de :
                    <ul>
                        <li>
                            @if($mailData['etat_demande'] == 1)
                                <b>Accepter votre demande</b>

                            @else
                                <b>Refuser votre demande</b>
                            @endif
                        </li>
                    </ul> 
                </p> 
                <p>
                    Si vous rencontrez des difficultés lors de la configuration de votre site Web, vous pouvez nous envoyer un e-mail à : <b>abbourstock@gmail.com</b>.
                </p>
            </div>
        </div>
        <hr>
        <div class = "container d-flex align-items-center justify-content-center mt-5">
            <div class = "card bg-light" style = "width:450px">
                <div class = "card-body">
                    <p class = "card-text">Vous recevez des e-mails concernant la modification de type de compte.</p>
                    <p>Cet e-mail est pour {{$mailData['fullname']}}. (Utilisateur de l'application).</p>
                    <p>Copyright © <?php echo date("F Y");?> <b>Abbour'Stock Dépôt</b>.</p>
                </div>
            </div>
        </dv>
    </body>
</html>