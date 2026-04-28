<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Collaboration | NJIEZM.FR</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&family=Space+Grotesk:wght@300;500;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


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


    <style>
        :root {
            --nj-blue: #004aad;    /* Bleu NJIEZM */
            --nj-yellow: #ffde59;  /* Jaune NJIEZM */
            --nj-dark: #0a192f;
            --nj-blue-light: #f0f7ff;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Space Grotesk', sans-serif;
            color: var(--nj-dark);
        }

        .page-header {
            background: var(--nj-dark);
            color: white;
            padding: 60px 0;
            border-bottom: 6px solid var(--nj-yellow);
            position: relative;
        }

        .page-header::after {
            content: "";
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--nj-blue) 0%, var(--nj-yellow) 50%, var(--nj-blue) 100%);
        }

        .collage-box {
            background: white;
            padding: 40px;
            border: 3px solid var(--nj-dark);
            box-shadow: 15px 15px 0px var(--nj-yellow); /* Ombre Jaune Signature */
            position: relative;
        }

        .newspaper-badge {
            background: var(--nj-yellow);
            color: var(--nj-dark);
            padding: 5px 15px;
            font-family: 'JetBrains Mono';
            font-weight: bold;
            display: inline-block;
            margin-bottom: 15px;
            border: 2px solid var(--nj-dark);
            transform: rotate(-1.5deg);
        }

        .text-njie-blue {
            color: var(--nj-blue);
        }

        .btn-njie {
            background: var(--nj-blue);
            color: white;
            border: 2px solid var(--nj-dark);
            border-radius: 0;
            transition: all 0.3s;
            font-family: 'JetBrains Mono';
            text-transform: uppercase;
            font-weight: bold;
            padding: 12px 25px;
        }

        .btn-njie:hover {
            background: var(--nj-yellow);
            color: var(--nj-dark);
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0 var(--nj-dark);
        }

        .contact-item {
            padding: 15px;
            border-left: 5px solid var(--nj-yellow);
            background: var(--nj-blue-light);
            margin-bottom: 15px;
            transition: all 0.2s;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .contact-item:hover {
            border-left-color: var(--nj-blue);
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .site-link {
            text-decoration: none;
            color: var(--nj-blue);
            font-weight: 700;
            border-bottom: 2px solid var(--nj-yellow);
            padding-bottom: 2px;
        }

        .logo-font {
            font-family: 'Special Elite';
        }

        .accent-yellow {
            color: var(--nj-yellow);
        }
    </style>
</head>
<body>

<main>
    <!-- Header avec rappel du Bleu et du Jaune -->
    <header class="page-header text-center">
        <div class="container position-relative">
            <h1 class="display-3 fw-bold logo-font">NJIEZM<span class="accent-yellow">.FR</span></h1>
            <p class="lead text-uppercase tracking-widest" style="letter-spacing: 4px; font-weight: 300;">
                Plateforme de <span class="fw-bold">Collaboration</span>
            </p>
            <div class="mt-3">
                <span class="badge px-4 py-2" style="background: var(--nj-blue); border: 1px solid var(--nj-yellow);">EXPERT IT & DIGITAL</span>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Main Content Box -->
                <div class="collage-box">

                    <div class="text-center mb-5 pb-4 border-bottom border-dark border-2">
                        <span class="newspaper-badge">PLATEFORME OFFICIELLE</span>
                        <h2 class="h3 fw-bold mt-2 text-njie-blue">Espace Client / Expert</h2>
                        <p class="text-muted">La synergie au service de votre projet numérique.</p>
                    </div>

                    <div class="row g-5">
                        <div class="col-md-6">
                            <h3 class="h5 fw-bold mb-4" style="font-family: 'JetBrains Mono'; border-bottom: 3px solid var(--nj-yellow); display: inline-block;">CONCEPT</h3>
                            <p>Bienvenue sur l'interface de collaboration signée <strong>NJIEZM.FR</strong>.</p>
                            <p>Cet espace est le point de rencontre entre votre vision métier et notre expertise technologique. Nous y centralisons les échanges pour garantir transparence et efficacité.</p>

                            <div class="mt-4">
                                <a href="https://njiezm.fr" target="_blank" class="btn btn-njie">
                                    <i class="bi bi-rocket-takeoff me-2"></i> Accéder au site web
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h3 class="h5 fw-bold mb-4" style="font-family: 'JetBrains Mono'; border-bottom: 3px solid var(--nj-yellow); display: inline-block;">CONTACT</h3>

                            <div class="contact-item">
                                <small class="text-uppercase text-muted d-block fw-bold" style="font-size: 0.7rem;">Agence de Développement</small>
                                <strong class="text-njie-blue">NJIEZM.FR</strong>
                            </div>

                            <div class="contact-item">
                                <small class="text-uppercase text-muted d-block fw-bold" style="font-size: 0.7rem;">Support Direct</small>
                                <a href="mailto:contact@njiezm.fr" class="text-dark text-decoration-none"><strong>contact@njiezm.fr</strong></a>
                            </div>

                            <div class="contact-item">
                                <small class="text-uppercase text-muted d-block fw-bold" style="font-size: 0.7rem;">Territoire</small>
                                <strong>Martinique & International</strong>
                            </div>

                            <div class="contact-item">
                                <small class="text-uppercase text-muted d-block fw-bold" style="font-size: 0.7rem;">Lien Permanent</small>
                                <a href="https://njiezm.fr" target="_blank" class="site-link">www.njiezm.fr</a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top border-secondary border-dashed text-center">
                        <p class="small text-muted mb-0">
                            <strong>NJIEZM.FR</strong> — Expertise en Développement Web & Gestion de Projet.
                            <br><span class="text-njie-blue">Plateforme de collaboration exclusive.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
