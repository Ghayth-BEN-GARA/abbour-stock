<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\EtatImportation;
    use App\Models\Article;
    use App\Models\Stock;
    use App\Models\Categorie;
    use App\Models\FactureArticleAchat;
    use App\Models\EmplacementArticle;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Exception;
    use PhpOffice\PhpSpreadsheet\Writer\Xls;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    class StockController extends Controller{
        public function ouvrirImportStock(){
            $etat = $this->getEtatImportation();
            return view('Stock.import_stock', compact('etat'));
        }

        public function getEtatImportation(){
            return EtatImportation::first();
        }

        public function gestionImporterArticlesStock(Request $request){
            $file = $request->file('stock');

            try {
                $spreadsheet = IOFactory::load($file->getRealPath());
                $sheet = $spreadsheet->getActiveSheet();
                $row_limit = $sheet->getHighestDataRow();
                $column_limit = $sheet->getHighestDataColumn();
                $row_range = range( 2, $row_limit );
                $column_range = range( 'A', $column_limit );
                $startcount = 2;
                $liste_articles = array();
                $liste_emplacements = array();
                $liste_stock = array();

                foreach ($row_range  as $row ) {
                    if((int) $sheet->getCell( 'B' . $row)->getValue() != null && (int) $sheet->getCell( 'B' . $row)->getValue() != "" && (int) $sheet->getCell( 'B' . $row)->getValue() != 0){
                        if($sheet->getCell( 'C' . $row)->getValue() == "" && $sheet->getCell( 'C' . $row)->getValue() == null){
                            $designation = "Aucun";
                        }
    
                        else{
                            $designation = $sheet->getCell( 'C' . $row)->getValue();
                        }

                        if($sheet->getCell( 'D' . $row)->getValue() == "" && $sheet->getCell( 'D' . $row)->getValue() == null){
                            $description = "Aucun";
                        }
    
                        else{
                            $description = $sheet->getCell( 'D' . $row)->getValue();
                        }

                        if($sheet->getCell( 'I' . $row)->getValue() == "" && $sheet->getCell( 'I' . $row)->getValue() == null){
                            $emplacement = "Aucun";
                        }
    
                        else{
                            $emplacement = $sheet->getCell( 'I' . $row)->getValue();
                        }

                        $liste_articles[] = [
                            'reference_article' => (int) $sheet->getCell( 'B' . $row)->getValue(),
                            'designation' => $designation,
                            'description' => $description,
                            'categorie' => 'Aucun',
                        ];

                        if(!$this->checkEmplacementExiste($sheet->getCell( 'I' . $row)->getValue())){
                            $liste_emplacements[] = [
                                'emplacement_article_creer' => $emplacement,
                                'reference_article' => (int) $sheet->getCell( 'B' . $row)->getValue(),
                            ];
                        }

                        $liste_stock[] = [
                            'quantite_stock' => (int) $sheet->getCell( 'K' . $row)->getCalculatedValue(),
                            'prix_achat_article' => str_replace('DT', '', trim($sheet->getCell( 'F' . $row)->getFormattedValue())),
                            'marge_prix' => str_replace('%', '', trim($sheet->getCell( 'H' . $row)->getFormattedValue())),
                            'reference_article' => (int) $sheet->getCell( 'B' . $row)->getValue(),
                        ];
    
                        $startcount ++;
                    }                   
                }

                if(Article::insert($liste_articles)){
                    EmplacementArticle::insert($liste_emplacements);
                    Stock::insert($liste_stock);
                    $this->updateEtatImportation();
                    return back()->with('success',"Le stock d'articles a été rempli avec succès. Vous pouvez l'utiliser maintenant dans les ventes et les achats.");
                }
    
                else{
                    return redirect('/erreur');
                }
            }
            
            catch(Illuminate\Database\QueryException $e){
                return back()->with('erreur', 'Pour des raisons techniques, vous ne pouvez pas importer la liste des articles.');
            }
        }

        public function checkEmplacementExiste($emplacement){
            return EmplacementArticle::where("emplacement_article_creer", "=", $emplacement)->exists();
        }

        public function updateEtatImportation(){
            return EtatImportation::where('etat_importation_article', '=', 0)->update([
                'etat_importation_article' => 1
            ]);
        }

        public function ouvrirListeArticleDisponible(){
            return view('Stock.liste_articles_disponible');
        }

        public function ouvrirListStock(){
            return view('Stock.liste_stock');
        }

        public function ouvrirArticle(Request $request){
            $article = $this->getDetailsArticle($request->input('reference_article'));
            return view('Stock.article', compact('article'));
        }

        public function getDetailsArticle($reference_article){
            return Stock::join('articles', 'articles.reference_article', '=', 'stocks.reference_article')
            ->where('articles.reference_article', '=', $reference_article)->first();
        }
        
        public function ouvrirEditArticle(Request $request){
            $article = $this->getDetailsArticle($request->input('reference_article'));
            $last_reference = $this->getLastReferenceArticle();
            $categories = $this->listeCategorie();
            return view('Stock.edit_article', compact('article' , 'last_reference', 'categories'));
        }

        public function getLastReferenceArticle(){
            if(Article::count() == 0){
                return 0;
            }

            else{
                return Article::orderBy('reference_article','desc')->first()->getReferenceArticleAttribute();
            }
        }

        public function listeCategorie(){
            return Categorie::all();
        }

        public function gestionUpdateArticle(Request $request){
            if($this->updateArticle($request->reference, $request->designation, $request->description, $request->categorie, $request->prix_achat, $request->marge)){
                return back()->with('success',"L'article a été modifié avec succès. Vous pouvez l'utiliser maintenant dans les ventes et les achats.");
            }

            else{
                return redirect('/erreur');
            }
        }

        public function updateArticle($reference_article, $designation, $description, $categorie, $prix_achat, $marge){
            return Article::join('stocks','articles.reference_article','=','stocks.reference_article')
                ->where('articles.reference_article', '=', $reference_article)
                ->update([
                    'designation' => $designation, 
                    'description' => $description, 
                    'categorie' => $categorie,
                    'prix_achat_article' => $prix_achat, 
                    'marge_prix' => $marge
                ]);
        }
    }
?>
