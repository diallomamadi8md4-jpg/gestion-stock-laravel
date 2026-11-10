<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Produit;
use App\Models\PointVente;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // Liste des stocks
    public function index()
    {
        $stocks = Stock::with(['produit', 'pointVente'])->get();
        return view('stocks.index', compact('stocks'));
    }

    // Formulaire d'ajout
    public function create()
    {
        $produits = Produit::all();
        $pointsVente = PointVente::all();
        return view('stocks.create', compact('produits', 'pointsVente'));
    }

    // Enregistrement
    public function store(Request $request)
    {
        $request->validate([
            'pro_id' => 'required|exists:produits,pro_id',
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'quantite' => 'required|integer|min:0',
            'seuil_minimum' => 'nullable|integer|min:0',
        ]);

        Stock::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock ajouté avec succès !');
    }

    // Formulaire de modification
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $produits = Produit::all();
        $pointsVente = PointVente::all();
        return view('stocks.edit', compact('stock', 'produits', 'pointsVente'));
    }

    // Mise à jour
    public function update(Request $request, $id)
    {
        $request->validate([
            'pro_id' => 'required|exists:produits,pro_id',
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'quantite' => 'required|integer|min:0',
            'seuil_minimum' => 'nullable|integer|min:0',
        ]);

        $stock = Stock::findOrFail($id);
        $stock->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès !');
    }

    // Suppression
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès !');
    }

    public function alertes()
    {
    // Récupère les stocks dont la quantité est inférieure au seuil minimum
    $stocks = Stock::with(['produit', 'pointVente'])
        ->whereColumn('quantite', '<', 'seuil_minimum')
        ->get();

    return view('stocks.alertes', compact('stocks'));
    }

    public function show($id)
    {
    $stock = Stock::with(['produit', 'pointVente'])->findOrFail($id);
    return view('stocks.show', compact('stock'));
    }


}
