<?php

namespace App\Http\Controllers;

use App\Models\PointVente;
use Illuminate\Http\Request;

class PointVenteController extends Controller
{
    /**
     * Afficher la liste des points de vente
     */
    public function index()
    {
        $point_ventes = PointVente::all();
        return view('point_ventes.index', compact('point_ventes'));
    }

    /**
     * Formulaire d'ajout
     */
    public function create()
    {
        return view('point_ventes.create');
    }

    /**
     * Enregistrer un nouveau point de vente
     */
    public function store(Request $request)
    {
        $request->validate([
            'pve_nom' => 'required|string|max:255',
            'pve_adresse' => 'required|string|max:255',
            'etat' => 'in:actif,inactif,fermé'
        ]);

        PointVente::create($request->all());

        return redirect()->route('point_ventes.index')->with('success', 'Point de vente ajouté avec succès !');
    }

    /**
     * Afficher un point de vente
     */
    public function show($id)
    {
        $point_vente = PointVente::findOrFail($id);
        return view('point_ventes.show', compact('point_vente'));
    }

    /**
     * Formulaire de modification
     */
    public function edit($id)
    {
        $point_vente = PointVente::findOrFail($id);
        return view('point_ventes.edit', compact('point_vente'));
    }

    /**
     * Mettre à jour un point de vente
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pve_nom' => 'required|string|max:255',
            'pve_adresse' => 'required|string|max:255',
            'etat' => 'in:actif,inactif,fermé'
        ]);

        $point_vente = PointVente::findOrFail($id);
        $point_vente->update($request->all());

        return redirect()->route('point_ventes.index')->with('success', 'Point de vente mis à jour avec succès !');
    }

    /**
     * Supprimer un point de vente
     */
    public function destroy($id)
    {
        $point_vente = PointVente::findOrFail($id);
        $point_vente->delete();

        return redirect()->route('point_ventes.index')->with('success', 'Point de vente supprimé avec succès !');
    }
}
