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

<div class="container mt-5" style="max-width: 650px;">
    <div class="card form-card p-4">
        <h2 class="form-title">📦 Modifier un Stock</h2>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $erreur)
                        <li>⚠️ {{ $erreur }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('stocks.update', $stock->sto_id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Produit -->
            <div class="mb-3">
                <label for="pro_id" class="form-label fw-bold">Produit</label>
                <select name="pro_id" id="pro_id" class="form-select" required>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->pro_id }}" 
                            {{ old('pro_id', $stock->pro_id) == $produit->pro_id ? 'selected' : '' }}>
                            {{ $produit->pro_nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Quantité -->
            <div class="mb-3">
                <label for="quantite" class="form-label fw-bold">Quantité</label>
                <input type="number" name="quantite" id="quantite" class="form-control" 
                       value="{{ old('quantite', $stock->quantite) }}" required>
            </div>

            <!-- Seuil minimum -->
            <div class="mb-3">
                <label for="seuil_minimum" class="form-label fw-bold">Seuil minimum</label>
                <input type="number" name="seuil_minimum" id="seuil_minimum" class="form-control" 
                       value="{{ old('seuil_minimum', $stock->seuil_minimum) }}">
            </div>

            <!-- Point de Vente -->
            <div class="mb-3">
                <label for="pve_id" class="form-label fw-bold">Point de Vente</label>
                <select name="pve_id" id="pve_id" class="form-select" required>
                    @foreach($pointsVente as $pv)
                        <option value="{{ $pv->pve_id }}" 
                            {{ old('pve_id', $stock->pve_id) == $pv->pve_id ? 'selected' : '' }}>
                            {{ $pv->pve_nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('stocks.index') }}" class="btn btn-secondary btn-modern">
                    ❌ Annuler
                </a>
                <button type="submit" class="btn btn-primary btn-modern">
                    🔄 Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
