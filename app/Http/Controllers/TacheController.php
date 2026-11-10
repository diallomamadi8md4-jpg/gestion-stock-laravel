<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    public function index()
    {
        $taches = Tache::all();
        return view('taches.index', compact('taches'));
    }

    public function create()
    {
        return view('taches.create');
    }

    public function store(Request $request)
    {
        Tache::create($request->all());
        return redirect()->route('taches.index')->with('success', 'Tâche ajoutée avec succès');
    }

    public function show($id)
    {
        $tache = Tache::findOrFail($id);
        return view('taches.show', compact('tache'));
    }

    public function edit($id)
    {
        $tache = Tache::findOrFail($id);
        return view('taches.edit', compact('tache'));
    }

    public function update(Request $request, $id)
    {
        $tache = Tache::findOrFail($id);
        $tache->update($request->all());
        return redirect()->route('taches.index')->with('success', 'Tâche mise à jour');
    }

    public function destroy($id)
    {
        $tache = Tache::findOrFail($id);
        $tache->delete();
        return redirect()->route('taches.index')->with('success', 'Tâche supprimée');
    }
}
