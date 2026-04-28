<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NJIEZM.FR | Expertise IT & Gestion de Projet')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <meta name="description" content="@yield('meta_description', 'NJIEZM.FR - Expertise IT, développement web, gestion de projet informatique et solutions digitales sur mesure en Martinique et à distance.')">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'NJIEZM.FR | Expertise IT & Gestion de Projet')">
    <meta property="og:description" content="@yield('meta_description', 'Expertise IT, développement web et gestion de projet en Martinique.')">
    <meta property="og:image" content="{{ asset('images/preview.jpg') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'NJIEZM.FR | Expertise IT & Gestion de Projet')">
    <meta name="twitter:description" content="@yield('meta_description', 'Expertise IT, développement web et gestion de projet en Martinique.')">
    <meta name="twitter:image" content="{{ asset('images/preview.jpg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&family=Space+Grotesk:wght@300;500;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5859227780011698"
     crossorigin="anonymous"></script>
</head>
<body>

    <main>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<!-- PAGE HEADER -->
<header class="page-header text-center">
    <div class="container">
        <h1 class="display-4 fw-bold" style="font-family: 'Special Elite';">SÉCURITÉ <span style="color: var(--nj-yellow);">&</span> SYSTÈME</h1>
        <p class="lead">Espace réservé aux administrateurs.</p>
    </div>
</header>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">

            <!-- BOX COLLAGE STYLE -->
            <div class="collage-box rotate-left">

                <div class="text-center mb-4">
                    <i class="fas fa-user-shield fa-4x text-njie mb-3" style="opacity: 0.8;"></i>
                    <h2 class="h3 fw-bold">CONNEXION</h2>
                    <div class="small text-muted mb-4" style="font-family: 'JetBrains Mono';">
                        ACCÈS RESTREINT
                    </div>
                </div>

                <!-- FORMULAIRE -->
                <form action="{{ route('admin.login.process') }}" method="POST">
                    @csrf

                    <!-- Message d'erreur -->
                    @if(session('error'))
                        <div class="alert alert-danger text-center mb-4 border border-danger" role="alert" style="background: #f8d7da; color: #721c24;">
                            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-njie">Email</label>
                        <input type="email" name="email"
                            value="admin@njiezm.fr"
                            class="form-control border-njie bg-light fw-medium"
                            placeholder="admin@njiezm.fr">
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-njie">Mot de passe</label>
                        <input type="password" name="password"
                            class="form-control border-njie fw-medium"
                            placeholder="••••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-njie btn-lg w-100 fw-bold py-3">
                        <i class="fas fa-lock me-2"></i> OUVRIR LE PANNEAU
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top border-secondary text-center">
                    <a href="{{ url('/') }}" class="small text-muted text-decoration-none hover:text-njie">
                        <i class="fas fa-globe me-1"></i> Retour au site public
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
</body>
</html>
