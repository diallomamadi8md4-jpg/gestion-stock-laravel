@extends('layout.app')

@section('content')
<style>
    .section-title {
        font-weight: 800;
        font-size: 1.8rem;
        color: #0b2b3a;
        margin-bottom: 1rem;
        position: relative;
    }
    .section-title::after {
        content: "";
        display: block;
        width: 140px;
        height: 3px;
        background: linear-gradient(90deg,#0dcaf0,#00aaff);
        margin: 10px 0 0;
        border-radius: 3px;
    }
    .table-modern {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .table-modern thead {
        background: linear-gradient(90deg,#0dcaf0,#00aaff);
        color: #fff;
    }
    .table-modern tbody tr:hover {
        background-color: #f7fbff;
        transform: scale(1.01);
        transition: all .2s ease;
    }
    .badge-custom {
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 8px;
    }
</style>

<div class="container mt-4">
    <h2 class="section-title">
        <i class="fas fa-chart-line"></i> Suivi des Objectifs
    </h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Objectif</th>
                        <th>Utilisateur</th>
                        <th>Date de suivi</th>
                        <th>Quantité réalisée</th>
                        <th>Valeur réalisée</th>
                        <th>Commentaire</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suivis as $suivi)
                        <tr>
                            <td>{{ $suivi->sob_id }}</td>
                            <td>{{ $suivi->objectif->type }} ({{ $suivi->objectif->produit?->pro_nom ?? '-' }})</td>
                            <td>{{ $suivi->objectif->utilisateur->uti_nom }}</td>
                            <td>{{ $suivi->date_suivi }}</td>
                            <td>
                                <span class="badge bg-success badge-custom">{{ $suivi->quantite_realisee ?? '-' }}</span>
                            </td>
                            <td>{{ $suivi->valeur_realisee ?? '-' }}</td>
                            <td>{{ $suivi->commentaire ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                📭 Aucun suivi enregistré
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Graphique en bas du tableau --}}
    @if($suivis->count() > 0)
    <div class="mt-5">
        <h4 class="text-primary"><i class="fas fa-chart-bar"></i> Progression des Objectifs</h4>
        <canvas id="suiviChart" height="100"></canvas>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if($suivis->count() > 0)
    const ctx = document.getElementById('suiviChart').getContext('2d');

    const suiviChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($suivis as $suivi)
                    "{{ $suivi->objectif->type }}",
                @endforeach
            ],
            datasets: [
                {
                    label: 'Quantité réalisée',
                    data: [
                        @foreach($suivis as $suivi)
                            {{ $suivi->quantite_realisee ?? 0 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Quantité cible',
                    data: [
                        @foreach($suivis as $suivi)
                            {{ $suivi->objectif->quantite_cible ?? 0 }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Suivi des Objectifs (Réalisé vs Cible)' }
            }
        }
    });
    @endif
</script>
@endsection
