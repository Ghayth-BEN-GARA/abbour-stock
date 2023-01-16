<div>
    <div class = "tab-content" id = "orders-table-tab-content">
        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                <div class = "row app-card-body">
                    <div class = "app-search-form mx-auto mb-2 col-md-10">
                        <input type = "text" placeholder = "Chercher des chats.." name = "search_achats" id = "search_achats" class = "form-control search-input" wire:model = "search" required>
                        <span class = "btn search-btn btn-primary mx-3">
                            <i class = "fas fa-search"></i>
                        </span>
                    </div>
                    <div class = "col-md-2">
						<select class = "form-select" name = "type_achats" id = "type_achats" wire:model = "type_achats" required>
							<option value = "Tout">Tout</option>
							<option value = "BL"> BL</option>
                            <option value = "FACT"> FACT</option> 
						</select>
					</div>
                    <div class = "table-responsive">
                        <table class = "table app-table-hover mb-0 text-left">
                            <thead>
							    <tr>
									<th class = "cell">Référence</th>
									<th class = "cell">Fournisseur</th>
									<th class = "cell">Date et heure</th>
									<th class = "cell">Type</th>
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
                                                    {{$data->fullname_fournisseur}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    <?php
                                                        setlocale (LC_TIME, 'fr_FR.UTF-8','fra');
                                                        echo utf8_encode(strftime("%A %d %B %Y",strtotime($data->date_facture)))
                                                    ?>
                                                    à
                                                    {{date('h:m', strtotime($data->date_facture))}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->type_facture}}
                                                </p>
                                            </td>
                                            <td class = "cell text-end">
                                                <p>
                                                    <a href = "#" class = "btn app-btn-secondary">Consulter</a>
                                                    <a href = "#" class = "btn app-btn-secondary">Supprimer</a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan = "5" class = "text-center">
                                            <span>La liste des achats est vide.</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class = "row text-center">
                        {{$factures->links("vendor.pagination.normal_pagination")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
