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

    /* Footer total */
    .table-footer {
        background: #f1f9ff;
        font-weight: 700;
        font-size: 1rem;
    }
</style>

<div class="container mt-4">
    <h3 class="section-title">💰 Liste des Ventes</h3>

    {{-- Messages de succès ou d’erreur --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-modern table-hover align-middle">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Point de Vente</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Prix Total</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventes as $vente)
                    <tr>
                        <td>{{ $vente->ven_id }}</td>
                        <td>{{ $vente->pointVente->pve_nom }}</td>
                        <td>{{ $vente->produit->pro_nom }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $vente->quantite }}</span>
                        </td>
                        <td>{{ number_format($vente->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                        <td>{{ number_format($vente->quantite * $vente->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                        <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <!-- Bouton Show -->
                            <a href="{{ route('ventes.show', $vente->ven_id) }}" class="btn btn-info btn-sm btn-action" title="Voir">
                                👁️ Voir
                            </a>

                            <!-- Bouton Edit -->
                            <a href="{{ route('ventes.edit', $vente->ven_id) }}" class="btn btn-primary btn-sm btn-action" title="Modifier">
                                ✏️ Modifier
                            </a>

                            <!-- Bouton Delete -->
                            <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $vente->ven_id }}" title="Supprimer">
                                🗑️ Supprimer
                            </button>
                        </td>
                    </tr>

                    <!-- Modal de confirmation -->
                    <div class="modal fade" id="deleteModal{{ $vente->ven_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $vente->ven_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $vente->ven_id }}">Suppression d'une Vente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer la vente du produit <strong>{{ $vente->produit->pro_nom }}</strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form action="{{ route('ventes.destroy', $vente->ven_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-footer">
                    <td colspan="5" class="text-end"><strong>Total des Ventes :</strong></td>
                    <td colspan="3">
                        {{ number_format($ventes->sum(fn($vente) => $vente->quantite * $vente->prix_unitaire), 0, ',', ' ') }} FCFA
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Bouton pour ajouter une nouvelle vente -->
    <div class="text-center mt-3">
        <a href="{{ route('ventes.create') }}" class="btn btn-success btn-add">
            ➕ Nouvelle Vente
        </a>
    </div>
</div>
@endsection
