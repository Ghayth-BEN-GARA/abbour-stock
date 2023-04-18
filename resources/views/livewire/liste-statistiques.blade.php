<div>
    <div class = "row g-4 mb-4">
        <div class = "col-6 col-lg-3">
            <div class = "app-card app-card-stat shadow-sm h-100">
                <div class = "app-card-body p-3 p-lg-4">
                    <h4 class = "stats-type mb-1">Utilisateurs</h4>
                    <div class = "stats-figure">{{$nbr_users}}</div>
                    <div class = "stats-meta text-capitalize"> Gérent le système</div>
                </div>
            </div>
        </div>
        <div class = "col-6 col-lg-3">
            <div class = "app-card app-card-stat shadow-sm h-100">
                <div class = "app-card-body p-3 p-lg-4">
                    <h4 class = "stats-type mb-1">Fournisseurs</h4>
                    <div class = "stats-figure">{{$nbr_fournisseurs}}</div>
                    <div class = "stats-meta text-capitalize"> Traitent avec vous</div>
                </div>
            </div>
        </div>
        <div class = "col-6 col-lg-3">
            <div class = "app-card app-card-stat shadow-sm h-100">
                <div class = "app-card-body p-3 p-lg-4">
                    <h4 class = "stats-type mb-1">Clients</h4>
                    <div class = "stats-figure">{{$nbr_clients}}</div>
                    <div class = "stats-meta text-capitalize"> Achètent chez vous</div>
                </div>
            </div>
        </div>
        <div class = "col-6 col-lg-3">
            <div class = "app-card app-card-stat shadow-sm h-100">
                <div class = "app-card-body p-3 p-lg-4">
                    <h4 class = "stats-type mb-1">Achats</h4>
                    <div class = "stats-figure">{{$nbr_achats}}</div>
                    <div class = "stats-meta text-capitalize"> Achats créés</div>
                </div>
            </div>
        </div>
        <div class = "col-6 col-lg-3">
            <div class = "app-card app-card-stat shadow-sm h-100">
                <div class = "app-card-body p-3 p-lg-4">
                    <h4 class = "stats-type mb-1">Ventes</h4>
                    <div class = "stats-figure">{{$nbr_ventes}}</div>
                    <div class = "stats-meta text-capitalize"> Ventes créés</div>
                </div>
            </div>
        </div>
        <div class = "col-6 col-lg-3">
            <div class = "app-card app-card-stat shadow-sm h-100">
                <div class = "app-card-body p-3 p-lg-4">
                    <h4 class = "stats-type mb-1">Catégories</h4>
                    <div class = "stats-figure">{{$nbr_categories}}</div>
                    <div class = "stats-meta text-capitalize"> Catégories des articles</div>
                </div>
            </div>
        </div>
        <div class = "col-6 col-lg-3">
            <div class = "app-card app-card-stat shadow-sm h-100">
                <div class = "app-card-body p-3 p-lg-4">
                    <h4 class = "stats-type mb-1">Articles</h4>
                    <div class = "stats-figure">{{$nbr_articles}}</div>
                    <div class = "stats-meta text-capitalize"> Articles enregistrés</div>
                </div>
            </div>
        </div>
        <div class = "col-6 col-lg-3">
            <div class = "app-card app-card-stat shadow-sm h-100">
                <div class = "app-card-body p-3 p-lg-4">
                    <h4 class = "stats-type mb-1">Historiques</h4>
                    <div class = "stats-figure">{{$nbr_historiques_articles}}</div>
                    <div class = "stats-meta text-capitalize"> Historiques créés</div>
                </div>
            </div>
        </div>
    </div>
    <div class = "row g-4 mb-4">
        <div class = "col-12 col-lg-12">
            <div class = "app-card app-card-chart h-100 shadow-sm">
                <div class = "app-card-header p-3">
                    <div class = "row justify-content-between align-items-center">
                        <div class = "col-auto">
						    <h4 class = "app-card-title">Statistiques des ventes</h4>
						</div>
                        <div class = "col-auto">
							<div class = "card-header-action">
								<a href = "javascript:void(0)" style = "color:#F7941E">Par mois</a>
							</div>
						</div>
                    </div>
                </div>
                <div class = "app-card-body p-3 p-lg-4">
                    <div class = "chart-container">
				        @if($nbr_ventes < 1)
                            <p class = "text-center">Aucune vente n'a été créée ce mois-ci.</p>
                        @else
                            <div class = "mt-3" id = "curve_chart"></div>
                        @endif
					</div>
                </div>
            </div>
        </div>
    </div>
    <script src = "https://www.gstatic.com/charts/loader.js"></script>
    <script type = "text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Totale'],
                <?php echo $this->getPrixDate() ?>
            ]);
            var options = {
                pointSize: 10,
                title: 'Année: '+new Date().getFullYear(),
                curveType: 'function',
                legend: { position: 'bottom' },
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
        }
    </script>
</div>
