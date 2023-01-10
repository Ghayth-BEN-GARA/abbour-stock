<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Article;
    use App\Models\Stock;
    use App\Models\EmplacementArticle;

    class EmplacementController extends Controller{
        public function ouvrirAddEmplacementArticle(Request $request){
            $details_article = $this->getDetailsArticle($request->input('reference_article'));

            return view("Emplacements.add_emplacement_article", compact("details_article"));
        }

        public function getDetailsArticle($reference_article){
            return Article::where('reference_article', '=', $reference_article)->first();
        }
    }
?>
