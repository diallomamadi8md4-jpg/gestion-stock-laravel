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
        <h2 class="section-title">🎯 Objectifs commerciaux</h2>
        <a href="{{ route('objectifs.create') }}" class="btn btn-primary btn-add">
            ➕ Nouvel objectif
        </a>
    </div>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-modern table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Utilisateur</th>
                        <th>Produit</th>
                        <th>Type</th>
                        <th>Quantité</th>
                        <th>Période</th>
                        <th>État</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($objectifs as $objectif)
                        <tr>
                            <td>{{ $objectif->obc_id }}</td>
                            <td>{{ $objectif->utilisateur->uti_nom }}</td>
                            <td>{{ $objectif->produit?->pro_nom ?? '-' }}</td>
                            <td><span class="badge bg-info">{{ ucfirst($objectif->type) }}</span></td>
                            <td>{{ $objectif->quantite ?? '-' }}</td>
                            <td>📅 {{ $objectif->date_debut }} → {{ $objectif->date_fin }}</td>
                            <td>
                                @if($objectif->etat === 'atteint')
                                    <span class="badge bg-success">✅ Atteint</span>
                                @elseif($objectif->etat === 'non atteint')
                                    <span class="badge bg-danger">❌ Non atteint</span>
                                @else
                                    <span class="badge bg-warning text-dark">⏳ En cours</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('objectifs.show', $objectif->obc_id) }}" class="btn btn-sm btn-info btn-action" title="Voir">👁️</a>
                                <a href="{{ route('objectifs.edit', $objectif->obc_id) }}" class="btn btn-sm btn-warning btn-action" title="Modifier">✏️</a>
                                <button class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $objectif->obc_id }}">🗑️</button>
                            </td>
                        </tr>

                        <!-- Modal de confirmation -->
                        <div class="modal fade" id="deleteModal{{ $objectif->obc_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $objectif->obc_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $objectif->obc_id }}">Suppression d'un Objectif</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer l'objectif commercial du produit <strong>{{ $objectif->produit->pro_nom }}</strong> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('objectifs.destroy', $objectif->obc_id) }}" method="POST" class="d-inline">
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
                            <td colspan="8" class="text-center text-muted py-5">
                                📭 Aucun objectif commercial enregistré<br>
                                <small>Ajoutez un objectif pour commencer le suivi.</small>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
