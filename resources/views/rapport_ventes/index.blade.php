@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Rapports de Ventes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>N°</th>
                <th>Point de Vente</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Total</th>
                <th>Nb Ventes</th>
                <th>Quantité Totale</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rapports as $rapport)
                <tr>
                    <td>{{ $rapport->rve_id }}</td>
                    <td>{{ $rapport->pointVente->pve_nom ?? 'N/A' }}</td>
                    <td>{{ $rapport->date_debut }}</td>
                    <td>{{ $rapport->date_fin }}</td>
                    <td>{{ $rapport->total }}</td>
                    <td>{{ $rapport->nb_ventes }}</td>
                    <td>{{ $rapport->quantite_totale }}</td>
                    <td>{{ $rapport->statut }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Aucun rapport disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
