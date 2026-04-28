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

<!-- HEADER ADMIN -->
<header class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold" style="font-family: 'Special Elite'; letter-spacing: 2px;">
            ADMIN <span style="color: var(--nj-yellow);">&</span> PROJETS
        </h1>
        <p class="lead opacity-75 mt-3">Plateforme de gestion et configuration clientèle.</p>
    </div>
</header>

<div class="container pb-5">

    <!-- MESSAGES FLASH -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="background: #d1e7dd; color: #0f5132; border: 2px solid var(--nj-blue);">
            <strong class="fw-bold"><i class="fas fa-check-circle me-2"></i> Succès !</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="background: #f8d7da; color: #842029; border: 2px solid #842029;">
            <strong class="fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> Erreur :</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- SECTION 1: CREER UN PROJET (Formulaire) -->
    <div class="row mb-5">
        <div class="col-12">
            <!-- Utilisation du style COLLAGE BOX avec rotation gauche -->
            <div class="collage-box">
                <span class="newspaper-badge">NOUVEAU PROJET</span>
                <div class="mb-3">
                    <h2 class="h3 fw-bold">Initialiser un client</h2>
                    <div style="height: 4px; background: var(--nj-blue); width: 60px;"></div>
                </div>

                <p class="mb-4 text-secondary">Créez une fiche client et générez un lien unique pour qu'il configure son site.</p>

                <form action="{{ route('admin.project.create') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="small fw-bold text-uppercase text-njie">Nom Entreprise</label>
                            <input type="text" name="company_name" required class="form-control" placeholder="Ex: Sea Fast Boat">
                        </div>
                        <div class="col-md-4">
                            <label class="small fw-bold text-uppercase text-njie">Email Client</label>
                            <input type="email" name="email" required class="form-control" placeholder="contact@entreprise.com">
                        </div>
                        <div class="col-md-4">
                            <label class="small fw-bold text-uppercase text-njie">Nom Projet</label>
                            <input type="text" name="project_name" required class="form-control" placeholder="Ex: Site Vitrine 2024">
                        </div>

                        <div class="col-md-4">
                            <label class="small fw-bold text-uppercase text-njie">Nom Contact</label>
                            <input type="text" name="contact_name" required class="form-control" placeholder="Prénom Nom">
                        </div>
                        <div class="col-md-4">
                            <label class="small fw-bold text-uppercase text-njie">Téléphone</label>
                            <input type="text" name="phone" class="form-control" placeholder="0696 XX XX XX">
                        </div>
                        <div class="col-md-4">
                            <label class="small fw-bold text-uppercase text-njie">Domaine (Optionnel)</label>
                            <input type="text" name="domain" class="form-control" placeholder="www.monsite.com">
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-njie">
                                <i class="fas fa-plus me-2"></i> Créer le projet
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SECTION 2: LISTE DES PROJETS (Tableau) -->
    <div class="row">
        <div class="col-12">
            <!-- Utilisation du style COLLAGE BOX avec rotation droite -->
            <div class="collage-box">
                <span class="newspaper-badge" style="background: white; color: var(--nj-blue);">ACTIVITÉ</span>

                <div class="d-flex justify-content-between align-items-end mb-4 border-bottom border-secondary pb-2">
                    <h2 class="h3 fw-bold m-0">Projets en cours</h2>
                    <span class="fw-bold" style="font-family: 'JetBrains Mono';">TOTAL : {{ $projects->count() }}</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>PROJET</th>
                                <th>CLIENT</th>
                                <th>STATUT</th>
                                <th class="text-center">ADMIN</th>
                                <th class="text-center">CLIENT</th>
                                <th class="text-center">DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                            <tr>
                                <td class="fw-bold">
                                    {{ $project->name }}
                                    <div class="small text-secondary fw-normal">{{ $project->domain ?? 'Domaine non défini' }}</div>
                                </td>
                                <td>
                                    <div class="fw-bold text-njie">{{ $project->client->name }}</div>
                                    <div class="small text-secondary">{{ $project->client->email }}</div>
                                    <div class="small text-muted"><i class="fas fa-user-tie me-1"></i> {{ $project->client->contact_name }}</div>
                                </td>
                                <td>
                                    @switch($project->status)
                                        @case('draft')
                                            <span class="status-badge status-draft">BROUILLON</span>
                                        @break
                                        @case('onboarding')
                                            <span class="status-badge status-onboarding">EN COURS</span>
                                        @break
                                        @case('filled')
                                            <span class="status-badge status-filled">REMPLI</span>
                                        @break
                                        @case('developing')
                                            <span class="status-badge status-developing">DEV.</span>
                                        @break
                                        @case('live')
                                            <span class="status-badge status-live">EN LIGNE</span>
                                        @break
                                        @default
                                            <span class="status-badge">INCONNU</span>
                                    @endswitch
                                </td>

                                <!-- ACTIONS ADMIN -->
                                <td class="text-center">
                                    <div class="d-flex flex-column gap-2 align-items-center">
                                        <a href="{{ route('admin.project.config', $project->id) }}" class="action-link action-configure">
                                            <i class="fas fa-sliders-h me-1"></i> Configurer
                                        </a>

                                        @if(in_array($project->status, ['filled', 'developing', 'live']))
                                            <a href="{{ route('admin.project.view.data', $project->id) }}" class="action-link action-view">
                                                <i class="fas fa-eye me-1"></i> Voir Données
                                            </a>
                                        @else
                                            <span class="text-muted small" style="font-family: 'JetBrains Mono';">En attente</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- ACTIONS CLIENT -->
                                <td class="text-center">
                                    <div class="d-flex flex-column gap-2 align-items-center">
                                        <a href="{{ route('client.onboarding', ['token' => $project->token]) }}" target="_blank" class="text-decoration-none text-njie fw-bold small">
                                            <i class="fas fa-external-link-alt me-1"></i> Formulaire
                                        </a>

                                        <button onclick="copyLink('{{ route('client.onboarding', ['token' => $project->token]) }}')" class="btn btn-sm btn-outline-dark" style="border-radius: 0; font-family: 'JetBrains Mono';">
                                            <i class="fas fa-copy me-1"></i> Copier
                                        </button>
                                    </div>
                                </td>

                                <td class="text-center" style="font-family: 'JetBrains Mono'; font-size: 0.9rem;">
                                    {{ $project->created_at->format('d/m/Y') }}<br>
                                    <span class="text-muted" style="font-size: 0.8rem;">{{ $project->created_at->format('H:i') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-box-open fa-3x mb-3 d-block text-secondary"></i>
                                        <p>Aucun projet actif.</p>
                                        <p class="small">Créez-en un ci-dessus.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
<!-- Script JS pour la copie -->
<script>
    function copyLink(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Feedback visuel
            const btn = event.currentTarget;
            const originalHtml = btn.innerHTML;

            btn.innerHTML = '<i class="fas fa-check me-1"></i> Copié !';
            btn.classList.remove('btn-outline-dark');
            btn.classList.add('btn-njie-sm'); // Style temporaire "succès"
            btn.style.backgroundColor = 'var(--nj-yellow)';
            btn.style.color = 'var(--nj-blue)';

            setTimeout(function() {
                btn.innerHTML = originalHtml;
                btn.classList.remove('btn-njie-sm');
                btn.classList.add('btn-outline-dark');
                btn.style.backgroundColor = ''; // Reset inline style
                btn.style.color = '';
            }, 2000);
        }, function(err) {
            console.error('Erreur copie : ', err);
            alert('Erreur lors de la copie du lien.');
        });
    }
</script>


</body>
</html>
