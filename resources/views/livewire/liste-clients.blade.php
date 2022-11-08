<div>
    <div class = "tab-content" id = "orders-table-tab-content">
        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                <div class = "app-card-body">
                    <div class = "app-search-form mx-auto mb-2">
                        <input type = "text" placeholder = "Chercher des clients.." name = "search" id = "search" class = "form-control search-input" wire:model = "search" required>
                        <span class = "btn search-btn btn-primary">
                            <i class = "fas fa-search"></i>
                        </span> 
                    </div>
                    <div class = "table-responsive">
                        <table class = "table app-table-hover mb-0 text-left">
                            <thead>
							    <tr>
									<th class = "cell">Matricule</th>
									<th class = "cell">Client</th>
									<th class = "cell">Adresse email</th>
									<th class = "cell">Numéro mobile</th>
									<th class = "cell text-center">Action</th>
								</tr>
							</thead>
                            <tbody>
                                @if(!empty($clients) && ($clients->count()))
                                    @foreach($clients as $data)
                                        <tr>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getMatriculeClientAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getFullNameClientAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getEmailClientAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    (+216) {{$data->getFormattedMobileClientAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell text-center">
                                                <p>
                                                    <a href = "{{url('/client?matricule_client='.$data->getMatriculeClientAttribute())}}" class = "btn app-btn-secondary">Consulter</a>
                                                    <a href = "{{url('/edit-client?matricule_client='.$data->getMatriculeClientAttribute())}}" class = "btn app-btn-secondary">Modifier</a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan = "5" class = "text-center">
                                        <span>La liste des clients est vide.</span>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class = "row text-center">
                        {{$clients->links("vendor.pagination.normal_pagination")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
