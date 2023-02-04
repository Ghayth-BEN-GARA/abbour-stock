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
        document.getElementById('erreur_paiement_facture').innerHTML = "Veuillez enter un montant payé valide pour la facture d'achat.";
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

function gestionAjouterDesLignes() {
    var designation = document.getElementById('designation').value;
    var reference = document.getElementById('reference').value;
    var categorie = document.getElementById('categorie').selectedIndex;
    var quantite = document.getElementById('quantite').value;
    var prix = document.getElementById('prix').value;

    var erreur_designation = document.getElementById('erreur_designation');
    var erreur_reference = document.getElementById('erreur_reference');
    var erreur_categorie = document.getElementById('erreur_categorie');
    var erreur_quantite = document.getElementById('erreur_quantite');
    var erreur_prix = document.getElementById('erreur_prix');
    var erreur_prix_non_valide = document.getElementById('erreur_prix_non_valide');

    if(designation == ""){
        erreur_designation.style.display = 'block';
    }

    else if(reference == ""){
        erreur_reference.style.display = 'block';
    }

    else if(categorie == 0){
        erreur_categorie.style.display = 'block';
    }

    else if(quantite == ""){
        erreur_quantite.style.display = 'block';
    }

    else if(prix == ""){
        erreur_prix.style.display = 'block';
    }

    else if(!prix.includes('.')){
        erreur_prix_non_valide.style.display = 'block';
    }

    else{
        gestionCreerLigneFactureAchat();
    }
}

function effacerErreurDesignation() {
    document.getElementById('erreur_designation').style.display = 'none';
}

function effacerErreurReference() {
    document.getElementById('erreur_reference').style.display = 'none';
}

function effacerErreurCategorie() {
    document.getElementById('erreur_categorie').style.display = 'none';
}

function effacerErreurQuantite() {
    document.getElementById('erreur_quantite').style.display = 'none';
}

function effacerErreurPrix() {
   if(document.getElementById('erreur_prix').style.display != 'none'){
        document.getElementById('erreur_prix').style.display = 'none';
    }
    
    else if(document.getElementById('erreur_prix_non_valide').style.display != 'none'){
        document.getElementById('erreur_prix_non_valide').style.display = 'none';
    }
}

function searchDesignationAutoComplete() {
    $('#designation').typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-designation-facture-achat', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        },

        updater: function(item) {
            $.ajax({
                url: '/informations-article-search-designation',
                type: "get",
                cache: true,
                dataType: 'json',
                data: { designation: item },
                success: function(data) {
                    $('#designation').val(item);
                    $('#reference').val(data.reference);
                    $('#categorie').val(data.categorie);
                    $('#prix').val(data.prix);
                    $('#designation').prop('readonly', true);
                    $('#reference').prop('readonly', true);
                    $('#categorie').prop('readonly', true);
                }
            });
        }
    });
}

function searchReferenceAutoComplete() {
    $('#reference').typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-reference-facture-achat', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        },

        updater: function(item) {
            $.ajax({
                url: '/informations-article-search-reference',
                type: "get",
                cache: true,
                dataType: 'json',
                data: { reference: item },
                success: function(data) {
                    $('#reference').val(item);
                    $('#designation').val(data.designation);
                    $('#categorie').val(data.categorie);
                    $('#prix').val(data.prix);
                    $('#designation').prop('readonly', true);
                    $('#reference').prop('readonly', true);
                    $('#categorie').prop('readonly', true);
                }
            });
        }
    });
}

function gestionCreerLigneFactureAchat() {
    deleteEmptyLigne();
    ajouterLigne();
    clearData();
    enableInputs();
}

function deleteEmptyLigne(){
    $("#row_vide").remove();
}

