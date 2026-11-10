@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="col-md-8 col-lg-6 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-primary">Nouvelle Prospection</h4>
            <a href="{{ route('prospections.index') }}" class="btn btn-sm btn-outline-secondary">Retour</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('prospections.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="npvp" class="form-label">Nom / Prénom</label>
                        <input type="text" name="npvp" id="npvp" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" name="adresse" id="adresse" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="tel" name="telephone" id="telephone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select name="statut" id="statut" class="form-select">
                            <option value="en cours" selected>En cours</option>
                            <option value="validé">Validé</option>
                            <option value="rejeté">Rejeté</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="remarques" class="form-label">Remarques</label>
                        <textarea name="remarques" id="remarques" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
