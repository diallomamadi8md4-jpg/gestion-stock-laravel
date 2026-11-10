@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">
            <i class="fas fa-eye me-2"></i> Détails de la Prospection
        </h4>
        <a href="{{ route('prospections.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour
        </a>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient bg-dark text-white">
            <i class="fas fa-info-circle me-2"></i> Informations principales
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="fw-semibold text-secondary">Nom / Prénom</h6>
                        <p class="mb-0">{{ $prospection->npvp }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="fw-semibold text-secondary">Adresse</h6>
                        <p class="mb-0">{{ $prospection->adresse }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="fw-semibold text-secondary">Téléphone</h6>
                        <p class="mb-0">{{ $prospection->telephone }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="fw-semibold text-secondary">Statut</h6>
                        @if($prospection->statut === 'validé')
                            <span class="badge bg-success">Validé</span>
                        @elseif($prospection->statut === 'rejeté')
                            <span class="badge bg-danger">Rejeté</span>
                        @else
                            <span class="badge bg-warning text-dark">En cours</span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="fw-semibold text-secondary">Remarques</h6>
                        <p class="mb-0">{{ $prospection->remarques ?? 'Aucune remarque' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="fw-semibold text-secondary">Créé le</h6>
                        <p class="mb-0">{{ $prospection->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="fw-semibold text-secondary">Mis à jour le</h6>
                        <p class="mb-0">{{ $prospection->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('prospections.edit', $prospection->prp_id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit me-1"></i> Modifier
            </a>
            <form action="{{ route('prospections.destroy', $prospection->prp_id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette prospection ?')">
                    <i class="fas fa-trash me-1"></i> Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