function ajouterLigne() {
    var designation = document.getElementById('designation').value;
    var reference = document.getElementById('reference').value;
    var categorie = document.getElementById('categorie').value;
    var quantite = document.getElementById('quantite').value;
    var prix = document.getElementById('prix').value;

    $('.table #body_facture_achat').last().after(
        '<tr>'+
            '<td>'+
                '<input type = "text" class = "form-control-plaintext" name = "designation_achat[]" value = "'+designation+'" readonly>'+
            '</td>'+
            '<td>'+
                '<input type = "text" class = "form-control-plaintext" name = "reference_achat[]" value = "'+reference+'" readonly>'+
            '</td>'+
            '<td>'+
                '<input type = "text" class = "form-control-plaintext" name = "categorie_achat[]" value = "'+categorie+'" readonly>'+
            '</td>'+
            '<td>'+
                '<input type = "text" class = "form-control-plaintext" name = "quantite_achat[]" value = "'+quantite+'" readonly>'+
            '</td>'+
            '<td>'+
                '<input type = "text" class = "form-control-plaintext" name = "prix_achat[]" value = "'+prix+'" readonly>'+
            '</td>'+
            '<td>'+
                '<input type = "text" class = "form-control-plaintext" name = "prix_totale_achat[]" value = "'+calculerPrixTotale(quantite, prix)+'" readonly>'+
            '</td>'+
            '<td>'+
                '<button type = "button" class = "btn app-btn-danger" name = "button_delete" onclick = "gestionDeleteLigne(this)">Supprimer</button>'+
            '</td>'+
        '</tr>'
    );
    $('#button_create_facture_achat').prop('disabled', false);
}

function calculerPrixTotale(quantite,prix){
    var result = parseFloat(prix) * parseFloat(quantite);
    return result.toFixed(3);
}

function clearData(){
    $('#designation').val("Désignation");
    $('#reference').val(0);
    $('#categorie').val('Titre');
    $('#quantite').val(0);
    $('#prix').val("0.000");
}

function enableInputs(){
    $('#designation').prop('readonly', false);
    $('#reference').prop('readonly', false);
    $('#categorie').prop('readonly', false);
    $('#quantite').prop('readonly', false);
    $('#prix').prop('readonly', false);
}

function gestionDeleteLigne(element) {
    if($('table tr').length > 2){
        deleteNotEmptyLigne(element);
    }

    else if($('table tr').length == 2){
        deleteNotEmptyLigne(element);
        createEmptyLigne();
        $('#button_create_facture_achat').prop('disabled', true);
    }
}

function deleteNotEmptyLigne(element){
    element.closest('tr').remove();      
}

function createEmptyLigne(){
    $(".table #body_facture_achat").last().after(
        "<tr id = 'row_vide'>"+
            "<td colspan = '7' class = 'text-center'>"+
                "<p>Votre facture d'achat est encore vide.</p>"+
            "</td>"+
        "</tr>"
    );
}

function validerValidationPrixArticle() {
    var new_prix_article_achat = document.getElementById('new_prix_article').value;

    if(!new_prix_article_achat.includes('.')){
        event.preventDefault();
        document.getElementById('erreur_prix_achat').innerHTML = "Veuillez entrer un nouveau prix d'achat valide.";
    }

    else{
        $('#f-validation-prix-achat').submit();
    }
}

function effacerErreurPrixArticle() {
    document.getElementById('erreur_prix_achat').innerHTML = null;
}

function effacerErreurArticle() {
    document.getElementById('erreur_article').innerHTML = null;
}

function validerCreationEmplacement() {
    var reference_article = document.getElementById('article').selectedIndex;
    
    if(reference_article == 0){
        event.preventDefault();
        document.getElementById('erreur_article').innerHTML = "Veuillez sélectionner le fournisseur de la facture d'achat.";
    }

    else{
        $('#f-add-emplacement-article-par-reference').submit();       
    }
}

function disabledEnabledButtonSignup() {
    var checkBox = document.getElementById('RememberPassword');
    var btn = document.getElementById('submit');

    if(checkBox.checked){
        $(btn).removeAttr("disabled");
    }

    else{
        $(btn).attr("disabled", true);
    }
}

