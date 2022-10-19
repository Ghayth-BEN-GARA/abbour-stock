<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthentificationUserController;
    use App\Http\Controllers\UserController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', [AuthentificationUserController::class, 'ouvrirSignin'])->middleware('session_exist');
    Route::get('/signup', [AuthentificationUserController::class, 'ouvrirNotExist']);
    Route::post('/login', [AuthentificationUserController::class, 'gestionConnexion']);
    Route::get('/home', [AuthentificationUserController::class, 'ouvrirHome'])->middleware('session_not_exist');
    Route::get('/logout', [AuthentificationUserController::class, 'gestionDeconnexion']);
    Route::get('/error', [AuthentificationUserController::class, 'ouvrirError']);
    Route::get('/profil', [UserController::class, 'ouvrirProfil'])->middleware('session_not_exist');
    Route::get('/edit-password', [UserController::class, 'ouvrirEditPassword'])->middleware('session_not_exist');
    Route::post('/update-password', [UserController::class, 'gestionUpdatePassword']);
    Route::get('/edit-preferences', [UserController::class, 'ouvrirEditPreferences'])->middleware('session_not_exist');
    Route::get('/edit-photo', [UserController::class, 'ouvrirEditPhoto'])->middleware('session_not_exist');
    Route::post('/update-photo', [UserController::class, 'gestionUpdatePhoto']);
    Route::get('/edit-name', [UserController::class, 'ouvrirEditName'])->middleware('session_not_exist');
    Route::post('/update-fullname', [UserController::class, 'gestionUpdateFullName']);
    Route::get('/edit-genre', [UserController::class, 'ouvrirEditGenre'])->middleware('session_not_exist');
    Route::post('/update-genre', [UserController::class, 'gestionUpdateGenre']);
    Route::get('/edit-date-naissance', [UserController::class, 'ouvrirEditDateNaissance'])->middleware('session_not_exist');
    Route::post('/update-date-naissance', [UserController::class, 'gestionUpdateDateNaissance']);
    Route::get('/edit-adresse', [UserController::class, 'ouvrirEditAdresse'])->middleware('session_not_exist');
    Route::post('/update-adresse', [UserController::class, 'gestionUpdateAdresse']);
    Route::get('/edit-mobile', [UserController::class, 'ouvrirEditMobile'])->middleware('session_not_exist');
    Route::post('/update-mobile', [UserController::class, 'gestionUpdateMobile']);
    Route::get('/edit-cin', [UserController::class, 'ouvrirEditCin'])->middleware('session_not_exist');
    Route::post('/update-cin', [UserController::class, 'gestionUpdateCin']);
?>

