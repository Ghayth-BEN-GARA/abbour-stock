<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Profil</title> 
        @include('Layout.head_app')
    </head> 
    <body class = "app">
        <header class = "app-header fixed-top">
            <div class = "app-header-inner"> 
                @include('Layout.horizontal_nav')
            </div>
            <div id = "app-sidepanel" class = "app-sidepanel"> 
                @include('Layout.vertical_nav')
            </div>
        </header>
        <div class = "app-wrapper">
            <div class = "app-content pt-3 p-md-3 p-lg-4">
                <div class = "container-xl">
                    <h1 class = "app-page-title">Mon Compte</h1>
                    <div class = "row gy-4">
                        <div class = "col-12 col-lg-12">
                            <div class = "app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                <div class = "app-card-header p-3 border-bottom-0">
                                    <div class = "row align-items-center gx-3">
                                        <div class = "col-auto">
                                            <div class = "app-icon-holder">
                                                <i class = "lni lni-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <div class = "col-auto">
                                            <h4 class = "app-card-title">Modifier le profil</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class = "app-card-body px-4 w-100">
                                    <form id = "f-edit-profil" name = "f-edit-profil" method = "post" action = "{{url('/update-profil')}}" enctype = "multipart/form-data">
                                        @csrf
                                        @if (Session::has('erreur'))
                                            <div class = "alert alert-danger d-flex align-items-center" role = "alert">
                                                <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                    <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class = "mx-2">
                                                    {{session()->get('erreur')}}
                                                </div>
                                            </div>         
                                        @elseif (Session::has('success'))
                                            <div class = "alert alert-success d-flex align-items-center" role = "alert">
                                                <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                    <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </svg>
                                                <div class = "mx-2">
                                                    {{session()->get('success')}}
                                                </div>
                                            </div>         
                                        @endif
                                        <div class = "item border-bottom py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-lg-3">
                                                    <div class = "item-label">
                                                        <strong>Nom</strong>
                                                    </div>
                                                </div>
                                                <div class = "col-lg-9">
                                                    <input type = "text" class = "form-control" id = "new_nom" name = "new_nom" placeholder = "Entrez votre nouveau nom.." value = "{{auth()->user()->getNomUserAttribute()}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item border-bottom py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-lg-3">
                                                    <div class = "item-label">
                                                        <strong>Prénom</strong>
                                                    </div>
                                                </div>
                                                <div class = "col-lg-9">
                                                    <input type = "text" class = "form-control" id = "new_prenom" name = "new_prenom" placeholder = "Entrez votre nouveau prénom.." value = "{{auth()->user()->getPrenomUserAttribute()}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item border-bottom py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-lg-3">
                                                    <div class = "item-label">
                                                        <strong>Genre</strong>
                                                    </div>
                                                </div>
                                                <div class = "col-lg-9">
                                                    <select name = "new_genre" id = "new_genre" class = "form-control" required>
                                                        <option value = "Titre" disabled selected>Sélectionnez votre genre..</option>
                                                        <option value = "Homme" <?php echo auth()->user()->getGenreUserAttribute() != null && auth()->user()->getGenreUserAttribute() == 'Homme' ? 'selected' : '' ?>>Homme</option>
                                                        <option value = "Femme" <?php echo auth()->user()->getGenreUserAttribute() != null && auth()->user()->getGenreUserAttribute() == 'Femme' ? 'selected' : '' ?>>Femme</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item border-bottom py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-lg-3">
                                                    <div class = "item-label">
                                                        <strong>Numéro de carte d'identité</strong>
                                                    </div>
                                                </div>
                                                <div class = "col-lg-9">
                                                    <input type = "number" class = "form-control" id = "new_cin" name = "new_cin" placeholder = "Entrez votre nouveau numéro de carte d'identité.." value = "{{auth()->user()->getCinUserAttribute()}}" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item border-bottom py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-lg-3">
                                                    <div class = "item-label">
                                                        <strong>Date de naissance</strong>
                                                    </div>
                                                </div>
                                                <div class = "col-lg-9">
                                                    <input type = "date" class = "form-control" id = "new_date_naissance" name = "new_date_naissance" placeholder = "Entrez votre nouveau date de naissance.." value = "{{auth()->user()->getNaissanceUserAttribute()}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item border-bottom py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-lg-3">
                                                    <div class = "item-label">
                                                        <strong>Numéro mobile</strong>
                                                    </div>
                                                </div>
                                                <div class = "col-lg-9">
                                                    <input type = "phone" class = "form-control" id = "new_mobile" name = "new_mobile" placeholder = "Entrez votre nouveau numéro mobile.." value = "{{auth()->user()->getMobileUserAttribute()}}" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item border-bottom py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-lg-3">
                                                    <div class = "item-label">
                                                        <strong>Adresse</strong>
                                                    </div>
                                                </div>
                                                <div class = "col-lg-9">
                                                    <input type = "text" class = "form-control" id = "new_adresse" name = "new_adresse" placeholder = "Entrez votre nouvelle adresse.." value = "{{auth()->user()->getAdresseUserAttribute()}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "item border-bottom py-3">
                                            <div class = "row justify-content-between align-items-center">
                                                <div class = "col-lg-3">
                                                    <div class = "item-label">
                                                        <strong>Photo de profil</strong>
                                                    </div>
                                                </div>
                                                <div class = "col-lg-6">
                                                    <input type = "file" class = "form-control" id = "new_photo" name = "new_photo" placeholder = "Entrez votre nouvelle photo de profil.." accept = "image/jpeg">
                                                </div>
                                                <div class = "col-lg-3">
                                                    <img class = "profile-image-load" src = "{{auth()->user()->getImageUserAttribute()}}" alt = "Photo de profil" id = "image_load">
                                                </div>
                                            </div>
                                        </div>
                                        <button type = "submit" class = "btn app-btn-primary mt-3 mb-3">Modifier</button>
                                        <button type = "reset" class = "btn app-btn-info mt-3 mb-3">Annuler</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class = "app-auth-footer app-auth-footer2">
            @include('Layout.footer')
        </footer>
        @include('Layout.script')
        <script src = "{{asset('js/jquery.js')}}"></script> 
        <script>
            $("#new_photo").change(function(){
                readURL(this);
            });
        </script>
    </body>
</html>