<div>
    <div class = "tab-content" id = "orders-table-tab-content">
        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                <div class = "row app-card-body">
                    <div class = "app-search-form mx-auto mb-2 col-md-10">
                        <input type = "text" placeholder = "Chercher des utilisateurs.." name = "search_users" id = "search_users" class = "form-control search-input" wire:model = "search" required>
                        <span class = "btn search-btn btn-primary mx-3">
                            <i class = "fas fa-search"></i>
                        </span> 
                    </div>
                    <div class = "col-md-2">
						<select class = "form-select" name = "type_compte" id = "type_compte" wire:model = "type_compte" required>
							<option value = "Tout" selected>Tout</option>
                            <option value = "Admin">Admin</option>
                            <option value = "Utilisateur">Utilisateur</option>  
						</select>
					</div>
                    <div class = "table-responsive">
                        <table class = "table app-table-hover mb-0 text-left">
                            <thead>
							    <tr>
									<th class = "cell">Utilisateur</th>
									<th class = "cell">Adresse email</th>
									<th class = "cell">Numéro mobile</th>
									<th class = "cell">Type de compte</th>
									<th class = "cell text-center">Action</th>
								</tr>
							</thead>
                            <tbody>
                                @if(!empty($users) && ($users->count()))
                                    @foreach($users as $data)
                                        @if(Session::has('email') && $data->getEmailUserAttribute() == session()->get('email'))
                                            <tr class = "bg-success">
                                        @else
                                            <tr>
                                        @endif
                                            <td class = "cell">
                                                <p>
                                                    <img class = "profile-image-table" src = "{{$data->getImageUserAttribute()}}" alt = "Photo de profil">
                                                    {{$data->getFullnameUserAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    {{$data->getEmailUserAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    (+216) {{$data->getFormattedMobileUserAttribute()}}
                                                </p>
                                            </td>
                                            <td class = "cell">
                                                <p>
                                                    @if($data->getTypeUserAttribute() == "Utilisateur")
                                                        <span class = "badge bg-success">Utilisateur</span>
                                                    @else
                                                        <span class = "badge bg-danger">Admin</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class = "cell text-end">
                                                <p>
                                                    <a href = "{{url('/user?id_user='.$data->getIdUserAttribute())}}" class = "btn app-btn-secondary">Consulter</a>
                                                    <a href = "{{url('/edit-user?id_user='.$data->getIdUserAttribute())}}" class = "btn app-btn-secondary">Modifier</a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan = "6" class = "text-center">
                                        <span>La liste des utilisateurs est vide.</span>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class = "row text-center">
                        {{$users->links("vendor.pagination.normal_pagination")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
