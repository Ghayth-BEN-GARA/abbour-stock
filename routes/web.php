<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthentificationUserController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\JournalController;
    use App\Http\Controllers\DemandeModificationTypeController;
    use App\Http\Controllers\FournisseurController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\AchatController;
    use App\Http\Controllers\StockController;
    use App\Http\Controllers\EmplacementController;

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
    Route::get('/erreur', [AuthentificationUserController::class, 'ouvrirError']);
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
    Route::get('/edit-profil', [UserController::class, 'ouvrirEditProfil'])->middleware('session_not_exist');
    Route::post('/update-profil', [UserController::class, 'gestionUpdateProfil']);
    Route::get('/journales', [JournalController::class, 'ouvrirJournales'])->middleware('session_not_exist');
    Route::get('/delete-journal', [JournalController::class, 'gestionDeleteJournalProfil']);
    Route::get('/add-user', [UserController::class, 'ouvrirAddUser'])->middleware('session_not_open_user');
    Route::post('/create-user', [UserController::class, 'gestionCreateUser']);
    Route::get('/edit-email', [UserController::class, 'ouvrirEditEmail'])->middleware('session_not_open_administrateur');
    Route::post('/update-email', [UserController::class, 'gestionUpdateEmail']);
    Route::get('/edit-type-compte', [UserController::class, 'ouvrirEditTypeCompte'])->middleware('session_not_open_administrateur');
    Route::post('/update-type-compte-user', [DemandeModificationTypeController::class, 'gestionCreateDemandeModificationType']);
    Route::get('/mes-demandes', [DemandeModificationTypeController::class, 'ouvrirMesDemandes'])->middleware('session_not_open_administrateur');
    Route::get('/delete-demande', [DemandeModificationTypeController::class, 'gestionDeleteDemande']);
    Route::get('/demande-update-type-compte', [DemandeModificationTypeController::class, 'ouvrirDemandeUpdateTypeCompte'])->middleware('session_not_open_user');
    Route::get('/gestion-modifier-etat-demande', [DemandeModificationTypeController::class, 'gestionAccepterRefuserDemande']);
    Route::get('/liste-demandes-modification-type-compte', [DemandeModificationTypeController::class, 'ouvrirListeDemandeModificationCompte'])->middleware('session_not_open_user');
    Route::get('/liste-users', [UserController::class, 'ouvrirListeUsers'])->middleware('session_not_open_user');
    Route::get('/user', [UserController::class, 'ouvrirUser'])->middleware('session_not_open_user');
    Route::get('/edit-user', [UserController::class, 'ouvrirEditUser'])->middleware('session_not_open_user');
    Route::post('/modifier-user', [UserController::class, 'gestionModifierUser']);
    Route::get('/add-fournisseur', [FournisseurController::class, 'ouvrirAddFournisseur'])->middleware('session_not_open_user');
    Route::post('/create-fourniseur', [FournisseurController::class, 'gestionCreerFournisseur']);
    Route::get('/liste-fournisseurs', [FournisseurController::class, 'ouvrirListeFournisseurs'])->middleware('session_not_open_user');
    Route::get('/fournisseur', [FournisseurController::class, 'ouvrirFournisseur'])->middleware('session_not_open_user');
    Route::get('/edit-fournisseur', [FournisseurController::class, 'ouvrirEditFournisseur'])->middleware('session_not_open_user');
    Route::post('/modifier-fournisseur', [FournisseurController::class, 'gestionModifierFournisseur']);
    Route::get('/add-client', [ClientController::class, 'ouvrirAddClient'])->middleware('session_not_open_user');
    Route::post('/create-client', [ClientController::class, 'gestionCreerClient']);
    Route::get('/liste-clients', [ClientController::class, 'ouvrirListeClients'])->middleware('session_not_open_user');
    Route::get('/client', [ClientController::class, 'ouvrirClient'])->middleware('session_not_open_user');
    Route::get('/edit-client', [ClientController::class, 'ouvrirEditClient'])->middleware('session_not_open_user');
    Route::post('/modifier-client', [ClientController::class, 'gestionModifierClient']);
    Route::get('/forget-password', [AuthentificationUserController::class, 'ouvrirForgetPassword'])->middleware('session_exist');
    Route::post('/chercher-compte', [AuthentificationUserController::class, 'gestionRecuperationCompte']);
    Route::get('/reset-password/{token}/{id}', [AuthentificationUserController::class, 'ouvrirResetPassword'])->middleware('session_exist');
    Route::post('/update-reset-password', [AuthentificationUserController::class, 'gestionUpdateResetPassword']);
    Route::get('/autres', [AchatController::class, 'ouvrirAutres'])->middleware('session_not_open_user');
    Route::post('/add-categorie', [AchatController::class, 'gestionAddCategorie']);
    Route::post('/add-article', [AchatController::class, 'gestionAddArticle']);
    Route::get('/import-stock', [StockController::class, 'ouvrirImportStock'])->middleware('session_not_open_user');
    Route::post('/import-file', [StockController::class, 'gestionImporterArticlesStock']);
    Route::get('/liste-article-disponible', [StockController::class, 'ouvrirListeArticleDisponible'])->middleware('session_not_exist');
    Route::get('/liste-stock', [StockController::class, 'ouvrirListStock'])->middleware('session_not_open_user');
    Route::get('/article', [StockController::class, 'ouvrirArticle'])->middleware('session_not_open_user');
    Route::get('/edit-article', [StockController::class, 'ouvrirEditArticle'])->middleware('session_not_open_user');
    Route::post('/update-article', [StockController::class, 'gestionUpdateArticle']);
    Route::get('/add-facture-achat', [AchatController::class, 'ouvrirAddFactureAchat'])->middleware('session_not_open_user');
    Route::get('/parametres', [UserController::class, 'ouvrirParametres'])->middleware('session_not_exist');
    Route::get('/update-state', [UserController::class, 'gestionUpdateState']);
    Route::post('/creer-facture-achat', [AchatController::class, 'gestionCreerFactureAchat']);
    Route::get('/add-articles-facture-achat', [AchatController::class, 'ouvrirAddArticleFactureAchat'])->middleware('session_not_open_user');
    Route::get('/autocomplete-designation-facture-achat', [AchatController::class, 'getArticleSearchByDesignation']);
    Route::get('/informations-article-search-designation', [AchatController::class, 'getInformationsArticleByDesignation']);
    Route::get('/autocomplete-reference-facture-achat', [AchatController::class, 'getArticleSearchByReference']);
    Route::get('/informations-article-search-reference', [AchatController::class, 'getInformationsArticleByReference']);
    Route::post('/creer-articles-facture-achat', [AchatController::class, 'storeArticlesToFactureAchat']);
    Route::post('/valider-new-prix-article', [AchatController::class, 'gestionValidationNewPrixAchat']);
    Route::get('/add-emplacement-article', [EmplacementController::class, 'ouvrirAddEmplacementArticle'])->middleware('session_not_open_user');
?>

