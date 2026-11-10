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
        background: linear-gradient(90deg,#ffcc00,#ff9900);
        margin: 10px auto 0;
        border-radius: 3px;
    }
    .form-control {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #dce3eb;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .form-control:focus {
        border-color: #ff9900;
        box-shadow: 0 0 0 0.2rem rgba(255,153,0,.25);
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
        <h2 class="form-title">🛠️ Modifier le Produit</h2>

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
        <form action="{{ route('produits.update', $produit->pro_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="pro_nom" class="form-label fw-bold">Nom du produit</label>
                <input type="text" name="pro_nom" id="pro_nom" 
                       class="form-control" 
                       value="{{ old('pro_nom', $produit->pro_nom) }}" required>
            </div>

            <div class="mb-3">
                <label for="categorie" class="form-label fw-bold">Catégorie</label>
                <input type="text" name="categorie" id="categorie" 
                       class="form-control" 
                       value="{{ old('categorie', $produit->categorie) }}" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('produits.index') }}" class="btn btn-secondary btn-modern">
                    ❌ Annuler
                </a>
                <button type="submit" class="btn btn-warning btn-modern">
                    ✏️ Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
