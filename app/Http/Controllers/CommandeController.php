<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\PointVente;
use App\Models\Stock;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['pointVente', 'produit'])->get();
        $pointsVente = PointVente::all();
        $produits = Produit::all();

        return view('commandes.index', compact('commandes', 'pointsVente', 'produits'));
    }

    public function create()
    {
        $pointsVente = PointVente::all();
        $produits = Produit::all();

        return view('commandes.create', compact('pointsVente', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'pro_id' => 'required|exists:produits,pro_id',
            'quantite' => 'required|integer|min:1',
            'prix_total' => 'nullable|numeric',
            'date_livraison' => 'nullable|date',
            'etat' => 'required|in:en attente,livré,annulé',
        ]);

        $commande = Commande::create($request->all());

        // Si la commande est directement créée en "livré"
        if ($commande->etat === 'livré') {
            if (!$this->soustraireStock($commande)) {
                return back()->withErrors(['Stock insuffisant pour livrer cette commande.']);
            }
        }

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès.');
    }

    public function edit(Commande $commande)
    {
        $pointsVente = PointVente::all();
        $produits = Produit::all();

        return view('commandes.edit', compact('commande', 'pointsVente', 'produits'));
    }

    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'pro_id' => 'required|exists:produits,pro_id',
            'quantite' => 'required|integer|min:1',
            'prix_total' => 'nullable|numeric',
            'date_livraison' => 'nullable|date',
            'etat' => 'required|in:en attente,livré,annulé',
        ]);

        // Si la commande passe à "livré" et n’était pas déjà livrée
        if ($request->etat === 'livré' && $commande->etat !== 'livré') {
            $commande->fill($request->all());

            if (!$this->soustraireStock($commande)) {
                return back()->withErrors(['Stock insuffisant pour livrer cette commande.']);
            }

            // Sauvegarde après soustraction
            $commande->save();
        } else {
            // Mise à jour normale
            $commande->update($request->all());
        }

        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès.');
    }

    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée.');
    }

    public function enAttente()
    {
        $commandes = Commande::with(['pointVente', 'produit'])
            ->where('etat', 'en attente')
            ->get();

        return view('commandes.en_attente', compact('commandes'));
    }

    public function livrees()
    {
        $commandes = Commande::with(['pointVente', 'produit'])
            ->where('etat', 'livré')
            ->get();

        return view('commandes.livrees', compact('commandes'));
    }

    public function annulees()
    {
        $commandes = Commande::with(['pointVente', 'produit'])
            ->where('etat', 'annulé')
            ->get();

        return view('commandes.annulees', compact('commandes'));
    }

    /**
     * Méthode privée pour soustraire le stock
     */
    private function soustraireStock(Commande $commande)
    {
        $stock = Stock::where('pro_id', $commande->pro_id)->first();

        if ($stock) {
            if ($stock->quantite < $commande->quantite) {
                return false;
            }

            $stock->quantite -= $commande->quantite;
            $stock->save();
        }

        return true;
    }
}
