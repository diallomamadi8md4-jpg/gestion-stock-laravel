@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-danger">⚠️ Alertes Stocks</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-danger">
            <tr>
                <th>Produit</th>
                <th>Point de Vente</th>
                <th>Quantité</th>
                <th>Seuil Minimum</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stocks as $stock)
                <tr>
                    <td>{{ $stock->produit->pro_nom }}</td>
                    <td>{{ $stock->pointVente->pve_nom }}</td>
                    <td class="text-danger fw-bold">{{ $stock->quantite }}</td>
                    <td>{{ $stock->seuil_minimum }}</td>
                    <td class="text-center">
                        <a href="{{ route('stocks.edit', $stock->sto_id) }}" class="btn btn-warning btn-sm">
                            Mettre à jour
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">✅ Aucun stock en alerte</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
