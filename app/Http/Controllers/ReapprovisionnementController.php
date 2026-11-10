<?php

namespace App\Http\Controllers;

use App\Models\Reapprovisionnement;
use App\Models\PointVente;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Vente;
use Illuminate\Http\Request;

class ReapprovisionnementController extends Controller
{
    /**
     * Liste des réapprovisionnements
     */
    public function index()
    {
        $reapprovisionnements = Reapprovisionnement::with(['pointVente', 'produit'])->get();
        return view('reapprovisionnements.index', compact('reapprovisionnements'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $pointsVente = PointVente::all();
        $produits = Produit::all();
        return view('reapprovisionnements.create', compact('pointsVente', 'produits'));
    }

    /**
     * Enregistre un nouveau réapprovisionnement
     */
    public function store(Request $request)
    {
        $request->validate([
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'pro_id' => 'required|exists:produits,pro_id',
            'quantite' => 'required|integer|min:1',
            'type' => 'required|in:automatique,manuel',
        ]);

        // 1. Enregistrer le réapprovisionnement
        $rea = Reapprovisionnement::create($request->all());

        // 2. Mettre à jour ou créer le stock du bon point de vente
        $stock = Stock::where('pro_id', $rea->pro_id)
                      ->where('pve_id', $rea->pve_id)
                      ->first();

        if ($stock) {
            $stock->quantite += $rea->quantite;
            $stock->save();
        } else {
            Stock::create([
                'pve_id'   => $rea->pve_id,
                'pro_id'   => $rea->pro_id,
                'quantite' => $rea->quantite,
            ]);
        }

        return redirect()->route('reapprovisionnements.index')
            ->with('success', 'Réapprovisionnement enregistré et stock mis à jour.');
    }

    /**
     * Affiche un réapprovisionnement
     */
    public function show(Reapprovisionnement $reapprovisionnement)
    {
        return view('reapprovisionnements.show', compact('reapprovisionnement'));
    }

    /**
     * Formulaire d’édition
     */
    public function edit(Reapprovisionnement $reapprovisionnement)
    {
        $pointsVente = PointVente::all();
        $produits = Produit::all();
        return view('reapprovisionnements.edit', compact('reapprovisionnement', 'pointsVente', 'produits'));
    }

    /**
     * Mise à jour d’un réapprovisionnement
     */
    public function update(Request $request, Reapprovisionnement $reapprovisionnement)
    {
        $request->validate([
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'pro_id' => 'required|exists:produits,pro_id',
            'quantite' => 'required|integer|min:1',
            'type' => 'required|in:automatique,manuel',
        ]);

        // ⚡ Vérifier s'il y a eu des ventes après ce réapprovisionnement
        $ventes = Vente::where('pro_id', $reapprovisionnement->pro_id)
            ->where('created_at', '>=', $reapprovisionnement->created_at)
            ->count();

        if ($ventes > 0) {
            return redirect()->route('reapprovisionnements.index')
                ->with('error', 'Impossible de modifier ce réapprovisionnement car des ventes ont déjà été enregistrées.');
        }

        // Calcul de la différence de quantité
        $ancienneQuantite = $reapprovisionnement->quantite;
        $reapprovisionnement->update($request->all());

        $difference = $reapprovisionnement->quantite - $ancienneQuantite;

        // Mise à jour du stock du bon point de vente
        $stock = Stock::where('pro_id', $reapprovisionnement->pro_id)
                      ->where('pve_id', $reapprovisionnement->pve_id)
                      ->first();

        if ($stock) {
            $stock->quantite += $difference;
            $stock->save();
        } else {
            Stock::create([
                'pve_id'   => $reapprovisionnement->pve_id,
                'pro_id'   => $reapprovisionnement->pro_id,
                'quantite' => $reapprovisionnement->quantite,
            ]);
        }

        return redirect()->route('reapprovisionnements.index')
            ->with('success', 'Réapprovisionnement mis à jour et stock ajusté.');
    }

    /**
     * Supprime un réapprovisionnement
     */
    public function destroy(Reapprovisionnement $reapprovisionnement)
    {
        // Retirer la quantité du stock avant suppression
        $stock = Stock::where('pro_id', $reapprovisionnement->pro_id)
                      ->where('pve_id', $reapprovisionnement->pve_id)
                      ->first();

        if ($stock) {
            $stock->quantite -= $reapprovisionnement->quantite;
            if ($stock->quantite < 0) {
                $stock->quantite = 0; // sécurité pour éviter les valeurs négatives
            }
            $stock->save();
        }

        $reapprovisionnement->delete();

        return redirect()->route('reapprovisionnements.index')
            ->with('success', 'Réapprovisionnement supprimé et stock ajusté.');
    }
}
