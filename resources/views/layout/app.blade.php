<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Marché - Gestion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="{{ route('accueil') }}">BAROUELI - TECH</a>
        
        <!-- Bouton sidebar -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        

        <!-- Menu utilisateur + bouton thème -->
        <ul class="navbar-nav ms-auto me-3">
            <!-- Menu Utilisateur -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" 
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li><a class="dropdown-item" href="{{ route('utilisateurs.index') }}">Liste des Utilisateurs</a></li>
                        <li><hr class="dropdown-divider"></li>
                    @endif

                    @guest
                        <li><a class="dropdown-item" href="{{ route('login') }}">Connexion</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Inscription</a></li>
                    @endguest

                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Déconnexion</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </li>
        </ul>


    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <!-- Accueil -->
                        <a class="nav-link" href="{{ route('accueil') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div> Accueil
                        </a>
                        
                        <!-- Point de Vente -->
                        <a class="nav-link" href="{{ route('point_ventes.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div> Mon Point de Vente
                        </a>

                        <!-- Produits -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduits">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div> Produits
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduits">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('produits.index') }}">Liste des Produits</a>
                                <a class="nav-link" href="{{ route('produits.create') }}">Ajouter un Produit</a>
                            </nav>
                        </div>

                        <!-- Stocks -->
                        @php
                            $nbAlertes = \App\Models\Stock::whereColumn('quantite', '<', 'seuil_minimum')->count();
                        @endphp

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStocks">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                            Stocks
                            @if($nbAlertes > 0)
                                <span class="badge bg-danger ms-2">{{ $nbAlertes }}</span>
                            @endif
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseStocks">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('stocks.index') }}">Liste des Stocks</a>
                                <a class="nav-link" href="{{ route('stocks.create') }}">Ajouter un Stock</a>
                                <a class="nav-link" href="{{ route('stocks.alertes') }}">
                                    <i class="fas fa-triangle-exclamation text-danger"></i> Alerte de Stock
                                    @if($nbAlertes > 0)
                                        <span class="badge bg-danger ms-2">{{ $nbAlertes }}</span>
                                    @endif
                                </a>
                            </nav>
                        </div>

                        <!-- Ventes -->
                        @php
                            $nbVentes = \App\Models\Vente::count();
                        @endphp

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVentes">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Ventes
                            @if($nbVentes > 0)
                                <span class="badge bg-primary ms-2">{{ $nbVentes }}</span>
                            @endif
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseVentes">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('ventes.index') }}">Liste des Ventes</a>
                                <a class="nav-link" href="{{ route('ventes.create') }}">Ajouter une Vente</a>
                                <a class="nav-link" href="{{ route('rapport_ventes.index') }}">Rapport de Vente</a>
                            </nav>
                        </div>

                        <!-- Commandes -->
                        @php
                            $nbCommandes = \App\Models\Commande::count();
                        @endphp

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCommandes">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                            Commandes
                            @if($nbCommandes > 0)
                                <span class="badge bg-success ms-2">{{ $nbCommandes }}</span>
                            @endif
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseCommandes">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('commandes.index') }}">Liste des Commandes</a>
                                <a class="nav-link" href="{{ route('commandes.create') }}">Ajouter une Commande</a>
                                <a class="nav-link" href="{{ route('commandes.en_attente') }}">
                                    <i class="fas fa-clock text-warning"></i> Commandes en attente
                                </a>

                                <a class="nav-link" href="{{ route('commandes.livrees') }}?etat=livré">
                                    <i class="fas fa-check text-success"></i> Commandes livrées
                                </a>
                                <a class="nav-link" href="{{ route('commandes.annulees') }}?etat=annulé">
                                    <i class="fas fa-times text-danger"></i> Commandes annulées
                                </a>
                            </nav>
                        </div>

                        <!-- Réapprovisionnements -->
                            @php
                                $nbReappros = \App\Models\Reapprovisionnement::count();
                            @endphp

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReappros">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck-loading"></i></div>
                                Réapprovisionnements
                                @if($nbReappros > 0)
                                    <span class="badge bg-info ms-2">{{ $nbReappros }}</span>
                                @endif
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseReappros">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('reapprovisionnements.index') }}">Liste des Réapprovisionnements</a>
                                    <a class="nav-link" href="{{ route('reapprovisionnements.create') }}">Ajouter un Réapprovisionnement</a>
                                </nav>
                            </div>

                            @php
    $nbObjectifs = \App\Models\ObjectifCommercial::count();
@endphp

<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseObjectifs">
    <div class="sb-nav-link-icon"><i class="fas fa-bullseye"></i></div>
    Objectifs commerciaux
    @if($nbObjectifs > 0)
        <span class="badge bg-primary ms-2">{{ $nbObjectifs }}</span>
    @endif
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>

<div class="collapse" id="collapseObjectifs">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="{{ route('objectifs.index') }}">Liste des Objectifs</a>
        <a class="nav-link" href="{{ route('objectifs.create') }}">Ajouter un Objectif</a>
        <a class="nav-link" href="{{ route('suivis.index') }}"><i class="fas fa-chart-line text-info"></i> Suivi des Objectifs</a>
    </nav>
</div>



@php
    $nbProspects = \App\Models\Prospection::count();
@endphp

<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseActivites">
    <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
    Activités Commerciales
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>

<div class="collapse" id="collapseActivites">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="{{ route('prospections.index') }}">
            <i class="fas fa-user-plus"></i> Prospections
            @if($nbProspects > 0)
                <span class="badge bg-warning ms-2">{{ $nbProspects }}</span>
            @endif
        </a>
        <a class="nav-link" href="{{ route('visites.index') }}">
            <i class="fas fa-map-marker-alt"></i> Visites
        </a>
        <a class="nav-link" href="{{ route('taches.index') }}">
            <i class="fas fa-tasks"></i> Tâches
        </a>
        
        
    </nav>
</div>






                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')

</body>
</html>
