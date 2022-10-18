<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;

    class AuthentificationUserController extends Controller{
        
        public function ouvrirSignin(){
            return view('Authentification.signin');
        }
    }
?>
