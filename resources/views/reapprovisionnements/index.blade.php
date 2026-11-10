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
        width: 120px;
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
        <h2 class="section-title">🚚 Réapprovisionnements</h2>
        <a href="{{ route('reapprovisionnements.create') }}" class="btn btn-primary btn-add">
            ➕ Nouveau Réapprovisionnement
        </a>
    </div>

    {{-- Messages --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-modern table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Point de Vente</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reapprovisionnements as $reapprovisionnement)
                        <tr>
                            <td>{{ $reapprovisionnement->rea_id }}</td>
                            <td>{{ $reapprovisionnement->pointVente->pve_nom }}</td>
                            <td>{{ $reapprovisionnement->produit->pro_nom }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $reapprovisionnement->quantite }}</span>
                            </td>
                            <td>
                                @if($reapprovisionnement->type === 'automatique')
                                    <span class="badge bg-info">🤖 Automatique</span>
                                @else
                                    <span class="badge bg-secondary">👤 Manuel</span>
                                @endif
                            </td>
                            <td>{{ $reapprovisionnement->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('reapprovisionnements.show', $reapprovisionnement->rea_id) }}" class="btn btn-info btn-sm btn-action" title="Voir">👁️</a>
                                <a href="{{ route('reapprovisionnements.edit', $reapprovisionnement->rea_id) }}" class="btn btn-warning btn-sm btn-action" title="Modifier">✏️</a>
                                <button class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reapprovisionnement->rea_id }}">🗑️</button>
                            </td>
                        </tr>

                        <!-- Modal de confirmation -->
                        <div class="modal fade" id="deleteModal{{ $reapprovisionnement->rea_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $reapprovisionnement->rea_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $reapprovisionnement->rea_id }}">Suppression d'un Réapprovisionnement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer le réapprovisionnement du produit <strong>{{ $reapprovisionnement->produit->pro_nom }}</strong> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('reapprovisionnements.destroy', $reapprovisionnement->rea_id) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center text-muted py-4">
                                📭 Aucun réapprovisionnement enregistré
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
