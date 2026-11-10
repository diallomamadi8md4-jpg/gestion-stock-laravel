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
        width: 120px;
        height: 3px;
        background: linear-gradient(90deg,#0dcaf0,#00aaff);
        margin: 10px auto 0;
        border-radius: 3px;
    }
    .list-group-item {
        font-size: 0.95rem;
        padding: 10px 12px;
    }
    .list-group-item strong {
        color: #0dcaf0;
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
</style>

<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card detail-card" style="width: 500px;">
        <h2 class="detail-title">🎯 Détails de l’Objectif</h2>
        <div class="card-body p-3">

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <i class="fas fa-hashtag text-muted"></i> <strong>N° :</strong> {{ $objectif->obc_id }}
                </li>
                <li class="list-group-item">
                    <i class="fas fa-user text-muted"></i> <strong>Utilisateur :</strong> {{ $objectif->utilisateur->uti_nom }}
                </li>
                <li class="list-group-item">
                    <i class="fas fa-box text-muted"></i> <strong>Produit :</strong> {{ $objectif->produit?->pro_nom ?? '-' }}
                </li>
                <li class="list-group-item">
                    <i class="fas fa-tags text-muted"></i> <strong>Type :</strong> 
                    <span class="badge bg-secondary">{{ ucfirst($objectif->type) }}</span>
                </li>
                <li class="list-group-item">
                    <i class="fas fa-sort-numeric-up text-muted"></i> <strong>Quantité :</strong> {{ $objectif->quantite ?? '-' }}
                </li>
                <li class="list-group-item">
                    <i class="fas fa-money-bill-wave text-muted"></i> <strong>Valeur cible :</strong> {{ $objectif->valeur_cible ?? '-' }}
                </li>
                <li class="list-group-item">
                    <i class="fas fa-calendar-alt text-muted"></i> <strong>Période :</strong> 
                    {{ $objectif->date_debut }} → {{ $objectif->date_fin }}
                </li>
                <li class="list-group-item">
                    <i class="fas fa-flag text-muted"></i> <strong>État :</strong>
                    @if($objectif->etat === 'atteint')
                        <span class="badge bg-success">✅ Atteint</span>
                    @elseif($objectif->etat === 'non atteint')
                        <span class="badge bg-danger">❌ Non atteint</span>
                    @else
                        <span class="badge bg-warning text-dark">⏳ En cours</span>
                    @endif
                </li>
            </ul>

            <!-- Boutons -->
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('objectifs.index') }}" class="btn btn-secondary btn-modern">
                    ⬅️ Retour
                </a>
                <a href="{{ route('objectifs.edit', $objectif->obc_id) }}" class="btn btn-warning btn-modern">
                    ✏️ Modifier
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
