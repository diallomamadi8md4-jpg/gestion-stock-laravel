@extends('layout.app')

@section('content')
<style>
    /* Titre section */
    .section-title {
        font-weight: 800;
        font-size: 2rem;
        text-align: center;
        color: #0b2b3a;
        margin-bottom: 1rem;
        position: relative;
    }
    .section-title::after {
        content: "";
        display: block;
        width: 120px;
        height: 4px;
        background: linear-gradient(90deg,#00aaff,#00ffcc);
        margin: 12px auto 0;
        border-radius: 3px;
    }

    /* Bouton ajouter */
    .btn-add {
        border-radius: 30px;
        font-weight: 600;
        padding: 10px 20px;
        box-shadow: 0 6px 18px rgba(0,170,255,0.25);
        transition: transform .2s ease;
    }
    .btn-add:hover { transform: translateY(-3px); }

    /* Table */
    .table-modern {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(2,6,23,0.08);
    }
    .table-modern thead {
        background: linear-gradient(90deg,#0077cc,#00aaff);
        color: #fff;
    }
    .table-modern tbody tr:hover {
        background-color: #f7fbff;
        transform: scale(1.01);
        transition: all .2s ease;
    }

    /* Badges */
    .badge-role {
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 12px;
    }
    .badge-etat {
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 12px;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="section-title">👥 Liste des utilisateurs</h1>
        <a href="{{ route('utilisateurs.create') }}" class="btn btn-success btn-add">
            ➕ Nouvel utilisateur
        </a>
    </div>

    @if($utilisateurs->count())
        <div class="table-responsive">
            <table class="table table-modern table-hover align-middle">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Téléphone</th>
                        <th>État</th>
                        <th>Inscrit le</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($utilisateurs as $u)
                        <tr>
                            <td>{{ $u->uti_id }}</td>
                            <td>{{ $u->uti_nom }}</td>
                            <td>{{ $u->uti_prenom }}</td>
                            <td>{{ $u->uti_email }}</td>
                            <td>
                                <span class="badge badge-role 
                                    @if($u->role === 'admin') bg-danger 
                                    @elseif($u->role === 'gestionnaire') bg-primary 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td>{{ $u->uti_telephone ?? '—' }}</td>
                            <td>
                                <span class="badge badge-etat 
                                    @if($u->etat === 'actif') bg-success 
                                    @elseif($u->etat === 'inactif') bg-warning 
                                    @else bg-danger @endif">
                                    {{ ucfirst($u->etat) }}
                                </span>
                            </td>
                            <td>{{ $u->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $utilisateurs->links() }}
        </div>
    @else
        <div class="alert alert-info text-center py-4">
            📭 Aucun utilisateur trouvé
        </div>
    @endif
</div>
@endsection
