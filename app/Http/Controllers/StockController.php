<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\EtatImportation;

    class StockController extends Controller{
        public function ouvrirImportStock(){
            $etat = $this->getEtatImportation();
            return view('Stock.import_stock', compact('etat'));
        }

        public function getEtatImportation(){
            return EtatImportation::first();
        }
    }
?>
