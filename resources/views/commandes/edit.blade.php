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
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg,#0d6efd,#00aaff);
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
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
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
        <h2 class="form-title">📝 Modifier la Commande #{{ $commande->produit->pro_nom }}</h2>

        <!-- Messages d'erreur -->
        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('commandes.update', $commande->com_id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Point de Vente -->
            <div class="mb-3">
                <label for="pve_id" class="form-label fw-bold">🏬 Point de Vente</label>
                <select name="pve_id" id="pve_id" class="form-select" required>
                    @foreach($pointsVente as $pve)
                        <option value="{{ $pve->pve_id }}" 
                            {{ $commande->pve_id == $pve->pve_id ? 'selected' : '' }}>
                            {{ $pve->pve_nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Produit -->
            <div class="mb-3">
                <label for="pro_id" class="form-label fw-bold">📦 Produit</label>
                <select name="pro_id" id="pro_id" class="form-select" required>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->pro_id }}" 
                            {{ $commande->pro_id == $produit->pro_id ? 'selected' : '' }}>
                            {{ $produit->pro_nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Quantité -->
            <div class="mb-3">
                <label for="quantite" class="form-label fw-bold">🔢 Quantité</label>
                <input type="number" name="quantite" id="quantite" 
                       class="form-control" min="1" 
                       value="{{ $commande->quantite }}" required>
            </div>

            <!-- Prix Total -->
            <div class="mb-3">
                <label for="prix_total" class="form-label fw-bold">💵 Prix Total (FCFA)</label>
                <input type="text" name="prix_total" id="prix_total" 
                       class="form-control" value="{{ $commande->prix_total }}">
            </div>

            <!-- Date de Livraison -->
            <div class="mb-3">
                <label for="date_livraison" class="form-label fw-bold">📅 Date de Livraison</label>
                <input type="date" name="date_livraison" id="date_livraison" 
                       class="form-control" value="{{ $commande->date_livraison }}">
            </div>

            <!-- État -->
            <div class="mb-3">
                <label for="etat" class="form-label fw-bold">🚩 État</label>
                <select name="etat" id="etat" class="form-select">
                    <option value="en attente" {{ $commande->etat == 'en attente' ? 'selected' : '' }}>⏳ En attente</option>
                    <option value="livré" {{ $commande->etat == 'livré' ? 'selected' : '' }}>✅ Livré</option>
                    <option value="annulé" {{ $commande->etat == 'annulé' ? 'selected' : '' }}>❌ Annulé</option>
                </select>
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('commandes.index') }}" class="btn btn-secondary btn-modern">
                    ❌ Retour
                </a>
                <button type="submit" class="btn btn-primary btn-modern">
                    💾 Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
