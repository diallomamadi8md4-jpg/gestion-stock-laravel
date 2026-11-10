@extends('layout.app')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Suppression d'un Produit</h5>
        </div>
        <div class="card-body">
            <p>Êtes-vous sûr de vouloir supprimer le produit <strong>{{ $produit->pro_nom }}</strong> ?</p>

            <form action="{{ route('produits.destroy', $produit->pro_id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                    <a href="{{ route('produits.index') }}" class="btn btn-secondary ms-2">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
