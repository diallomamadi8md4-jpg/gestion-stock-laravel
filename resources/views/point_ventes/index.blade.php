@extends('layout.app')

@section('content')
<style>
    /* Section titre */
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
        width: 80px;
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
    <h2 class="section-title">🏬 Mes Points de Vente</h2>

    <!-- Bouton Ajouter -->
    <div class="text-center mb-3">
        <a href="{{ route('point_ventes.create') }}" class="btn btn-success btn-add">
            ➕ Ajouter un Point de Vente
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-modern table-hover align-middle">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>État</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($point_ventes as $pv)
                    <tr>
                        <td>{{ $pv->pve_id }}</td>
                        <td><strong>{{ $pv->pve_nom }}</strong></td>
                        <td>{{ $pv->pve_adresse }}</td>
                        <td>
                            <span class="badge 
                                @if($pv->etat === 'actif') bg-success 
                                @elseif($pv->etat === 'inactif') bg-warning 
                                @else bg-danger @endif">
                                {{ ucfirst($pv->etat) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('point_ventes.edit', $pv->pve_id) }}" class="btn btn-primary btn-sm btn-action">✏️ Modifier</a>
                            
                            <!-- Bouton Supprimer -->
                            <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pv->pve_id }}">
                                🗑️ Supprimer
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $pv->pve_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $pv->pve_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $pv->pve_id }}">Suppression d'un Point de Vente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer <strong>{{ $pv->pve_nom }}</strong> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('point_ventes.destroy', $pv->pve_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucun point de vente disponible</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
