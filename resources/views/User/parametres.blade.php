<!DOCTYPE html>
<html lang = "en"> 
    <head>
        <title>Abbour'Stock Dépôt | Paramétres</title> 
        @include('Layout.head_app')
        <link rel = "stylesheet" href = "{{asset('css/pagination.css')}}">
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
                    <div class = "row g-3 mb-4 align-items-center justify-content-between">
                        <div class = "col-auto">
			                <h1 class = "app-page-title mb-0">Paramétres</h1>
				        </div>
                    </div>
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
                    <div class = "col-12 col-lg-12">
                        <div class = "app-card app-card-settings shadow-sm p-4">
                            <div class = "app-card-body">
                                <p class = "form-text text-dark">Si vous le souhaitez, vous pouvez vider votre journal d'authentification en cliquant sur ce <a href = "{{url('/delete-journal')}}" style = "color:#F7941E">lien</a>.</p>      
                            </div>
                        </div>
                    </div>
                    <div class = "tab-content my-5" id = "orders-table-tab-content">
                        <div class = "tab-pane fade show active" id = "orders-all" role = "tabpanel" aria-labelledby = "orders-all-tab">
                            <div class = "app-card app-card-orders-table shadow-sm mb-5">
                                <div class = "app-card-body">
                                    <div class = "table-responsive">
                                        <table class = "table app-table-hover mb-0 text-left">
                                            <thead>
                                                <tr class = "p">
                                                    <th class = "cell">#</th>
                                                    <th class = "cell">Action</th>
                                                    <th class = "cell">Description</th>
                                                    <th class = "cell">Date et temps</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($journal) && ($journal->count()))
                                                    @foreach($journal as $data)
                                                        <tr>
                                                            <td class = "cell">
                                                                <p>{{$data->getIdJournalAttribute()}}</p>
                                                            </td>
                                                            <td class = "cell">
                                                                <p>{{$data->getTacheJournalAttribute()}}</p>
                                                            </td>
                                                            <td class = "cell">
                                                                <p>{{$data->getDescriptionJournalAttribute()}}</p>
                                                            </td>
                                                            <td class = "cell">
                                                                <p class = "text-capitalize">
                                                                    <?php
                                                                        setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                                        echo strftime("%A %d %B %Y",strtotime(strftime($data->getDateTimeJournalAttribute())))  
                                                                    ?>
                                                                    à
                                                                    <span class = "note">{{date('H:i',strtotime($data->getDateTimeJournalAttribute()))}}</span>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan = "4" class = "text-center">
                                                            <span>Le journal d'authentification est vide.</span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class = "row text-center">
                                        {{$journal->links("vendor.pagination.normal_pagination")}}
                                    </div>
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
    </body>
</html>