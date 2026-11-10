@extends('layout.app')

@section('content')
<style>
    /* Titre section */
    .section-title {
        font-weight: 800;
        font-size: 2rem;
        text-align: center;
        color: #0b2b3a;
        margin-bottom: 1rem;
        position: relative;
    }
    .section-title::after {
        content: "";
        display: block;
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg,#00aaff,#00ffcc);
        margin: 12px auto 0;
        border-radius: 3px;
    }

    /* Bouton ajouter */
    .btn-add {
        border-radius: 30px;
        font-weight: 600;
        padding: 10px 20px;
        box-shadow: 0 6px 18px rgba(0,170,255,0.25);
        transition: transform .2s ease;
    }
    .btn-add:hover { transform: translateY(-3px); }

    /* Table */
    .table-modern {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(2,6,23,0.08);
    }
    .table-modern thead {
        background: linear-gradient(90deg,#0077cc,#00aaff);
        color: #fff;
    }
    .table-modern tbody tr:hover {
        background-color: #f7fbff;
        transform: scale(1.01);
        transition: all .2s ease;
    }

    /* Actions */
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

    /* Modal */
    .modal-header.bg-danger {
        background: linear-gradient(90deg,#ff4b4b,#ff6b6b);
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title">📑 Liste des Commandes</h2>
        <a href="{{ route('commandes.create') }}" class="btn btn-success btn-add">
            ➕ Nouvelle Commande
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-modern table-hover mb-0 align-middle">
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
                            <td>{{ number_format($commande->prix_total, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $commande->date_commande }}</td>
                            <td>{{ $commande->date_livraison ?? '-' }}</td>
                            <td>
                                @if($commande->etat === 'en attente')
                                    <span class="badge bg-warning text-dark">⏳ En attente</span>
                                @elseif($commande->etat === 'livré')
                                    <span class="badge bg-success">✅ Livré</span>
                                @else
                                    <span class="badge bg-danger">❌ Annulé</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('commandes.show', $commande->com_id) }}" class="btn btn-info btn-sm btn-action" title="Voir">👁️</a>
                                <a href="{{ route('commandes.edit', $commande->com_id) }}" class="btn btn-warning btn-sm btn-action" title="Modifier">✏️</a>
                                <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $commande->com_id }}" title="Supprimer">🗑️</button>
                            </td>
                        </tr>

                        <!-- Modal de confirmation -->
                        <div class="modal fade" id="deleteModal{{ $commande->com_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $commande->com_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $commande->com_id }}">Suppression d'une Commande</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer la commande du produit <strong>{{ $commande->produit->pro_nom }}</strong> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('commandes.destroy', $commande->com_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                📭 Aucune commande enregistrée
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
