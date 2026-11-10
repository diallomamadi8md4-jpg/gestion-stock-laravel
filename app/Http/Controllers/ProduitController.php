<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    // Affiche la liste des produits
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    // Affiche le formulaire d'ajout
    public function create()
    {
        return view('produits.create');
    }

    // Enregistre un nouveau produit
    public function store(Request $request)
    {
        $request->validate([
            'pro_nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')
                         ->with('success', 'Produit ajouté avec succès.');
    }

    // Affiche le formulaire de modification
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.edit', compact('produit'));
    }

    // Met à jour un produit
    public function update(Request $request, $id)
    {
        $request->validate([
            'pro_nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->update($request->all());

        return redirect()->route('produits.index')
                         ->with('success', 'Produit modifié avec succès.');
    }

    // Supprime un produit
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')
                         ->with('success', 'Produit supprimé avec succès.');
    }
}
