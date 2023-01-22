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
                                    <td>
                                        <span class = "number">{{number_format($data->paye_reglement_achat, 3)}} DT</span>
                                    </td>
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
                                        <a href = "#" class = "more ap lni lni-more-alt"></a>
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