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