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
        width: 60px;
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

<div class="container mt-4 col-md-6">
    <h2 class="form-title">🏬 Ajouter un Point de Vente</h2>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire -->
    <form action="{{ route('point_ventes.store') }}" method="POST" class="card p-4 form-card">
        @csrf

        <div class="mb-3">
            <label for="pve_nom" class="form-label fw-bold">Nom</label>
            <input type="text" name="pve_nom" id="pve_nom" class="form-control" value="{{ old('pve_nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="pve_adresse" class="form-label fw-bold">Adresse</label>
            <input type="text" name="pve_adresse" id="pve_adresse" class="form-control" value="{{ old('pve_adresse') }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="latitude" class="form-label fw-bold">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="longitude" class="form-label fw-bold">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude') }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="etat" class="form-label fw-bold">État</label>
            <select name="etat" id="etat" class="form-select">
                <option value="actif" {{ old('etat') == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ old('etat') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                <option value="fermé" {{ old('etat') == 'fermé' ? 'selected' : '' }}>Fermé</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('point_ventes.index') }}" class="btn btn-secondary btn-modern">Annuler</a>
            <button type="submit" class="btn btn-success btn-modern">✅ Enregistrer</button>
        </div>
    </form>
</div>
@endsection
