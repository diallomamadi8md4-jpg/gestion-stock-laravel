@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-user-plus"></i> Prospections
        </h2>
        <a href="{{ route('prospections.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Nouvelle Prospection
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient bg-dark text-white">
            <i class="fas fa-list"></i> Liste des Prospects
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>N°</th>
                        <th>Nom / Prénom</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th>Statut</th>
                        <th>Remarques</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prospections as $prospection)
                        <tr>
                            <td class="fw-bold">{{ $prospection->prp_id }}</td>
                            <td>{{ $prospection->npvp }}</td>
                            <td>{{ $prospection->adresse }}</td>
                            <td>{{ $prospection->telephone }}</td>
                            <td>
                                @switch($prospection->statut)
                                    @case('en cours')
                                        <span class="badge rounded-pill bg-warning text-dark">En dessous</span>
                                        @break
                                    @case('validé')
                                        <span class="badge rounded-pill bg-success">Validé</span>
                                        @break
                                    @case('rejeté')
                                        <span class="badge rounded-pill bg-danger">Rejeté</span>
                                        @break
                                    @default
                                        <span class="badge rounded-pill bg-secondary">{{ $prospection->statut }}</span>
                                @endswitch
                            </td>
                            <td>{{ $prospection->remarques }}</td>
                            <td class="text-center">
                                <a href="{{ route('prospections.show', $prospection->prp_id) }}" class="btn btn-outline-info btn-sm me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('prospections.edit', $prospection->prp_id) }}" class="btn btn-outline-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Bouton de suppression qui ouvre le modal -->
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <!-- Modal de confirmation -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Suppression d'une Prospection
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer cette prospection ? <br>
                                        <span class="text-muted">Cette action est irréversible.</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                        Annuler
                                        </button>
                                        <form action="{{ route('prospections.destroy', $prospection->prp_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle"></i> Aucune prospection enregistrée
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
