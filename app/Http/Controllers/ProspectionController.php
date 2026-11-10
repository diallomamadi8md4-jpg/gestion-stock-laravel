<?php
namespace App\Http\Controllers;

use App\Models\Prospection;
use Illuminate\Http\Request;

class ProspectionController extends Controller
{
    public function index()
    {
        $prospections = Prospection::all();
        return view('prospections.index', compact('prospections'));
    }

    public function create()
    {
        return view('prospections.create');
    }

    public function store(Request $request)
{
    Prospection::create([
        'uti_id'   => auth()->user()->uti_id, // récupère l’utilisateur connecté
        'npvp'     => $request->npvp,
        'adresse'  => $request->adresse,
        'telephone'=> $request->telephone,
        'statut'   => $request->statut,
        'remarques'=> $request->remarques,
    ]);

    return redirect()->route('prospections.index')->with('success', 'Prospection ajoutée avec succès');
}


    public function show($id)
    {
        $prospection = Prospection::findOrFail($id);
        return view('prospections.show', compact('prospection'));
    }

    public function edit($id)
    {
        $prospection = Prospection::findOrFail($id);
        return view('prospections.edit', compact('prospection'));
    }

    public function update(Request $request, $id)
    {
        $prospection = Prospection::findOrFail($id);
        $prospection->update($request->all());
        return redirect()->route('prospections.index')->with('success', 'Prospection mise à jour');
    }

    public function destroy($id)
    {
        $prospection = Prospection::findOrFail($id);
        $prospection->delete();
        return redirect()->route('prospections.index')->with('success', 'Prospection supprimée');
    }
}
