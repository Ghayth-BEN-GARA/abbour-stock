<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\EtatImportation;
    use App\Models\Article;
    use App\Models\Stock;
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
                $data1 = array();
                $data2 = array();

                foreach ($row_range  as $row ) {
                    if($sheet->getCell( 'A' . $row)->getValue()){
                        $reference_article = (int) $sheet->getCell( 'A' . $row)->getValue();
                    
                        if($sheet->getCell( 'C' . $row)->getValue() == null){
                            $description_article = "Aucun";
                        }
    
                        else{
                            $description_article = $sheet->getCell( 'C' . $row)->getValue();
                        }
    
                        $data1[] = [
                            'reference_article' => $reference_article,
                            'designation' => $sheet->getCell( 'B' . $row)->getValue(),
                            'description' => $description_article,
                            'categorie' => 'Aucun',
                        ];
    
                        $data2[] = [
                            'quantite_stock' => $sheet->getCell( 'E' . $row)->getCalculatedValue(),
                            'prix_achat_article' => str_replace('DT', '',  $sheet->getCell( 'G' . $row)->getFormattedValue()),
                            'marge_prix' => str_replace('%', '', $sheet->getCell( 'H' . $row)->getFormattedValue()),
                            'reference_article' => $reference_article,
                        ];
    
                        $startcount ++;
                    }

                    else{
                        $startcount ++;
                    }
                }

                if(Article::insert($data1)){
                    if(Stock::insert($data2)){
                        $this->updateEtatImportation();
                        return back()->with('success',"Le stock d'articles a été rempli avec succès. Vous pouvez l'utiliser maintenant dans les ventes et les achats.");
                    }
    
                    else{
                        return redirect('/erreur');
                    }
                }
    
                else{
                    return redirect('/erreur');
                }
            }
            
            catch(Illuminate\Database\QueryException $e){
                return back()->with('erreur', 'Pour des raisons techniques, vous ne pouvez pas importer la liste des articles.');
            }
        }

        public function updateEtatImportation(){
            return EtatImportation::where('etat_importation_article', '=', 0)->update([
                'etat_importation_article' => 1
            ]);
        }
    }
?>
