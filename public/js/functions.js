function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_load').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function validerPrixMarge(){
    var prix = document.getElementById('prix_achat').value;
    var marge = document.getElementById('marge').value;

    if(!prix.includes('.')){
        event.preventDefault();
        document.getElementById('erreur_prix').innerHTML = "Veuillez entrer un prix d'achat valide";
        $('.btn').prop('disabled',false);
    }

    else if(!marge.includes('.')){
        event.preventDefault();
        document.getElementById('erreur_marge').innerHTML = "Veuillez entrer un marge valide";
    }

    else{
        $('#f2').submit();
    }
}

function disableInputMontant() {
    document.getElementById('montant').setAttribute('disabled',true);
}


function enableInputMontant() {
    document.getElementById('montant').removeAttribute('disabled');
    document.getElementById('montant').focus();
}