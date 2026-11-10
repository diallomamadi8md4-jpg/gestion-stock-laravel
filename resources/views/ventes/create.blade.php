@extends('layout.app')

@section('content')
<style>
    .form-card {
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        background: #fff;
    }
    .form-title {
        font-weight: 700;
        font-size: 1.6rem;
        text-align: center;
        color: #0b2b3a;
        margin-bottom: 1.5rem;
        position: relative;
    }
    .form-title::after {
        content: "";
        display: block;
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg,#00aaff,#00ffcc);
        margin: 10px auto 0;
        border-radius: 3px;
    }
    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #dce3eb;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #00aaff;
        box-shadow: 0 0 0 0.2rem rgba(0,170,255,.25);
    }
    .btn-modern {
        border-radius: 30px;
        font-weight: 600;
        padding: 10px 20px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
</style>

<div class="container mt-5" style="max-width: 600px;">
    <div class="card form-card p-4">
        <h2 class="form-title">💰 Nouvelle Vente</h2>

        <!-- Messages -->
        @if(session('error'))
            <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('ventes.store') }}" method="POST">
            @csrf

            <!-- Point de Vente -->
            <div class="mb-3">
                <label class="form-label fw-bold">Point de Vente</label>
                <select name="pve_id" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach($pointsVente as $pv)
                        <option value="{{ $pv->pve_id }}">{{ $pv->pve_nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Produit -->
            <div class="mb-3">
                <label class="form-label fw-bold">Produit</label>
                <select name="pro_id" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->pro_id }}">{{ $produit->pro_nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Quantité -->
            <div class="mb-3">
                <label class="form-label fw-bold">Quantité</label>
                <input type="number" id="quantite" name="quantite" class="form-control" min="1" required>
            </div>

            <!-- Prix Unitaire -->
            <div class="mb-3">
                <label class="form-label fw-bold">Prix Unitaire (FCFA)</label>
                <input type="number" id="prix_unitaire" name="prix_unitaire" class="form-control" min="0" step="0.01" required>
            </div>

            <!-- Prix Total -->
            <div class="mb-3">
                <label class="form-label fw-bold">Prix Total (FCFA)</label>
                <input type="number" id="prix_total" name="prix_total" class="form-control" readonly>
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('ventes.index') }}" class="btn btn-secondary btn-modern">
                    ❌ Annuler
                </a>
                <button type="submit" class="btn btn-success btn-modern">
                    ✅ Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script pour calculer le prix total -->
<script>
    const quantiteInput = document.getElementById('quantite');
    const prixUnitaireInput = document.getElementById('prix_unitaire');
    const prixTotalInput = document.getElementById('prix_total');

    function calculerPrixTotal() {
        const qte = parseFloat(quantiteInput.value) || 0;
        const pu = parseFloat(prixUnitaireInput.value) || 0;
        prixTotalInput.value = (qte * pu).toFixed(2);
    }

    quantiteInput.addEventListener('input', calculerPrixTotal);
    prixUnitaireInput.addEventListener('input', calculerPrixTotal);
</script>
@endsection
