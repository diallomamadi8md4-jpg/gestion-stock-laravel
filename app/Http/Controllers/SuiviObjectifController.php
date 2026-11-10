<?php
namespace App\Http\Controllers;

use App\Models\SuiviObjectif;


class SuiviObjectifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Charger les suivis avec leurs relations (objectif, utilisateur, produit)
        $suivis = SuiviObjectif::with(['objectif.utilisateur', 'objectif.produit'])->get();

        // Envoyer les données à la vue
        return view('suivis.index', compact('suivis'));
    }
}
