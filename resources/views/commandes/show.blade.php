@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Détails de la Commande #{{ $commande->produit->pro_nom }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Point de Vente :</strong> {{ $commande->pointVente->pve_nom }}</p>
                    <p><strong>Produit :</strong> {{ $commande->produit->pro_nom }}</p>
                    <p><strong>Quantité :</strong> {{ $commande->quantite }}</p>
                    <p><strong>Prix Total :</strong> {{ $commande->prix_total }}</p>
                    <p><strong>Date Commande :</strong> {{ $commande->date_commande }}</p>
                    <p><strong>Date Livraison :</strong> {{ $commande->date_livraison ?? '-' }}</p>
                    <p><strong>État :</strong>
                        @if($commande->etat === 'en attente')
                            <span class="badge bg-warning text-dark">En attente</span>
                        @elseif($commande->etat === 'livré')
                            <span class="badge bg-success">Livré</span>
                        @else
                            <span class="badge bg-danger">Annulé</span>
                        @endif
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('commandes.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                    <a href="{{ route('commandes.edit', $commande->com_id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
