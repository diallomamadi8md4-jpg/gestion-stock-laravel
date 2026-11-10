<?php

namespace App\Http\Controllers;

use App\Models\ObjectifCommercial;
use App\Models\Utilisateur;
use App\Models\Produit;
use App\Models\SuiviObjectif;
use Illuminate\Http\Request;

class ObjectifCommercialController extends Controller
{
    /**
     * Liste des objectifs commerciaux
     */
    public function index()
    {
        $objectifs = ObjectifCommercial::with(['utilisateur', 'produit'])->get();
        return view('objectifs.index', compact('objectifs'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $utilisateurs = Utilisateur::all();
        $produits = Produit::all();
        return view('objectifs.create', compact('utilisateurs', 'produits'));
    }

    /**
     * Enregistre un nouvel objectif
     */
    public function store(Request $request)
{
    $request->validate([
        'uti_id' => 'required|exists:utilisateurs,uti_id',
        'pro_id' => 'nullable|exists:produits,pro_id',
        'type' => 'required|in:ventes,visites,prospections',
        'quantite' => 'nullable|integer|min:1',
        'valeur_cible' => 'nullable|numeric|min:0',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'etat' => 'required|in:en cours,atteint,non atteint',
    ]);

    // Créer l'objectif
    $objectif = ObjectifCommercial::create($request->all());

    // Créer un suivi initial automatiquement
    SuiviObjectif::create([
        'obc_id' => $objectif->obc_id,
        'date_suivi' => now(),
        'quantite_realisee' => 0,
        'valeur_realisee' => 0,
        'commentaire' => 'Suivi initial automatique'
    ]);

    return redirect()->route('objectifs.index')
        ->with('success', 'Objectif commercial enregistré avec suivi initial.');
}


    /**
     * Affiche un objectif
     */
    public function show(ObjectifCommercial $objectif)
    {
        return view('objectifs.show', compact('objectif'));
    }

    /**
     * Formulaire d’édition
     */
    public function edit(ObjectifCommercial $objectif)
    {
        $utilisateurs = Utilisateur::all();
        $produits = Produit::all();
        return view('objectifs.edit', compact('objectif', 'utilisateurs', 'produits'));
    }

    /**
     * Mise à jour d’un objectif
     */
    public function update(Request $request, ObjectifCommercial $objectif)
    {
        $request->validate([
            'uti_id' => 'required|exists:utilisateurs,uti_id',
            'pro_id' => 'nullable|exists:produits,pro_id',
            'type' => 'required|in:ventes,visites,prospections',
            'quantite' => 'nullable|integer|min:1',
            'valeur_cible' => 'nullable|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'etat' => 'required|in:en cours,atteint,non atteint',
        ]);

        $objectif->update($request->all());

        return redirect()->route('objectifs.index')
            ->with('success', 'Objectif commercial mis à jour avec succès.');
    }

    /**
     * Supprime un objectif
     */
    public function destroy(ObjectifCommercial $objectif)
    {
        $objectif->delete();
        return redirect()->route('objectifs.index')
            ->with('success', 'Objectif commercial supprimé avec succès.');
    }
}
