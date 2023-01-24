<div>
    <div class = "box-recent-payment">
        <div class = "subtitle">Liste Des Factures</div>
        <div class = "table-content">
            <table class = "table-result">
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Date</th>
                        <th>Net</th>
                        <th>Payé</th>
                        <th>Reste</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                    <tbody>
                        @if(!empty($reglements) && ($reglements->count()))
                            @foreach($reglements as $data)
                                <tr>
                                    <td>
                                        <div class = "payment-name">
                                            FACTURE N° {{$data->reference_facture_achat}}
                                        </div>
                                    </td>
                                    <td class = "text-capitalize date">
                                        <?php
                                            setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                            echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($data->date_reglement_achat))))  
                                        ?>
                                    </td>
                                    <td>
                                        <span class = "number">{{number_format($data->net_reglement_achat, 3)}} DT</span>
                                    </td>
                                    @if(Session::has('success') && $data->id_reglement_achat == session()->get("success"))
                                        <td>
                                            <span class = "number badge bg-success">{{number_format($data->paye_reglement_achat, 3)}} DT</span>
                                        </td>
                                    @elseif(Session::has('erreur') && $data->id_reglement_achat == session()->get("erreur"))
                                        <td>
                                            <span class = "number badge bg-danger">{{number_format($data->paye_reglement_achat, 3)}} DT</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class = "number">{{number_format($data->paye_reglement_achat, 3)}} DT</span>
                                        </td>
                                    @endif
                                    <td>
                                        <span class = "number">{{number_format($data->net_reglement_achat - $data->paye_reglement_achat, 3)}} DT</span>
                                    </td>
                                    <td>
                                        @if($data->type_reglement_achat == "Facture")
                                            <div class = "status -payment">
                                                Facture
                                            </div>
                                        @else
                                            <div class = "status -refund">
                                                Libre
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href = "javascript:void(0)" class = "more ap lni lni-more-alt open_modal" data-bs-toggle = "modal" data-bs-target = "#modifier-reglement-libre" type = "button" data-id-reglement-achat = "{{$data->id_reglement_achat}}" data-paye = "{{$data->paye_reglement_achat}}" data-reference-facture = "{{$data->reference_facture_achat}}"></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan = "5" class = "text-center">
                                    <span>La liste des factures est vide.</span>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
</div>
<div id = "modifier-reglement-libre" class = "modal fade" tabindex = "-1" role = "dialog" aria-hidden = "true">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h5 class = "modal-title">Réglement libre</h5>
                <button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>
            </div>
            <div class = "modal-body">
                <div class = "text-center mt-2 mb-4">
                    <a href = "javascript:void(0)" class = "text-success">
                        <span>
                            <img src = "{{URL::asset('/images/favicon.png')}}" alt = "Logo de l'application" height = 80/>
                        </span>
                        <h6 class = "mt-1">Modification du réglement</h6>
                    </a>
                </div>
                <form action = "{{url('/edit-reglement-achat')}}" class = "ps-3 pe-3" method = "post" name = "f-modification-reglement-libre" id = "f-modification-reglement-libre" onsubmit = "validationFormulaireModifierReglementAchat()">
                    @csrf
                    <div class = "item border-bottom py-3">
                        <div class = "row justify-content-between align-items-center">
                            <div class = "col-auto col-lg-6">
                                <div class = "item-label">
                                    <strong>Référence</strong>
                                </div>
                                <div class = "item-data">
                                    <input type = "text" class = "form-control" id = "reference_facture" name = "reference_facture" placeholder = "Entrez la référence de la facture.." readonly required>
                                </div>
                            </div>
                            <div class = "col-auto col-lg-6">
                                <div class = "item-label">
                                    <strong>Payé</strong>
                                </div>
                                <div class = "item-data">
                                    <input type = "text" class = "form-control" id = "paye" name = "paye" placeholder = "Entrez le nouveaux montant payé de la facture.." onkeypress = "return (event.charCode>=46 && event.charCode<=57)" oninput = "effacerErreurMontantPayer()" required>
                                </div>
                            </div>
                            <p class = "form-text text-danger mt-2" id = "erreur_paye"></p>
                        </div>
                    </div>
                    <div class = "item py-2 mx-auto text-center">
                        <button type = "submit" class = "btn app-btn-primary">Modifier le réglement</button>
                    </div>
                    <input type = "hidden" class = "form-control" id = "id_reglement_achat" name = "id_reglement_achat" placeholder = "Entrez l'identifiant de réglement d'achat.." readonly required>
                </form>
            </div>
        </div>
    </div>
</div>
<script src = "{{asset('js/jquery.js')}}"></script>
<script> 
    $(function () {
        $(".open_modal").click(function () {
            var reference_facture = $(this).data('reference-facture');
            var paye = $(this).data('paye');
            var id_reglement = $(this).data('id-reglement-achat');

            $("#reference_facture").val(reference_facture);
            $("#paye").val(paye);
            $("#id_reglement_achat").val(id_reglement);
            $('.modal').appendTo("body") 
        })
    });
</script>