@extends('layout.app')

@section('content')
<style>
    .section-title {
        font-weight: 800;
        font-size: 1.8rem;
        color: #0b2b3a;
        margin-bottom: 1rem;
        position: relative;
    }
    .section-title::after {
        content: "";
        display: block;
        width: 120px;
        height: 3px;
        background: linear-gradient(90deg,#dc3545,#ff6666);
        margin: 10px 0 0;
        border-radius: 3px;
    }
    .table-modern {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .table-modern thead {
        background: linear-gradient(90deg,#dc3545,#ff6666);
        color: #fff;
    }
    .table-modern tbody tr:hover {
        background-color: #fff5f5;
        transform: scale(1.01);
        transition: all .2s ease;
    }
    .btn-action {
        border-radius: 20px;
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title">
            <i class="fas fa-times-circle text-danger"></i> Commandes Annulées
        </h2>
        <a href="{{ route('commandes.create') }}" class="btn btn-primary btn-action">
            ➕ Nouvelle Commande
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Point de Vente</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix Total</th>
                        <th>Date Commande</th>
                        <th>Date Livraison</th>
                        <th>État</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commandes as $commande)
                        <tr>
                            <td>{{ $commande->com_id }}</td>
                            <td>{{ $commande->pointVente->pve_nom }}</td>
                            <td>{{ $commande->produit->pro_nom }}</td>
                            <td>{{ $commande->quantite }}</td>
                            <td>{{ $commande->prix_total }}</td>
                            <td>{{ $commande->date_commande }}</td>
                            <td>{{ $commande->date_livraison ?? '-' }}</td>
                            <td>
                                <span class="badge bg-danger">
                                    ❌ Annulé
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('commandes.show', $commande->com_id) }}" class="btn btn-info btn-sm btn-action" title="Voir">
                                    👁️ Voir
                                </a>
                                <a href="{{ route('commandes.edit', $commande->com_id) }}" class="btn btn-warning btn-sm btn-action" title="Modifier">
                                    ✏️ Modifier
                                </a>
                                <form action="{{ route('commandes.destroy', $commande->com_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette commande ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-action">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                📭 Aucune commande annulée
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