function annulerValidationPrixAchat(id_validation, reference_article) {
    window.location.href = "/annuler-validation-new-prix-article?id_validation="+id_validation+"&reference_article="+reference_article;
}

function validerValidationPrixArticle2() {
    var new_prix_article_achat = document.getElementById('new_prix').value;

    if(!new_prix_article_achat.includes('.')){
        event.preventDefault();
        document.getElementById('erreur_prix_achat2').innerHTML = "Veuillez entrer un nouveau prix d'achat valide.";
    }

    else{
        $('#f-validation-prix-achat2').submit();
    }
}

function effacerErreurPrixArticle2() {
    document.getElementById('erreur_prix_achat2').innerHTML = null;
}

function questionSupprimerFactureAchat(reference_facture) {
    swal({
        title: "Confirmation",
        html: "Si vous avez décidé de supprimer cette facture d'achat, elle sera définitivement supprimée de votre base de données.",
        type: 'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#fb7c1f',
        confirmButtonText: "Supprimer",
        cancelButtonText: 'Annuler',
        padding: 45
    })

    .then((result) => {
        if (result.value) {
            location.href = "/delete-facture-achat?reference_facture="+reference_facture;
        } 
        
        else if (result.dismiss === swal.DismissReason.cancel) {
            swal.close();
        }
    });
}

function validerFormulaireCreerPaiementLibre() {
    var montant_payer = document.getElementById('montant_paye').value;
    var selected_fournisseur = document.getElementById("fournisseur").selectedIndex;

    if(selected_fournisseur == 0){
        event.preventDefault();
        document.getElementById('erreur_fournisseur').innerHTML = "Veuillez sélectionner le fournisseur de réglement d'achat..";
    }

    if(!montant_payer.includes('.')){
        event.preventDefault();
        document.getElementById('erreur_reglement_libre').innerHTML = "Veuillez entrer un nouveau montant payé valide.";
    }

    else{
        $('#f-create-reglement').submit();
    }
}

function effacerErreurFournisseurReglement() {
    document.getElementById('erreur_fournisseur').innerHTML = null;
}

function effacerErreurMontantReglementPayer() {
    document.getElementById('erreur_reglement_libre').innerHTML = null;
}

function validationFormulaireModifierReglementAchat() {
    var paye = document.getElementById('paye').value;

    if(!paye.includes('.')){
        event.preventDefault();
        document.getElementById('erreur_paye').innerHTML = "Veuillez entrer un nouveau montant payé valide.";
    }

    else{
        $('#f-modification-reglement-libre').submit();
    }
}

function effacerErreurMontantPayer() {
    document.getElementById('erreur_paye').innerHTML = null;
}

function disableSelectClient() {
    document.getElementById('nom_client').setAttribute('disabled',true);
}

function enableSelectClient() {
    document.getElementById('nom_client').removeAttribute('disabled');
    document.getElementById('nom_client').focus();
}

function effacerErreurClient() {
    document.getElementById('erreur_client').innerHTML = null;
}

function disableMontantAccount() {
    document.getElementById('montant_account_prix').setAttribute('readonly',true);
    document.getElementById("erreur_montant_account").innerHTML = null;
    document.getElementById('montant_account_prix').value = "Montant";
}

function enableMontantAccount() {
    document.getElementById('montant_account_prix').removeAttribute('readonly');
    document.getElementById('montant_account_prix').focus();
    document.getElementById('montant_account_prix').value = "";
}

function effacerErreurMontantAccount() {
    document.getElementById('erreur_montant_account').innerHTML = null;
}

function effacerErreurReferenceArticleVente() {
    document.getElementById('erreur_reference_article').innerHTML = null;
}

function effacerErreurQuantiteArticleVente() {
    document.getElementById('erreur_quantite_article').innerHTML = null;
}

function effacerErreurRemiseArticleVente() {
    document.getElementById('erreur_remise_article').innerHTML = null;
    document.getElementById('erreur_remise_article_non_valide').innerHTML = null;
}

