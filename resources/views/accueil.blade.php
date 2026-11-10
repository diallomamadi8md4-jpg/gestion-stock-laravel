@extends('layout.app')

@section('content')
<style>
    /* Global */
    body {
        background: linear-gradient(90deg, #f4f6f9 0%, #eef6fb 100%);
        color: #222;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        max-width: 1200px;
    }

    /* HERO */
    .hero-bg {
        background: url('{{ asset('Images/supermarche-hero.jpg') }}') no-repeat center center;
        background-size: cover;
        height: 82vh;
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 18px 50px rgba(2,6,23,0.35);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-bg::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(2,6,23,0.72), rgba(0,150,200,0.18));
        mix-blend-mode: multiply;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 920px;
        padding: 0 20px;
        animation: fadeInUp 900ms ease both;
    }

    .hero-title {
        font-size: clamp(2.2rem, 4vw, 3.8rem);
        font-weight: 900;
        line-height: 1.02;
        background: linear-gradient(90deg, #00aaff 0%, #00ffd1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 8px 30px rgba(0,0,0,0.45);
        margin-bottom: 0.4rem;
    }

    .hero-sub {
        color: rgba(245,247,251,0.95);
        font-size: clamp(1rem, 1.6vw, 1.4rem);
        margin-bottom: 18px;
    }

    .hero-cta {
        display: inline-flex;
        gap: 12px;
        align-items: center;
        justify-content: center;
        margin-top: 12px;
    }

    .btn-cta {
        padding: 12px 34px;
        border-radius: 40px;
        font-weight: 700;
        letter-spacing: .2px;
        transition: transform .18s ease, box-shadow .18s ease;
        box-shadow: 0 10px 30px rgba(2,6,23,0.18);
    }

    .btn-primary-cta {
        background: linear-gradient(90deg, #00aaff, #0077cc);
        color: #fff;
        border: none;
    }
    .btn-primary-cta:hover { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(0,119,204,0.18); }

    .btn-outline-cta {
        background: transparent;
        color: #fff;
        border: 1.5px solid rgba(255,255,255,0.18);
    }
    .btn-outline-cta:hover { transform: translateY(-4px); background: rgba(255,255,255,0.06); }

    /* Section titles */
    .section-title {
        text-align: center;
        font-weight: 800;
        font-size: 1.9rem;
        color: #0b2b3a;
        margin-bottom: 6px;
    }
    .section-sub {
        text-align: center;
        color: #6c757d;
        margin-bottom: 18px;
    }
    .section-title::after {
        content: "";
        display: block;
        width: 96px;
        height: 4px;
        background: #00aaff;
        margin: 12px auto 0;
        border-radius: 3px;
    }

    /* Section backgrounds */
    .section-card {
        padding: 34px;
        border-radius: 14px;
        margin-top: 36px;
        box-shadow: 0 10px 30px rgba(2,6,23,0.04);
        background: #fff;
    }

    .section-blue {
        background: linear-gradient(180deg, #f7fdff, #eefcff);
    }

    /* Carousel (promotions) */
    .promo-carousel .carousel-item {
        padding: 18px 0;
    }

    .promo-card {
        border-radius: 14px;
        overflow: hidden;
        transition: transform .35s ease, box-shadow .35s ease;
        border: none;
        background: linear-gradient(180deg,#ffffff,#fbfdff);
    }
    .promo-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(2,6,23,0.12); }

    .promo-img {
        height: 260px;
        object-fit: cover;
        width: 100%;
        display: block;
    }

    .promo-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: linear-gradient(90deg,#ff6b6b,#ff4b4b);
        color: #fff;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        box-shadow: 0 8px 24px rgba(255,75,75,0.14);
        font-size: .95rem;
    }

    /* Cards (categories) */
    .category-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform .28s ease, box-shadow .28s ease;
        background: #fff;
        text-align: center;
        padding-bottom: 18px;
    }
    .category-card:hover { transform: translateY(-8px); box-shadow: 0 18px 36px rgba(2,6,23,0.08); }

    .category-img {
        height: 160px;
        object-fit: cover;
        width: 100%;
    }

    .category-title {
        color: #0b6fa8;
        font-weight: 700;
        margin-top: 12px;
    }
    .category-text { color: #6c757d; margin-bottom: 10px; }

    /* Service cards */
    .service-card {
        border-radius: 12px;
        padding: 26px;
        background: #fff;
        transition: transform .25s ease, box-shadow .25s ease;
    }
    .service-card:hover { transform: translateY(-8px); box-shadow: 0 14px 30px rgba(2,6,23,0.08); }

    .service-icon {
        font-size: 2.2rem;
        color: #00aaff;
        margin-bottom: 8px;
    }

    /* Newsletter */
    .newsletter {
        display:flex;
        gap:12px;
        justify-content:center;
        align-items:center;
        margin-top: 18px;
    }
    .newsletter input[type="email"] {
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #e6eef6;
        width: 360px;
        outline: none;
        transition: box-shadow .18s ease, border-color .18s ease;
    }
    .newsletter input[type="email"]:focus {
        border-color: #00aaff;
        box-shadow: 0 8px 30px rgba(0,170,255,0.12);
    }

    .small-muted { color: #6c757d; font-size: .95rem; }

    /* Footer */
    footer.app-footer {
        margin-top: 40px;
        padding: 18px 0;
        color: #6c757d;
    }

    /* Responsive tweaks */
    @media (max-width: 991px) {
        .promo-img { height: 200px; }
        .hero-title { font-size: 2.4rem; }
        .newsletter input[type="email"] { width: 100%; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container mt-5">
    <!-- HERO -->
    <div class="hero-bg">
        <div class="hero-content">
            <h1 class="hero-title">Bienvenue chez Baroueli‑TECH</h1>
            <p class="hero-sub">Votre supermarché du numérique et de la connaissance — matériel, livres et solutions pour tous vos besoins.</p>

            <div class="hero-cta">
                <a href="{{ route('produits.index') }}" class="btn btn-cta btn-primary-cta">Découvrir nos produits</a>
                <a href="#promotions" class="btn btn-cta btn-outline-cta">Voir les promos</a>
            </div>
        </div>
    </div>

    <!-- PROMOTIONS (carousel) -->
    <section id="promotions" class="section-card mt-5 promo-carousel">
        <h2 class="section-title">💻 Promotions du jour</h2>
        <p class="section-sub">Offres limitées — profitez des meilleures remises sur nos produits phares.</p>

        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center g-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="promo-card card shadow-sm position-relative">
                                <span class="promo-badge">-20%</span>
                                <img src="{{ asset('Images/promotions/laptop.jpg') }}" class="promo-img" alt="Promo Laptop">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Ordinateurs portables</h5>
                                    <p class="card-text">Ultrabooks et gaming — performance et design.</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Ordinateurs portables" data-img="{{ asset('Images/promotions/laptop.jpg') }}" data-desc="Sélection d'ultrabooks et gaming — performance et design.">Voir l'offre</button>
                                        <a href="#" class="btn btn-outline-secondary">Détails</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="promo-card card shadow-sm position-relative">
                                <span class="promo-badge">-40%</span>
                                <img src="{{ asset('Images/promotions/books.jpg') }}" class="promo-img" alt="Promo Livres">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Livres & Librairie</h5>
                                    <p class="card-text">Manuels scolaires, romans et guides techniques à prix cassés.</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Livres & Librairie" data-img="{{ asset('Images/promotions/books.jpg') }}" data-desc="Manuels scolaires, romans et guides techniques à prix cassés.">Voir l'offre</button>
                                        <a href="#" class="btn btn-outline-secondary">Détails</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Example second slide (duplicate structure) -->
                <div class="carousel-item">
                    <div class="row justify-content-center g-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="promo-card card shadow-sm position-relative">
                                <span class="promo-badge">🔥 Best</span>
                                <img src="{{ asset('Images/promotions/laptop.jpg') }}" class="promo-img" alt="Promo">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Top Vente</h5>
                                    <p class="card-text">Offre spéciale sur une sélection limitée.</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Top Vente" data-img="{{ asset('Images/promotions/laptop.jpg') }}" data-desc="Offre spéciale sur une sélection limitée.">Voir l'offre</button>
                                        <a href="#" class="btn btn-outline-secondary">Détails</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="promo-card card shadow-sm position-relative">
                                <span class="promo-badge">-15%</span>
                                <img src="{{ asset('Images/promotions/books.jpg') }}" class="promo-img" alt="Promo">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Sélection Étudiants</h5>
                                    <p class="card-text">Remises spéciales pour la rentrée et les étudiants.</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#promoModal" data-title="Sélection Étudiants" data-img="{{ asset('Images/promotions/books.jpg') }}" data-desc="Remises spéciales pour la rentrée et les étudiants.">Voir l'offre</button>
                                        <a href="#" class="btn btn-outline-secondary">Détails</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section class="section-card section-blue mt-5">
        <h2 class="section-title">🛒 Catégories</h2>
        <p class="section-sub">Explorez nos univers — matériel, livres et solutions bureautiques.</p>

        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="category-card shadow-sm">
                    <img src="{{ asset('Images/categories/M_informatique.jpg') }}" class="category-img" alt="Informatique">
                    <div class="card-body">
                        <div class="category-title">Matériel Informatique</div>
                        <div class="category-text">PC, composants, périphériques et accessoires.</div>
                        <a href="#" class="btn btn-success btn-sm">Explorer</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="category-card shadow-sm">
                    <img src="{{ asset('Images/categories/librairie.jpg') }}" class="category-img" alt="Librairie">
                    <div class="card-body">
                        <div class="category-title">Librairie</div>
                        <div class="category-text">Scolaire, technique et loisirs — pour tous les lecteurs.</div>
                        <a href="#" class="btn btn-success btn-sm">Explorer</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="category-card shadow-sm">
                    <img src="{{ asset('Images/categories/bureautique.jpg') }}" class="category-img" alt="Bureautique">
                    <div class="card-body">
                        <div class="category-title">Bureautique</div>
                        <div class="category-text">Imprimantes, scanners et fournitures professionnelles.</div>
                        <a href="#" class="btn btn-success btn-sm">Explorer</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DELIVERY & PICKUP -->
    <section class="section-card mt-5">
        <h2 class="section-title">🚚 Livraison & Retrait</h2>
        <p class="section-sub">Choisissez la solution qui vous convient : rapide, sûre et pratique.</p>

        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="service-card text-center shadow-sm">
                    <div class="service-icon">🚚</div>
                    <h4 class="mb-2">Livraison à domicile</h4>
                    <p class="small-muted mb-3">Livraison rapide et suivie — emballage sécurisé pour tous vos achats.</p>
                    <ul class="list-unstyled small-muted mb-3">
                        <li>Suivi en temps réel</li>
                        <li>Livraison express disponible</li>
                        <li>Retours faciles</li>
                    </ul>
                    <a href="#" class="btn btn-primary">Choisir livraison</a>
                </div>
            </div>

            <div class="col-md-5">
                <div class="service-card text-center shadow-sm">
                    <div class="service-icon">🏬</div>
                    <h4 class="mb-2">Retrait en magasin</h4>
                    <p class="small-muted mb-3">Commandez en ligne et récupérez en boutique sans frais.</p>
                    <ul class="list-unstyled small-muted mb-3">
                        <li>Prise en charge en 2 heures</li>
                        <li>Contrôle qualité avant remise</li>
                        <li>Assistance sur place</li>
                    </ul>
                    <a href="#" class="btn btn-primary">Choisir retrait</a>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER -->
    <section class="section-card section-blue mt-5 text-center">
        <h2 class="section-title">Restez informé</h2>
        <p class="section-sub">Inscrivez-vous à notre newsletter pour recevoir les meilleures offres et nouveautés.</p>

        <div class="newsletter">
            <input type="email" placeholder="Votre adresse e‑mail" aria-label="Email newsletter">
            <button class="btn btn-primary">S'inscrire</button>
        </div>

        <p class="small-muted mt-3">En vous inscrivant, vous acceptez de recevoir des communications de Baroueli‑TECH. Vous pouvez vous désinscrire à tout moment.</p>
    </section>

    <!-- FOOTER MINI -->
    <footer class="app-footer text-center">
        <div class="small-muted">© {{ date('Y') }} Baroueli‑TECH — Tous droits réservés.</div>
    </footer>
</div>

<!-- PROMO MODAL -->
<div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-body p-0">
        <div class="row g-0">
          <div class="col-md-6">
            <img src="{{ asset('Images/promotions/laptop.jpg') }}" id="promoModalImg" class="img-fluid h-100 w-100" style="object-fit:cover;" alt="Promo">
          </div>
          <div class="col-md-6 p-4">
            <h3 id="promoModalTitle" class="mb-2">Titre</h3>
            <p id="promoModalDesc" class="text-muted mb-4">Description</p>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-danger">Profiter de l'offre</a>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Inline script to wire modal and small interactions -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Promo modal population
        var promoModal = document.getElementById('promoModal');
        promoModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var title = button.getAttribute('data-title') || 'Offre';
            var img = button.getAttribute('data-img') || '{{ asset('Images/promotions/laptop.jpg') }}';
            var desc = button.getAttribute('data-desc') || '';

            document.getElementById('promoModalTitle').textContent = title;
            document.getElementById('promoModalImg').setAttribute('src', img);
            document.getElementById('promoModalDesc').textContent = desc;
        });

        // Simple keyboard accessibility: press "p" to jump to promotions
        document.addEventListener('keydown', function(e) {
            if (e.key === 'p' || e.key === 'P') {
                var el = document.getElementById('promotions');
                if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
@endsection
