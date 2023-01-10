<div>
    <div class = "tab-content" id = "orders-table-tab-content">
        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                <div class = "app-card-body">
                    <div class = "app-search-form mx-auto mb-2">
                        <input type = "text" placeholder = "Chercher des articles.." name = "search" id = "search" class = "form-control search-input" wire:model = "search" required>
                        <span class = "btn search-btn btn-primary">
                            <i class = "fas fa-search"></i>
                        </span> 
                    </div>
                    <div class = "table-responsive">
                        <table class = "table app-table-hover mb-0 text-left">
                            <thead>
							    <tr>
									<th class = "cell">Référence</th>
									<th class = "cell">Désignation</th>
                                    <th class = "cell">Quantité</th>
                                    @if(session('type') != "Utilisateur")
                                        <th class = "cell">Prix d'achat</th>
                                    @endif
                                    <th class = "cell">Prix de vente</th>
                                    <th class = "cell">Disponibilité</th>
								</tr>
							</thead>
                            <tbody>
                                @if(!empty($stocks) && ($stocks->count()))
                                    @foreach($stocks as $data)
                                        <tr>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getReferenceArticleAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->designation}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getQuantiteStockAttribute()}}
                                                </p>
                                            </td>
                                            @if(session('type') != "Utilisateur")
                                                <td class = "cell">
                                                    <p>
                                                        {{$data->getPrixAchatArticleAttribute()}} DT
                                                    </p>
                                                </td>
                                            @endif
                                            <td class = "cell">
                                                <p>
                                                    {{$this->calculerPrixVente($data->getPrixAchatArticleAttribute(), $data->getMargePrixAttribute())}} DT
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    @if($data->getQuantiteStockAttribute() == 0)
                                                        <span class = "badge bg-danger">En repture de stock</span>
                                                    @else
                                                        <span class = "badge bg-success">Disponible</span>
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan = "6" class = "text-center">
                                        <span>La liste des articles est vide.</span>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class = "row text-center">
                        {{$stocks->links("vendor.pagination.normal_pagination")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
