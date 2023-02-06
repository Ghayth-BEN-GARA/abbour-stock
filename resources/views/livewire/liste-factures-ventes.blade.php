<div>
    <div class = "tab-content" id = "orders-table-tab-content">
        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                <div class = "app-card-body">
                    <div class = "app-search-form mx-auto mb-2">
                        <input type = "text" placeholder = "Chercher des ventes.." name = "search_ventes" id = "search_ventes" class = "form-control search-input" wire:model = "search" required>
                        <span class = "btn search-btn btn-primary">
                            <i class = "fas fa-search"></i>
                        </span>
                    </div>
                    <div class = "table-responsive">
                        <table class = "table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
									<th class = "cell">Référence</th>
									<th class = "cell">Client</th>
									<th class = "cell">Date et heure</th>
									<th class = "cell text-center">Action</th>
								</tr>
                            </thead>
                            <tbody>
                                @if(!empty($factures) && ($factures->count()))
                                    @foreach($factures as $data)
                                        <tr>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->reference_facture}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    @if($data->nom_client == "Passager")
                                                        Passager
                                                    @else
                                                        {{$data->prenom_client}} {{$data->nom_client}}
                                                    @endif
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p class = "text-capitalize">
                                                    <?php
                                                        setlocale (LC_TIME, 'fr_FR.UTF-8','fra');
                                                        echo utf8_encode(strftime("%A %d %B %Y",strtotime($data->date_facture)))
                                                    ?>
                                                    à
                                                    {{date('h:m', strtotime($data->date_facture))}}
                                                </p>
                                            </td>
                                            <td class = "cell text-end">
                                                <p>
                                                    @if($data->livraison_facture != "Livré")
                                                    <a href = "{{url('edit-livraison-vente?reference_facture='.$data->reference_facture)}}" class = "btn app-btn-secondary">Livré</a>
                                                    @endif
                                                    <a href = "{{url('facture-vente?reference_facture='.$data->reference_facture)}}" class = "btn app-btn-secondary">Consulter</a>
                                                    <a href = "javascript:void(0)" class = "btn app-btn-secondary" onclick = "questionSupprimerFactureVente('{{$data->reference_facture}}')">Supprimer</a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan = "4" class = "text-center">
                                            <span>La liste des ventes est vide.</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
