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

<div class="container mt-5" style="max-width: 800px;">
    <div class="card form-card p-4">
        <h2 class="form-title">🎯 Ajouter un Objectif commercial</h2>

        <!-- Messages d'erreur -->
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <strong>⚠️ Oups !</strong> Corrigez les erreurs ci-dessous :
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('objectifs.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="uti_id" class="form-label fw-bold">👤 Utilisateur</label>
                    <select name="uti_id" id="uti_id" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($utilisateurs as $utilisateur)
                            <option value="{{ $utilisateur->uti_id }}">{{ $utilisateur->uti_nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pro_id" class="form-label fw-bold">📦 Produit (optionnel)</label>
                    <select name="pro_id" id="pro_id" class="form-select">
                        <option value="">-- Aucun produit spécifique --</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->pro_id }}">{{ $produit->pro_nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label fw-bold">🏷️ Type d'objectif</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="ventes">Ventes</option>
                        <option value="visites">Visites</option>
                        <option value="prospections">Prospections</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="etat" class="form-label fw-bold">🚩 État</label>
                    <select name="etat" id="etat" class="form-select" required>
                        <option value="en cours">⏳ En cours</option>
                        <option value="atteint">✅ Atteint</option>
                        <option value="non atteint">❌ Non atteint</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="quantite" class="form-label fw-bold">🔢 Quantité cible</label>
                    <input type="number" name="quantite" id="quantite" class="form-control" placeholder="Ex: 200" min="1">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="valeur_cible" class="form-label fw-bold">💵 Valeur cible (optionnel)</label>
                    <input type="number" step="0.01" name="valeur_cible" id="valeur_cible" class="form-control" placeholder="Ex: 100000.00">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="date_debut" class="form-label fw-bold">📅 Date début</label>
                    <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date_fin" class="form-label fw-bold">📆 Date fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('objectifs.index') }}" class="btn btn-secondary btn-modern">
                    ❌ Retour
                </a>
                <button type="submit" class="btn btn-success btn-modern">
                    ✅ Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