function searchReferenceArticleVenteAutoComplete() {
    $('#reference_article_vente').typeahead({
        source: function(query, process) {
            return $.get('/autocomplete-reference-facture-vente', { query: query }, function(data) {
                return process(JSON.parse(data));
            });
        },

        updater: function(item) {
            $.ajax({
                url: '/informations-article-search-reference-vente',
                type: "get",
                cache: true,
                dataType: 'json',
                data: { reference: item },
                success: function(data) {
                    $('#reference_article_vente').val(item);
                    $('#designation_article_vente').val(data.designation);
                    $('#prix_article_vente').val(data.prix_vente);
                    $('#reference_article_vente').prop('readonly', true);
                    $('#designation_article_vente').prop('readonly', true);
                    $('#prix_article_vente').prop('readonly', true);
                }
            });
        }
    });
}

function gestionAjouterDesLignesVente() {
    var reference = document.getElementById('reference_article_vente').value;
    var designation = document.getElementById('designation_article_vente').value;
    var quantite = document.getElementById('quantite_article_vente').value;
    var prix = document.getElementById('prix_article_vente').value;
    var remise = document.getElementById('remise_article_vente').value;
    
    var erreur_reference = document.getElementById('erreur_reference_article');
    var erreur_designation = document.getElementById('erreur_designation_article');
    var erreur_quantite = document.getElementById('erreur_quantite_article');
    var erreur_prix = document.getElementById('erreur_prix_article');
    var erreur_prix_non_valide = document.getElementById('erreur_prix_article_non_valide');
    var erreur_remise = document.getElementById('erreur_remise_article');
    
    if(reference.trim() == "" || reference.trim() == "Référence"){
        erreur_reference.innerHTML = 'Référence obligatoire';
    }

    else if(designation.trim() == "" || designation.trim() == "Désignation"){
        erreur_designation.innerHTML = 'Désignation obligatoire';
    }

    else if(quantite.trim() == "" || quantite.trim() == 0){
        erreur_quantite.innerHTML = 'Quantité obligatoire';
    }

    else if(prix.trim() == ""){
        erreur_prix.innerHTML = 'Prix obligatoire';
    }

    else if(!prix.trim().includes('.')){
        erreur_prix_non_valide.innerHTML = 'Prix non valide';
    }

    else if(remise.trim() == ""){
        erreur_remise.innerHTML = 'Remise obligatoire';
    }

    else{
        gestionVerificationQuantiteDansStock();
    }
}

function gestionCreerLigneFactureVente() {
    deleteEmptyLigne();
    ajouterLigneVente();
    clearDataVente();
    enableInputsVente();
    fermerSwal();
}

function ajouterLigneVente() {
    var reference = document.getElementById('reference_article_vente').value;
    var designation = document.getElementById('designation_article_vente').value;
    var quantite = document.getElementById('quantite_article_vente').value;
    var prix = document.getElementById('prix_article_vente').value;
    var remise = document.getElementById('remise_article_vente').value;
    
    $.ajax({
        url: '/calculer-prix-vente-remise',
        type: "get",
        cache: true,
        dataType: 'text',
        data: { 
            quantite: quantite,
            prix:prix,
            remise:remise    
        },
        success: function(data) {
            $('.table #body_facture_vente').last().after(
                '<tr>'+
                    '<td>'+
                        '<input type = "text" class = "form-control-plaintext" name = "designation_article[]" value = "'+designation+'" readonly required>'+
                    '</td>'+
                    '<td>'+
                        '<input type = "text" class = "form-control-plaintext ref_vente" name = "reference_article[]" value = "'+reference+'" readonly required>'+
                    '</td>'+
                    '<td>'+
                        '<input type = "number" class = "form-control-plaintext" name = "quantite_article[]" value = "'+quantite+'" required>'+
                    '</td>'+
                    '<td>'+
                        '<input type = "text" class = "form-control-plaintext" name = "prix_article[]" value = "'+prix+'" readonly required>'+
                    '</td>'+
                    '<td>'+
                        '<input type = "text" class = "form-control-plaintext" name = "remise_article[]" value = "'+remise+'" readonly required>'+
                    '</td>'+
                    '<td>'+
                        '<input type = "text" class = "form-control-plaintext" name = "prix_totale_article[]" value = "'+data.trim()+'" readonly required>'+
                    '</td>'+
                    '<td>'+
                        '<button type = "button" class = "btn app-btn-danger" name = "button_delete" onclick = "gestionDeleteLigneVente(this)">Supprimer</button>'+
                    '</td>'+
                '</tr>'
            );
            $('#button_create_facture_vente').prop('disabled', false);
        }
    });
}

