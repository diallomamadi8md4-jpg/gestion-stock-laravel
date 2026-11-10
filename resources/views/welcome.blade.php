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
        <a class="navbar-brand ps-3" href="{{ route('accueil') }}">MA BOUTIQUE</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
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
                                <a class="nav-link" href="{{ route('ventes.rapport') }}">Rapport de Vente</a>
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
</body>
</html>
