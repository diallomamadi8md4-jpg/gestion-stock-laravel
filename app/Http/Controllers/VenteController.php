<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produit;
use App\Models\PointVente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    // Liste des ventes
    public function index()
    {
        $ventes = Vente::with(['produit', 'pointVente'])->get();
        return view('ventes.index', compact('ventes'));
    }

    // Formulaire de création
    public function create()
    {
        $produits = Produit::with('stock')->get();
        $pointsVente = PointVente::all();
        return view('ventes.create', compact('produits', 'pointsVente'));
    }

    // Enregistrer une vente
    public function store(Request $request)
    {
        $request->validate([
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'pro_id' => 'required|exists:produits,pro_id',
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $produit = Produit::with('stock')->findOrFail($request->pro_id);

        if (!$produit->stock) {
            return back()->with('error', 'Ce produit n’a pas encore de stock enregistré.');
        }

        if ($request->quantite > $produit->stock->quantite) {
            return back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        $prixUnitaire = $request->prix_unitaire;
        $prixTotal = $prixUnitaire * $request->quantite;

        $vente = Vente::create([
            'pve_id' => $request->pve_id,
            'pro_id' => $request->pro_id,
            'quantite' => $request->quantite,
            'prix_unitaire' => $prixUnitaire,
            'prix_total' => $prixTotal,
        ]);

        $produit->stock->decrement('quantite', $request->quantite);

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès et stock mis à jour.');
    }

    // Détail d’une vente
    public function show($id)
    {
        $vente = Vente::with(['produit', 'pointVente'])->findOrFail($id);
        return view('ventes.show', compact('vente'));
    }

    // Formulaire d’édition
    public function edit($id)
    {
        $vente = Vente::findOrFail($id);
        $produits = Produit::with('stock')->get();
        $pointsVente = PointVente::all();
        return view('ventes.edit', compact('vente', 'produits', 'pointsVente'));
    }

    // Mise à jour d’une vente
    public function update(Request $request, $id)
    {
        $request->validate([
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'pro_id' => 'required|exists:produits,pro_id',
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $produit = Produit::with('stock')->findOrFail($request->pro_id);
        $vente = Vente::findOrFail($id);

        if (!$produit->stock) {
            return back()->with('error', 'Ce produit n’a pas encore de stock enregistré.');
        }

        // Réajuster le stock : remettre l’ancienne quantité
        $produit->stock->increment('quantite', $vente->quantite);

        if ($request->quantite > $produit->stock->quantite) {
            return back()->with('error', 'Stock insuffisant pour ce produit.');
        }

        $prixUnitaire = $request->prix_unitaire;
        $prixTotal = $prixUnitaire * $request->quantite;

        $vente->update([
            'pve_id' => $request->pve_id,
            'pro_id' => $request->pro_id,
            'quantite' => $request->quantite,
            'prix_unitaire' => $prixUnitaire,
            'prix_total' => $prixTotal,
        ]);

        $produit->stock->decrement('quantite', $request->quantite);

        return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès et stock ajusté.');
    }

    // Suppression d’une vente
    public function destroy($id)
    {
        $vente = Vente::findOrFail($id);

        if ($vente->produit && $vente->produit->stock) {
            $vente->produit->stock->increment('quantite', $vente->quantite);
        }

        $vente->delete();

        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès et stock réajusté.');
    }
}
