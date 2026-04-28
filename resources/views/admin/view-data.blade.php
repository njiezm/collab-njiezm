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
<header class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold" style="font-family: 'Special Elite'; letter-spacing: 1px;">
            DONNÉES <span style="color: var(--nj-yellow);">&</span> RÉCEPTION
        </h1>
        <p class="lead">Visualisation des informations saisies pour <strong class="text-white">{{ $project->name }}</strong>.</p>
    </div>
</header>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- STYLE COLLAGE BOX (Gauche pour lecture) -->
            <div class="collage-box">

                <div class="d-flex justify-content-between align-items-end mb-4 pb-2 border-bottom border-secondary">
                    <div>
                        <span class="newspaper-badge">CLIENT</span>
                        <h2 class="h3 fw-bold m-0">Informations reçues</h2>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-dark" style="border-radius: 0; font-family: 'JetBrains Mono';">
                        <i class="fas fa-arrow-left me-1"></i> Retour
                    </a>
                </div>

                @if($project->formConfig)
                    @foreach($project->formConfig->fields as $section)

                        <!-- TITRE DE SECTION -->
                        <div class="mb-5 mt-4">
                            <h3 class="h5 fw-bold text-njie" style="font-family: 'JetBrains Mono'; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid var(--nj-yellow); padding-bottom: 8px; display: inline-block;">
                                {{ $section['section'] }}
                            </h3>
                        </div>

                        <!-- GRILLE DES VALEURS -->
                        <div class="row g-4">
                            @foreach($section['fields'] as $field)
                                <div class="col-12 col-md-6">
                                    <div class="bg-light p-4 border-start border-njie border-4 shadow-sm h-100 position-relative">

                                        <!-- LABEL DU CHAMP -->
                                        <label class="small fw-bold text-secondary text-uppercase mb-2 d-block">
                                            {{ $field['label'] }}
                                            @if($field['required']) <span class="text-danger ms-1">*</span> @endif
                                        </label>

                                        <!-- AFFICHAGE DE LA VALEUR -->
                                        @switch($field['type'])

                                           @case('file')
    @php $file = $project->data['uploaded_files'][$field['key']] ?? null; @endphp
    @if($file)
        <div class="mt-2">

            <!-- BOUTON TÉLÉCHARGER (Force le download) -->
            <a href="{{ route('projects.file.get', $file) }}" download class="btn btn-njie btn-sm w-100 text-center mb-2">
                <i class="fas fa-download me-2"></i> Télécharger le fichier
            </a>

            <!-- BOUTON APERÇU (Ouvre dans le navigateur) -->
            <a href="{{ asset($file) }}" target="_blank" class="btn btn-outline-dark w-100 text-center btn-sm">
                <i class="fas fa-eye me-2"></i> Aperçu (Voir image)
            </a>
        </div>
    @else
        <span class="text-muted fst-italic small">
            <i class="fas fa-times-circle me-1"></i> Non fourni
        </span>
    @endif
@break

                                            @case('color')
                                                <div class="d-flex align-items-center gap-3 mt-1">
                                                    <!-- CORRECTION ICI : On cherche dans form_data -->
                                                    <div style="background-color: {{ $project->data['form_data'][$field['key']] ?? '#ffffff' }}; width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ccc; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></div>
                                                    <div>
                                                        <div class="fw-bold text-njie fs-5" style="font-family: 'JetBrains Mono';">
                                                            {{ $project->data['form_data'][$field['key']] ?? 'Aucune' }}
                                                        </div>
                                                        <div class="small text-muted">HEX CODE</div>
                                                    </div>
                                                </div>
                                            @break

                                            @default
                                                <!-- CORRECTION ICI : On cherche dans form_data -->
                                                @if(isset($project->data['form_data'][$field['key']]) && !empty($project->data['form_data'][$field['key']]))
                                                    <p class="mb-0 fw-bold text-dark lh-base" style="font-size: 1.1rem;">
                                                        {{ $project->data['form_data'][$field['key']] }}
                                                    </p>
                                                @else
                                                    <span class="text-muted fst-italic small">
                                                        <i class="fas fa-minus-circle me-1"></i> Non renseigné
                                                    </span>
                                                @endif
                                        @endswitch
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning text-center mt-4" role="alert" style="background: #fff3cd; border: 2px solid var(--nj-yellow);">
                        <i class="fas fa-exclamation-triangle me-2"></i> <strong>Aucune configuration de formulaire trouvée.</strong> Veuillez configurer le projet pour visualiser les données.
                    </div>
                @endif

                <!-- FOOTER DE CARTE -->
                <div class="mt-5 pt-4 border-top border-secondary text-center">
                    <div class="small text-muted">
                        <i class="fas fa-clock me-1"></i> Mis à jour le : {{ $project->updated_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</body>
</html>
