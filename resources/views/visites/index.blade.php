@extends('layout.app')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold text-primary mb-3">
        <i class="fas fa-users me-2"></i> Journal des Visites
    </h4>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>IP</th>
                            <th>Page</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visites as $visite)
                            <tr>
                                <td>{{ $visite->id }}</td>
                                <td>{{ $visite->visiteur_nom ?? 'Anonyme' }}</td>
                                <td>{{ $visite->visiteur_email ?? '-' }}</td>
                                <td>{{ $visite->ip_address }}</td>
                                <td>{{ $visite->page }}</td>
                                <td>{{ $visite->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Aucun visiteur enregistré
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination si tu utilises paginate() -->
            <div class="d-flex justify-content-center mt-3">
                {{ $visites->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
