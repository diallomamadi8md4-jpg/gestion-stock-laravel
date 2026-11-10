<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\PointVenteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RapportVenteController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ReapprovisionnementController;
use App\Http\Controllers\ObjectifCommercialController;
use App\Http\Controllers\SuiviObjectifController;
use App\Http\Controllers\ProspectionController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\TacheController;

/*
|--------------------------------------------------------------------------
| Splash Screen (Page d'ouverture)
|--------------------------------------------------------------------------
|
| Cette route affiche ton logo BAROUELI-TECH pendant 2,5 secondes
| avant de rediriger vers la page d'accueil.
|
*/

Route::get('/', function () {
    return view('splash');
})->name('splash');


/*
|--------------------------------------------------------------------------
| Accueil (protégé par authentification)
|--------------------------------------------------------------------------
*/

Route::get('/accueil', function () {
    return view('accueil');
})->middleware('auth')->name('accueil');


/*
|--------------------------------------------------------------------------
| Routes protégées par authentification
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Point de Vente
    Route::resource('point_ventes', PointVenteController::class);

    // Produits
    Route::resource('produits', ProduitController::class);

    // Stocks
    Route::get('stocks/alertes', [StockController::class, 'alertes'])->name('stocks.alertes');
    Route::resource('stocks', StockController::class);

    // Ventes
    Route::resource('ventes', VenteController::class);

    // Rapports de ventes
    Route::resource('rapport_ventes', RapportVenteController::class);

    // Utilisateurs
    Route::resource('utilisateurs', UtilisateurController::class);
    Route::get('utilisateurs/export', [UtilisateurController::class, 'export'])->name('utilisateurs.export');

    // Commandes
    Route::get('commandes/en-attente', [CommandeController::class, 'enAttente'])->name('commandes.en_attente');
    Route::get('commandes/livrees', [CommandeController::class, 'livrees'])->name('commandes.livrees');
    Route::get('commandes/annulees', [CommandeController::class, 'annulees'])->name('commandes.annulees');
    Route::resource('commandes', CommandeController::class);

    // Réapprovisionnements
    Route::resource('reapprovisionnements', ReapprovisionnementController::class);

    // Objectifs commerciaux
    Route::resource('objectifs', ObjectifCommercialController::class);

    // Suivi des objectifs
    Route::resource('suivis', SuiviObjectifController::class);

    
    // Prospections
    Route::resource('prospections', ProspectionController::class);

    // Visites
    Route::resource('visites', VisiteController::class);

    // taches
    Route::resource('taches', TacheController::class);

});


/*
|--------------------------------------------------------------------------
| Routes publiques (authentification)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

