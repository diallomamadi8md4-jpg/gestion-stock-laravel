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
    <h2 class="section-title">📦 Liste des Stocks</h2>

    <!-- Bouton Ajouter -->
    <div class="text-center mb-3">
        <a href="{{ route('stocks.create') }}" class="btn btn-success btn-add">
            ➕ Ajouter un Stock
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-modern table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 5%;">N°</th>
                    <th style="width: 25%;">Produit</th>
                    <th style="width: 25%;">Point de Vente</th>
                    <th style="width: 15%;">Quantité</th>
                    <th style="width: 15%;">Seuil Minimum</th>
                    <th style="width: 15%;" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $stock)
                    <tr>
                        <td>{{ $stock->sto_id }}</td>
                        <td><strong>{{ $stock->produit->pro_nom }}</strong></td>
                        <td>{{ $stock->pointVente->pve_nom }}</td>
                        <td>
                            <span class="badge 
                                @if($stock->quantite <= $stock->seuil_minimum) bg-danger 
                                @else bg-success @endif">
                                {{ $stock->quantite }}
                            </span>
                        </td>
                        <td>{{ $stock->seuil_minimum }}</td>
                        <td class="text-center">
                            <!-- Bouton Modifier -->
                            <a href="{{ route('stocks.edit', $stock->sto_id) }}" class="btn btn-primary btn-sm btn-action">✏️ Modifier</a>

                            <!-- Bouton Supprimer -->
                            <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $stock->sto_id }}">
                                🗑️ Supprimer
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $stock->sto_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $stock->sto_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $stock->sto_id }}">Suppression d'un Stock</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer le stock du produit <strong>{{ $stock->produit->pro_nom }}</strong> ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('stocks.destroy', $stock->sto_id) }}" method="POST">
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
                        <td colspan="6" class="text-center text-muted">Aucun stock disponible</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
