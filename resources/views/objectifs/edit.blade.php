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
        width: 120px;
        height: 3px;
        background: linear-gradient(90deg,#ffc107,#ff8800);
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
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
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

<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card form-card p-4" style="width: 500px;">
        <h2 class="form-title">✏️ Modifier un Objectif</h2>

        <!-- Messages d'erreur -->
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm small" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Corrigez les erreurs :
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('objectifs.update', $objectif->obc_id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Utilisateur -->
            <div class="mb-3">
                <label for="uti_id" class="form-label fw-bold">👤 Utilisateur</label>
                <select name="uti_id" id="uti_id" class="form-select" required>
                    @foreach($utilisateurs as $utilisateur)
                        <option value="{{ $utilisateur->uti_id }}" 
                            {{ $objectif->uti_id == $utilisateur->uti_id ? 'selected' : '' }}>
                            {{ $utilisateur->uti_nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Produit -->
            <div class="mb-3">
                <label for="pro_id" class="form-label fw-bold">📦 Produit</label>
                <select name="pro_id" id="pro_id" class="form-select">
                    <option value="">-- Aucun produit --</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->pro_id }}" 
                            {{ $objectif->pro_id == $produit->pro_id ? 'selected' : '' }}>
                            {{ $produit->pro_nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Type -->
            <div class="mb-3">
                <label for="type" class="form-label fw-bold">🏷️ Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="ventes" {{ $objectif->type == 'ventes' ? 'selected' : '' }}>Ventes</option>
                    <option value="visites" {{ $objectif->type == 'visites' ? 'selected' : '' }}>Visites</option>
                    <option value="prospections" {{ $objectif->type == 'prospections' ? 'selected' : '' }}>Prospections</option>
                </select>
            </div>

            <!-- Quantité -->
            <div class="mb-3">
                <label for="quantite" class="form-label fw-bold">🔢 Quantité</label>
                <input type="number" name="quantite" id="quantite" class="form-control" 
                       value="{{ $objectif->quantite }}">
            </div>

            <!-- Valeur cible -->
            <div class="mb-3">
                <label for="valeur_cible" class="form-label fw-bold">💵 Valeur cible</label>
                <input type="number" step="0.01" name="valeur_cible" id="valeur_cible" 
                       class="form-control" value="{{ $objectif->valeur_cible }}">
            </div>

            <!-- Dates -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="date_debut" class="form-label fw-bold">📅 Date début</label>
                    <input type="date" name="date_debut" id="date_debut" class="form-control" 
                           value="{{ $objectif->date_debut }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date_fin" class="form-label fw-bold">📆 Date fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" 
                           value="{{ $objectif->date_fin }}">
                </div>
            </div>

            <!-- État -->
            <div class="mb-3">
                <label for="etat" class="form-label fw-bold">🚩 État</label>
                <select name="etat" id="etat" class="form-select">
                    <option value="en cours" {{ $objectif->etat == 'en cours' ? 'selected' : '' }}>⏳ En cours</option>
                    <option value="atteint" {{ $objectif->etat == 'atteint' ? 'selected' : '' }}>✅ Atteint</option>
                    <option value="non atteint" {{ $objectif->etat == 'non atteint' ? 'selected' : '' }}>❌ Non atteint</option>
                </select>
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('objectifs.index') }}" class="btn btn-secondary btn-modern">
                    ❌ Retour
                </a>
                <button type="submit" class="btn btn-warning btn-modern">
                    💾 Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
