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
    .detail-item {
        font-size: 1rem;
        margin-bottom: .6rem;
    }
    .detail-item strong {
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

<div class="container mt-5" style="max-width: 750px;">
    <div class="card detail-card p-4">
        <h2 class="detail-title">🚚 Détail du Réapprovisionnement #{{ $reapprovisionnement->rea_id }}</h2>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4 detail-item"><strong>🏬 Point de Vente :</strong></dt>
                <dd class="col-sm-8">{{ $reapprovisionnement->pointVente->pve_nom }}</dd>

                <dt class="col-sm-4 detail-item"><strong>📦 Produit :</strong></dt>
                <dd class="col-sm-8">{{ $reapprovisionnement->produit->pro_nom }}</dd>

                <dt class="col-sm-4 detail-item"><strong>🔢 Quantité :</strong></dt>
                <dd class="col-sm-8">
                    <span class="badge bg-primary">{{ $reapprovisionnement->quantite }}</span>
                </dd>

                <dt class="col-sm-4 detail-item"><strong>⚙️ Type :</strong></dt>
                <dd class="col-sm-8">
                    @if($reapprovisionnement->type === 'automatique')
                        <span class="badge bg-info"><i class="fas fa-robot"></i> Automatique</span>
                    @else
                        <span class="badge bg-secondary"><i class="fas fa-user"></i> Manuel</span>
                    @endif
                </dd>

                <dt class="col-sm-4 detail-item"><strong>📅 Date de création :</strong></dt>
                <dd class="col-sm-8">{{ $reapprovisionnement->created_at->format('d/m/Y H:i') }}</dd>

                <dt class="col-sm-4 detail-item"><strong>🔄 Dernière mise à jour :</strong></dt>
                <dd class="col-sm-8">{{ $reapprovisionnement->updated_at->format('d/m/Y H:i') }}</dd>
            </dl>

            <!-- Boutons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('reapprovisionnements.index') }}" class="btn btn-secondary btn-modern">
                    ⬅️ Retour à la liste
                </a>
                <div>
                    <a href="{{ route('reapprovisionnements.edit', $reapprovisionnement->rea_id) }}" class="btn btn-warning btn-modern">
                        ✏️ Modifier
                    </a>
                    <form action="{{ route('reapprovisionnements.destroy', $reapprovisionnement->rea_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce réapprovisionnement ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-modern">
                            🗑️ Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
