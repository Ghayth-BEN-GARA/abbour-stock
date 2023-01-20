<div>
    <div class = "tab-content" id = "orders-table-tab-content">
        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                <div class = "row app-card-body">
                    <div class = "app-search-form mx-auto mb-2 col-md-10">
                        <input type = "text" placeholder = "Chercher des emplacements des articles.." name = "search_emplacements" id = "search_emplacements" class = "form-control search-input" wire:model = "search" required>
                        <span class = "btn search-btn btn-primary mx-3">
                            <i class = "fas fa-search"></i>
                        </span>
                    </div>
                    <div class = "col-md-2">
						<select class = "form-select" name = "type_cherche" id = "type_cherche" wire:model = "type_cherche" required>
							<option value = "Tout">Tout</option>
                            <option value = "Désignation">Désignation</option>
                            <option value = "Emplacement">Emplacement</option>
                            <option value = "Référence">Référence</option>
                            <option value = "Stock">Stock</option>
						</select>
					</div>
                    <div class = "table-responsive">
                        <table class = "table app-table-hover mb-0 text-left">
                            <thead>
							    <tr>
									<th class = "cell">Référence</th>
									<th class = "cell">Désignation</th>
									<th class = "cell">Emplacement</th>
									<th class = "cell">Stock</th>
									<th class = "cell text-center">Action</th>
								</tr>
							</thead>
                            <tbody>
                                @if(!empty($articles) && ($articles->count()))
                                    @foreach($articles as $data)
                                        <tr>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->reference_article}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->designation}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->emplacement_article_creer}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->stock_article_creer}}
                                                </p>
                                            </td>
                                            <td class = "cell text-end">
                                                <p>
                                                    <a href = "{{url('/emplacement-article?reference_article='.$data->reference_article)}}" class = "btn app-btn-secondary">Consulter</a>
                                                    <a href = "{{url('/edit-emplacement-article?reference_article='.$data->reference_article)}}" class = "btn app-btn-secondary">Modifier</a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan = "5" class = "text-center">
                                            <span>La liste des articles est vide.</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class = "row text-center">
                        {{$articles->links("vendor.pagination.normal_pagination")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