function clearDataVente(){
    $('#reference_article_vente').val("Référence");
    $('#designation_article_vente').val("Désignation");
    $('#quantite_article_vente').val('0');
    $('#prix_article_vente').val("0.000");
    $('#remise_article_vente').val("0");
}

function enableInputsVente() {
    $('#reference_article_vente').prop('readonly', false);
    $('#quantite_article_vente').prop('readonly', false);
    $('#remise_article_vente').prop('readonly', false);
}

function gestionDeleteLigneVente(element) {
    if($('table tr').length > 2){
        deleteNotEmptyLigne(element);
    }

    else if($('table tr').length == 2){
        deleteNotEmptyLigne(element);
        createEmptyLigneVente();
        $('#button_create_facture_vente').prop('disabled', true);
    }
}

function createEmptyLigneVente(){
    $(".table #body_facture_vente").last().after(
        "<tr id = 'row_vide'>"+
            "<td colspan = '7' class = 'text-center'>"+
                "<p>Votre facture de vente est encore vide.</p>"+
            "</td>"+
        "</tr>"
    );
}

function fermerSwal() {
    swal.close();
}

function validerFormulaireCreerFactureVente() {
    test_client = true;
    test_livraison = true;
    test_remise = true;

    if($('#client').is(':checked')){
        event.preventDefault();
        var selected_client = document.getElementById("nom_client").selectedIndex;

        if(selected_client == 0){
            document.getElementById("erreur_client").innerHTML = "Veuillez sélectionner un client";
            $("html, body").animate({ scrollTop: 30 }, "fast");
            test_client = false;
        }

        else{
            document.getElementById("erreur_client").innerHTML = null;
            test_client = true;
        }
    }

    if($('#non_livre').is(':checked')){
        event.preventDefault();
        var montant_account = document.getElementById("montant_account_prix").value;

        if(montant_account.trim() == "Montant" || montant_account.trim() == ""){
            document.getElementById("erreur_montant_account").innerHTML = "Le montant est obligatoire";
            $("html, body").animate({ scrollTop: 30 }, "fast");
            test_livraison = false;
        }
        
        else if(!montant_account.trim().includes('.')){
            document.getElementById("erreur_montant_account").innerHTML = "Le montant saisi non valide";
            $("html, body").animate({ scrollTop: 30 }, "fast");
            test_livraison = false;
        }

        else{
            document.getElementById("erreur_montant_account").innerHTML = null;
            test_livraison = true;
        }
    }

    if($('#totale').is(':checked')){
        event.preventDefault();
        var montant_remise = document.getElementById("montant_remise").value;

        if(montant_remise == "Remise" || montant_account == ""){
            document.getElementById("erreur_montant_remise").innerHTML = "Le remise est obligatoire";
            $('html, body').animate({scrollTop: $('#heure').offset().top}, "fast");
            test_remise = false;
        }
    
        else{
            document.getElementById("erreur_montant_remise").innerHTML = null;
            test_remise = true;
        }
    }

    if((test_client == true) && (test_livraison == true) && (test_remise == true)){
        $('#f-creer-facture-vente')[0].submit();
    }
}

