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

function validerCreerFacture(){
    var indexFournisseur = document.getElementById('nom_fournisseur').selectedIndex;
    var indexType = document.getElementById('type').selectedIndex;
    var matricule = document.getElementById('matricule').value;
    var montant = document.getElementById('montant').value;
    var tranche = document.getElementById('tranche').checked;

    if(indexFournisseur == 0 || matricule == ""){
        event.preventDefault();
        document.getElementById('erreur_matricule_fournisseur').innerHTML = "Veuillez sélectionner le fournisseur de la facture d'achat.";
        $("html, body").animate({ scrollTop: 50 }, "fast");
    }

    else if(indexType == 0){
        event.preventDefault();
        document.getElementById('erreur_type_facture').innerHTML = "Veuillez sélectionner le type de la facture d'achat.";
        $("html, body").animate({ scrollTop: 550 }, "fast");
    }

    else if(tranche == true && !montant.includes('.')){
        event.preventDefault();
        document.getElementById('erreur_paiement_facture').innerHTML = "Veuillez enter le montant payé pour la facture d'achat.";
        $("html, body").animate({ scrollTop: 550 }, "fast");
    }

    else{
        $('#f').submit();
    }
}

function effacerErreurFournisseur(){
    document.getElementById('erreur_matricule_fournisseur').innerHTML = null;
    document.getElementById('matricule').value = document.getElementById('nom_fournisseur').value;
}

function effacerErreurType(){
    document.getElementById('erreur_type_facture').innerHTML = null;
}

function effacerErreurMontant() {
    var montant = document.getElementById('montant').value;

    if(montant.includes('.')){
        document.getElementById('erreur_paiement_facture').innerHTML = null;
    }
}