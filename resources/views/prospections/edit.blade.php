@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">
            <i class="fas fa-edit me-2"></i> Modifier la Prospection
        </h4>
        <a href="{{ route('prospections.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour
        </a>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient bg-dark text-white">
            <i class="fas fa-pencil-alt me-2"></i> Formulaire de modification
        </div>
        <div class="card-body">
            <form action="{{ route('prospections.update', $prospection->prp_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nom / Prénom -->
                <div class="mb-3">
                    <label for="npvp" class="form-label fw-semibold">Nom / Prénom</label>
                    <input type="text" name="npvp" id="npvp" 
                           value="{{ old('npvp', $prospection->npvp) }}" 
                           class="form-control @error('npvp') is-invalid @enderror" required>
                    @error('npvp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Adresse -->
                <div class="mb-3">
                    <label for="adresse" class="form-label fw-semibold">Adresse</label>
                    <input type="text" name="adresse" id="adresse" 
                           value="{{ old('adresse', $prospection->adresse) }}" 
                           class="form-control @error('adresse') is-invalid @enderror" required>
                    @error('adresse')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Téléphone -->
                <div class="mb-3">
                    <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                    <input type="tel" name="telephone" id="telephone" 
                           value="{{ old('telephone', $prospection->telephone) }}" 
                           class="form-control @error('telephone') is-invalid @enderror" 
                           placeholder="+223 76 12 34 56" required>
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Statut -->
                <div class="mb-3">
                    <label for="statut" class="form-label fw-semibold">Statut</label>
                    <select name="statut" id="statut" 
                            class="form-select @error('statut') is-invalid @enderror">
                        <option value="en cours" {{ old('statut', $prospection->statut) == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="validé" {{ old('statut', $prospection->statut) == 'validé' ? 'selected' : '' }}>Validé</option>
                        <option value="rejeté" {{ old('statut', $prospection->statut) == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remarques -->
                <div class="mb-3">
                    <label for="remarques" class="form-label fw-semibold">Remarques</label>
                    <textarea name="remarques" id="remarques" rows="3" 
                              class="form-control @error('remarques') is-invalid @enderror">{{ old('remarques', $prospection->remarques) }}</textarea>
                    @error('remarques')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('prospections.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-times me-1"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-save me-1"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