function disableMontantRemise() {
    document.getElementById('montant_remise').setAttribute('readonly',true);
    document.getElementById("erreur_montant_remise").innerHTML = null;
    document.getElementById('montant_remise').value = "Remise";
}

function enableMontantRemise() {
    document.getElementById('montant_remise').removeAttribute('readonly');
    document.getElementById('montant_remise').focus();
    document.getElementById('montant_remise').value = "";
}

function effacerErreurMontantRemise() {
    document.getElementById("erreur_montant_remise").innerHTML = null;
}

async function chargement(message) {
    swal({
        text: message,
        allowEscapeKey: false,
        allowOutsideClick: false,
        padding: "2em",
        width: "400px",
        onOpen: () => {
            swal.showLoading();
        }
    })
}

function gestionVerificationQuantiteDansStock() {
    chargement("Vérification d'article en cours..").then(verifierArticleVente());
}

function verifierArticleVente() {
    $.ajax({
        url: '/get-quantite-article-stock',
        type: "get",
        cache: true,
        data: { reference_article: $("#reference_article_vente").val() },
        success: function(data) {
            if(data.trim() == 0){
                afficherErreur("L'article demandé n'est pas disponible en stock..");
                clearDataVente();
                enableInputsVente();
            }

            else if(data.trim() < Number($("#quantite_article_vente").val())){
                afficherErreur("L'article demandé est disponible en stock mais la quantité n'est pas suffisante..");
                clearDataVente();
                enableInputsVente();
            }

            else if(Number($("#quantite_article_vente").val()) <= 0){
                afficherErreur("Veuillez saisir une quantité d'articles valide..");
                clearDataVente();
                enableInputsVente();
            }

            else if(verifierListeReferenceInputs($("#reference_article_vente").val()) > 0){
                afficherErreur("Vous avez déjà ajouté cet article à la liste des ventes..");
                clearDataVente();
                enableInputsVente();
            }

            else{
                gestionCreerLigneFactureVente();
            }
        }
    });
}

function afficherErreur(message) {
    swal({
        type: "error",
        title: "Oups !",
        html: message,
        width: 500,
        padding: '2em',
        showCancelButton: true,
        cancelButtonText: "Fermer",
        focusCancel: false,
        popup: 'animated fadeInDown faster',
        showConfirmButton: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        scrollbarPadding: true,
        allowOutsideClick: false
    })
}

function verifierListeReferenceInputs(reference) {
    var nbr_reference = 0;
    $(".ref_vente").each(function() {
        if(this.value == reference) {
            nbr_reference++;
        }
    });

    return nbr_reference;
}

function questionSupprimerFactureVente(reference_facture) {
    swal({
        title: "Confirmation",
        html: "Si vous avez décidé de supprimer cette facture de vente, elle sera définitivement supprimée de votre base de données.",
        type: 'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#fb7c1f',
        confirmButtonText: "Supprimer",
        cancelButtonText: 'Annuler',
        padding: 45
    })

    .then((result) => {
        if (result.value) {
            location.href = "/delete-facture-vente?reference_facture="+reference_facture;
        } 
        
        else if (result.dismiss === swal.DismissReason.cancel) {
            swal.close();
        }
    });
}

function validerFormulaireCreerPaiementLibreVente() {
    var montant_payer = document.getElementById('montant_paye').value;
    var selected_client = document.getElementById("client").selectedIndex;

    if(selected_client == 0){
        event.preventDefault();
        document.getElementById('erreur_client').innerHTML = "Veuillez sélectionner le client de réglement de vente..";
    }

    if(!montant_payer.includes('.')){
        event.preventDefault();
        document.getElementById('erreur_reglement_libre').innerHTML = "Veuillez entrer un nouveau montant payé valide.";
    }

    else{
        $('#f-create-reglement').submit();
    }
}

function effacerErreurClientReglement() {
    document.getElementById('erreur_client').innerHTML = null;
}