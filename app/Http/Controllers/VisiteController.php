<?php
namespace App\Http\Controllers;

use App\Models\Visite;
use Illuminate\Http\Request;

class VisiteController extends Controller
{
    public function index()
    {
        $visites = Visite::orderBy('created_at', 'desc')->paginate(10);
        return view('visites.index', compact('visites'));
    }

    public function create()
    {
        return view('visites.create');
    }

    public function store(Request $request)
    {
        Visite::create($request->all());
        return redirect()->route('visites.index')->with('success', 'Visite ajoutée avec succès');
    }
}
