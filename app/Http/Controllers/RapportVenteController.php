<?php

namespace App\Http\Controllers;

use App\Models\RapportVente;
use App\Models\Vente;
use App\Models\PointVente;
use Illuminate\Http\Request;

class RapportVenteController extends Controller
{
    // Liste des rapports
    public function index()
    {
        $rapports = RapportVente::with('pointVente')->get();
        return view('rapport_ventes.index', compact('rapports'));
    }

    // Formulaire de création
    public function create()
    {
        $pointsVente = PointVente::all();
        return view('rapport_ventes.create', compact('pointsVente'));
    }

    // Générer et enregistrer un rapport
    public function store(Request $request)
    {
        $request->validate([
            'pve_id' => 'required|exists:point_ventes,pve_id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        // Récupérer les ventes du point de vente sur la période
        $ventes = Vente::where('pve_id', $request->pve_id)
                       ->whereBetween('created_at', [$request->date_debut, $request->date_fin])
                       ->get();

        $total = $ventes->sum('prix_total');
        $nbVentes = $ventes->count();
        $quantiteTotale = $ventes->sum('quantite');

        // Créer le rapport
        $rapport = RapportVente::create([
            'pve_id' => $request->pve_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'total' => $total,
            'nb_ventes' => $nbVentes,
            'quantite_totale' => $quantiteTotale,
            'statut' => 'provisoire',
        ]);

        return redirect()->route('rapport_ventes.index')->with('success', 'Rapport généré avec succès.');
    }

    // Afficher un rapport
    public function show($id)
    {
        $rapport = RapportVente::with('pointVente')->findOrFail($id);
        return view('rapport_ventes.show', compact('rapport'));
    }

    // Formulaire d’édition
    public function edit($id)
    {
        $rapport = RapportVente::findOrFail($id);
        $pointsVente = PointVente::all();
        return view('rapport_ventes.edit', compact('rapport', 'pointsVente'));
    }

    // Mise à jour d’un rapport
    public function update(Request $request, $id)
    {
        $rapport = RapportVente::findOrFail($id);

         $rapport->update([
        'statut' => $request->input('statut', $rapport->statut),
        ]);

        $rapport->update($request->all());

        return redirect()->route('rapport_ventes.index')->with('success', 'Rapport mis à jour avec succès.');
    }

    // Suppression d’un rapport
    public function destroy($id)
    {
        $rapport = RapportVente::findOrFail($id);
        $rapport->delete();

        return redirect()->route('rapport_ventes.index')->with('success', 'Rapport supprimé avec succès.');
    }
}
