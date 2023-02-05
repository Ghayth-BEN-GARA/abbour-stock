<div>
    @if(!empty($this->getInformationsFacture($_GET['reference_facture'])))
        <div class = "main-content">
            <div class = "invoice-container">
                <div class = "top">
                    <div class = "top-left">
                        <h1 class = "main">Facture : {{$this->getInformationsFacture($_GET['reference_facture'])->getTypeFactureAttribute()}}</h1>
                        <span class = "code">#{{$_GET['reference_facture']}}</span>
                    </div>
                    <div class = "top-right">
                        <div class = "date text-capitalize">
                            Créé le : 
                            <?php
                                setlocale (LC_TIME, 'fr_FR.UTF-8','fra');
                                echo utf8_encode(strftime("%A %d %B %Y",strtotime($this->getInformationsFacture($_GET['reference_facture'])->getDateFactureAttribute())))
                            ?>
                        </div>
                        <div class = "date text-capitalize">
                            Aujourd'hui le: 
                            <?php
                                setlocale (LC_TIME, 'fr_FR.UTF-8','fra');
                                echo utf8_encode(strftime("%A %d %B %Y",strtotime(now())))
                            ?>
                        </div>
                    </div>
                </div>
                <div class = "bill-box">
                    <div class = "left">
                        <div class = "text-m">
                            Fournisseur
                        </div>
                        <div class = "title">
                            {{$this->getInformationsFacture($_GET['reference_facture'])->fullname_fournisseur}}
                        </div>
                        <div class = "add">
                            Numéro : (+216) {{substr($this->getInformationsFacture($_GET['reference_facture'])->mobile1_fournisseur, 0, 2)." ".substr($this->getInformationsFacture($_GET['reference_facture'])->mobile1_fournisseur, 2, 3)." ".substr($this->getInformationsFacture($_GET['reference_facture'])->mobile1_fournisseur, 5, 3)}}
                            <br>
                            Adresse : {{$this->getInformationsFacture($_GET['reference_facture'])->adresse_fournisseur}}
                        </div>
                    </div>
                    <div class = "right">
                        <div class = "text-m">
                            Client
                        </div>
                        <div class = "title">
                            Mhamed Abbour
                        </div>
                        <div class = "add">
                            Numéro : (+216) 24 513 092
                            <br>
                            Adresse : Ghar El Melh
                        </div>
                    </div>
                </div>
                <div class = "table-responsive">
                    <table class = "table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class = "cell">Article</th>
                                <th class = "cell">Quantité</th>
                                <th class = "cell">Prix Unitaire</th>
                                <th class = "cell">Prix Totale</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($this->getListeArticleFacture($_GET['reference_facture'])))
                                <?php
                                    $prix_totale = 0;
                                ?>
                                @foreach($this->getListeArticleFacture($_GET['reference_facture']) as $data)
                                    <tr>
                                        <td class = "cell">
                                            <p>
                                                {{$data->designation}}
                                            </p>
                                        </td>
                                        <td class = "cell">
                                            <p>
                                                {{$data->quantite_article}}
                                            </p>
                                        </td>
                                        <td class = "cell">
                                            <p>
                                                {{$data->prix_unitaire_article}} DT
                                            </p>
                                        </td>
                                        <td class = "cell">
                                            <p>
                                                {{number_format($data->prix_unitaire_article * $data->quantite_article, 3)}} DT
                                            </p>
                                        </td>
                                    </tr>
                                    <?php $prix_totale = $prix_totale + ($data->prix_unitaire_article * $data->quantite_article);?> 
                                @endforeach
                            @else
                                <tr>
                                    <td colspan = "4" class = "text-center">
                                        <span>La liste des articles pour cette achat est vide.</span>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            @if(!empty($this->getListeArticleFacture($_GET['reference_facture'])))
                                <tr class = "total">
                                    <td class = "name">Totale</td>
                                    <td></td>
                                    <td></td>
                                    <td class = "number">{{number_format($prix_totale, 3)}} DT</td>
                                </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
                <div class = "note">
                    @if($this->getDetailsReglement($_GET['reference_facture'])->getPayeReglementAchatAttribute() == $this->getDetailsReglement($_GET['reference_facture'])->getNetReglementAchatAttribute())
                        Le paiement est normalement réglé pour cette facture.
                    @elseif($this->getDetailsReglement($_GET['reference_facture'])->getPayeReglementAchatAttribute() < $this->getDetailsReglement($_GET['reference_facture'])->getNetReglementAchatAttribute())
                        La facture n'est pas réglée. Vous devez payer <b>{{number_format($this->getDetailsReglement($_GET['reference_facture'])->getNetReglementAchatAttribute() - $this->getDetailsReglement($_GET['reference_facture'])->getPayeReglementAchatAttribute(), 3)}} DT</b> pour ce fournisseur.
                    @else
                        La facture n'est pas réglée. Le fournisseur devez payer <b>{{number_format($this->getDetailsReglement($_GET['reference_facture'])->getPayerReglementAchatAttribute() - $this->getDetailsReglement($_GET['reference_facture'])->getNetReglementAchatAttribute(), 3)}} DT</b> pour vous.
                    @endif
                </div>
                <div class = "actions">
                    <a href = "javascript:window.print()" class = "btn app-btn-primary">Imprimer</a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning d-flex align-items-center" role = "alert">
            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div class = "mx-2">
                Aucune facture d'achat avec cette référence actuellement trouvée.
            </div>
        </div>
    @endif
</div>
