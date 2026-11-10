@extends('layout.app')

@section('content')
<style>
    .detail-card {
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        background: #fff;
    }
    .detail-title {
        font-weight: 700;
        font-size: 1.6rem;
        text-align: center;
        color: #0b2b3a;
        margin-bottom: 1.5rem;
        position: relative;
    }
    .detail-title::after {
        content: "";
        display: block;
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg,#0d6efd,#00aaff);
        margin: 10px auto 0;
        border-radius: 3px;
    }
    .btn-modern {
        border-radius: 30px;
        font-weight: 600;
        padding: 8px 18px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
    .detail-item {
        font-size: 1rem;
        margin-bottom: .6rem;
    }
    .detail-item strong {
        color: #0d6efd;
    }
</style>

<div class="container mt-5" style="max-width: 700px;">
    <div class="card detail-card p-4">
        <h2 class="detail-title">💰 Détail de la Vente #{{ $vente->ven_id }}</h2>

        <div class="card-body">
            <p class="detail-item"><strong>🏬 Point de Vente :</strong> {{ $vente->pointVente->pve_nom }}</p>
            <p class="detail-item"><strong>📦 Produit :</strong> {{ $vente->produit->pro_nom }}</p>
            <p class="detail-item"><strong>🔢 Quantité :</strong> {{ $vente->quantite }}</p>
            <p class="detail-item"><strong>📅 Date :</strong> {{ $vente->created_at->format('d/m/Y H:i') }}</p>
            <p class="detail-item"><strong>💵 Prix unitaire :</strong> {{ $vente->prix_unitaire }} FCFA</p>
            <p class="detail-item"><strong>💰 Montant total :</strong> {{ $vente->quantite * $vente->prix_unitaire }} FCFA</p>
        </div>
    </div>

    <!-- Boutons -->
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('ventes.index') }}" class="btn btn-secondary btn-modern">
            ⬅️ Retour à la liste
        </a>
        <a href="{{ route('ventes.edit', $vente->ven_id) }}" class="btn btn-primary btn-modern">
            ✏️ Modifier
        </a>
        <form action="{{ route('ventes.destroy', $vente->ven_id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-modern">
                🗑️ Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
