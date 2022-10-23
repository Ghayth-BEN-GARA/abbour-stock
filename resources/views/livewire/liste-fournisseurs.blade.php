<div>
    <div class = "tab-content" id = "orders-table-tab-content">
        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                <div class = "app-card-body">
                    <div class = "app-search-form mx-auto mb-2">
                        <input type = "text" placeholder = "Chercher des fournisseurs.." name = "search" id = "search" class = "form-control search-input" wire:model = "search" required>
                        <span class = "btn search-btn btn-primary">
                            <i class = "fas fa-search"></i>
                        </span> 
                    </div>
                    <div class = "table-responsive">
                        <table class = "table app-table-hover mb-0 text-left">
                            <thead>
							    <tr>
									<th class = "cell">#</th>
									<th class = "cell">Nom complet</th>
									<th class = "cell">Adresse email</th>
									<th class = "cell">Numéro mobile</th>
									<th class = "cell">Action</th>
								</tr>
							</thead>
                            <tbody>
                                @if(!empty($fournisseurs) && ($fournisseurs->count()))
                                    @foreach($fournisseurs as $data)
                                        <tr>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getMatriculeFournisseurAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getFullNameFournisseurAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getEmailFournisseurAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    (+216) {{$data->getMobile1FournisseurAttribute()}}
                                                    @if($data->getMobile2FournisseurAttribute() != 0)
                                                        / (+216) {{$data->getMobile2FournisseurAttribute()}}
                                                    @endif
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    <a href = "{{url('/fournisseur?matricule_fournisseur='.$data->getMatriculeFournisseurAttribute())}}" class = "btn app-btn-primary">Consulter</a>
                                                    <a href = "{{url('/edit-fournisseur?matricule_fournisseur='.$data->getMatriculeFournisseurAttribute())}}" class = "btn app-btn-secondary">Modifier</a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan = "5" class = "text-center">
                                        <span>La liste des fournisseurs est vide.</span>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class = "row text-center">
                        {{$fournisseurs->links("vendor.pagination.normal_pagination")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
