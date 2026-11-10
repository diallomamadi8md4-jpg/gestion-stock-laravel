@extends('layout.app')

@section('content')
<div class="container mt-4 col-md-6">
    <h2 class="mb-4 text-center">Détails du Stock</h2>

    <div class="card p-4 shadow-sm">
        <p><strong>Produit :</strong> {{ $stock->produit->pro_nom }}</p>
        <p><strong>Point de Vente :</strong> {{ $stock->pointVente->pve_nom }}</p>
        <p><strong>Quantité :</strong> {{ $stock->quantite }}</p>
        <p><strong>Seuil minimum :</strong> {{ $stock->seuil_minimum }}</p>
    </div>

    <div class="mt-3 d-flex justify-content-between">
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Retour</a>
        <a href="{{ route('stocks.edit', $stock->sto_id) }}" class="btn btn-primary">Modifier</a>
    </div>
</div>
@endsection
