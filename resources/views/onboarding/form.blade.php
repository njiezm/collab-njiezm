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

<!-- Page Header pour le client -->
<header class="page-header text-center" style="margin-bottom: 20px; padding: 40px 0;">
    <div class="container">
        <h1 class="display-4 fw-bold" style="font-family: 'Special Elite';">ONBOARDING</h1>
        <p class="lead">Configuration du projet : {{ $project->name }}</p>
    </div>
</header>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Utilisation du style COLLAGE BOX -->
            <div class="collage-box">

                <div class="text-center mb-5 pb-4 border-bottom border-secondary">
                    <span class="newspaper-badge">CLIENT</span>
                    <h2 class="h3 fw-bold mt-2">Configuration pour {{ $project->client->name }}</h2>
                    <p class="text-muted">Veuillez remplir les informations ci-dessous pour lancer le développement.</p>
                </div>

                  @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


                <!-- On parcours la config pour générer le formulaire -->
                <form id="onboarding-form" action="{{ route('client.onboarding.submit', $token) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if($project->formConfig && $project->formConfig->fields)
                        @foreach($project->formConfig->fields as $section)

                            <!-- TITRE DE SECTION -->
                            <div class="mt-5 mb-4">
                                <h3 class="h5 fw-bold text-njie" style="font-family: 'JetBrains Mono'; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid var(--nj-yellow); padding-bottom: 5px; display: inline-block;">
                                    {{ $section['section'] }}
                                </h3>
                            </div>

                            <div class="row g-4">
                                @foreach($section['fields'] as $field)
                                    <div class="col-12 @if($field['type'] == 'textarea') col-md-12 @else col-md-6 @endif">

                                        <label class="form-label small fw-bold text-uppercase text-njie mb-1">
                                            {{ $field['label'] }}
                                            @if($field['required']) <span class="text-danger ms-1">*</span> @endif
                                        </label>

                                        @switch($field['type'])
                                            @case('textarea')
                                                <textarea name="form_data[{{ $field['key'] }}]"
                                                    class="form-control border-njie fw-medium"
                                                    rows="5"
                                                    placeholder="Votre réponse..."
                                                    @if($field['required']) required @endif>{{ $formData[$field['key']] ?? old('form_data.'.$field['key']) }}</textarea>
                                            @break

                                        @case('file')
    <div>

        <!-- Input File -->
        <input type="file"
            name="files[{{ $field['key'] }}]"
            class="form-control border-njie"
            style="padding-top: 8px;"
            @if($field['required'] && !isset($uploadedFiles[$field['key']])) required @endif>

        <!-- AFFICHAGE FICHIER EXISTANT -->
        @if(isset($uploadedFiles[$field['key']]))
            @php
                $file = $uploadedFiles[$field['key']];
                $url = asset('storage/' . $file);
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
            @endphp

            <div class="mt-2 p-2 bg-light border border-njie-dashed rounded">

                <div class="small text-success fw-bold mb-2">
                    <i class="fas fa-check-circle me-1"></i>
                    Fichier déjà enregistré :
                </div>

                <!-- 🔥 SI IMAGE => AFFICHAGE DIRECT -->
                @if($isImage)
                    <div class="mb-2">
                        <img src="{{ $url }}"
                             alt="Fichier uploadé"
                             style="max-width: 220px; border-radius: 8px; border: 1px solid #ddd;">
                    </div>
                @else
                    <div class="mb-2 small text-muted">
                        <i class="fas fa-file me-1"></i>
                        Fichier non image ({{ $extension }})
                    </div>
                @endif

                <!-- LIEN OUVERTURE -->
                <a href="{{ $url }}"
                   target="_blank"
                   class="text-njie fw-bold small text-decoration-none">
                    <i class="fas fa-external-link-alt me-1"></i>
                    Ouvrir le fichier actuel
                </a>

                <p class="small text-muted fst-italic mt-1">
                    Si vous en sélectionnez un nouveau, il remplacera celui-ci.
                </p>
            </div>
        @endif

    </div>
@break

                                            @case('color')
                                                <div class="input-group">
                                                    <input type="color" name="form_data[{{ $field['key'] }}]"
                                                        class="form-control form-control-color border-njie p-1"
                                                        style="height: 42px;"
                                                        value="{{ $formData[$field['key']] ?? '#000000' }}"
                                                        @if($field['required']) required @endif>
                                                    <span class="input-group-text border-njie">
                                                        <i class="fas fa-palette text-muted"></i>
                                                    </span>
                                                </div>
                                            @break

                                            @case('email')
                                                <div class="input-group">
                                                    <span class="input-group-text border-njie bg-njie text-white"><i class="fas fa-envelope"></i></span>
                                                    <input type="email" name="form_data[{{ $field['key'] }}]"
                                                        class="form-control border-njie fw-medium"
                                                        placeholder="email@exemple.com"
                                                        value="{{ $formData[$field['key']] ?? old('form_data.'.$field['key']) }}"
                                                        @if($field['required']) required @endif>
                                                </div>
                                            @break

                                            @case('tel')
                                                <div class="input-group">
                                                    <span class="input-group-text border-njie bg-njie text-white"><i class="fas fa-phone"></i></span>
                                                    <input type="tel" name="form_data[{{ $field['key'] }}]"
                                                        class="form-control border-njie fw-medium"
                                                        placeholder="0696 XX XX XX"
                                                        value="{{ $formData[$field['key']] ?? old('form_data.'.$field['key']) }}"
                                                        @if($field['required']) required @endif>
                                                </div>
                                            @break

                                            @case('number')
                                                <div class="input-group">
                                                    <span class="input-group-text border-njie bg-njie text-white"><i class="fas fa-hashtag"></i></span>
                                                    <input type="number" name="form_data[{{ $field['key'] }}]"
                                                        class="form-control border-njie fw-medium"
                                                        placeholder="0"
                                                        value="{{ $formData[$field['key']] ?? old('form_data.'.$field['key']) }}"
                                                        @if($field['required']) required @endif>
                                                </div>
                                            @break

                                            @default
                                                <input type="text" name="form_data[{{ $field['key'] }}]"
                                                    class="form-control border-njie fw-medium"
                                                    placeholder="Votre saisie..."
                                                    value="{{ $formData[$field['key']] ?? old('form_data.'.$field['key']) }}"
                                                    @if($field['required']) required @endif>
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning text-center" role="alert" style="background: #fff3cd; border-color: #ffeeba; color: #856404;">
                            <i class="fas fa-exclamation-triangle me-2"></i> <strong>En attente :</strong> Le formulaire n'a pas encore été configuré par l'agence. Revenez plus tard.
                        </div>
                    @endif

                    <div class="mt-5 pt-4 border-top">
                        <div id="autosave-status" class="small text-muted mb-3 text-center">Modifiez un champ pour enregistrer automatiquement.</div>
                        <button type="submit" class="btn btn-njie btn-lg w-100 fw-bold py-3">
                            <i class="fas fa-paper-plane me-2"></i> SAUVEGARDER
                        </button>
                        <p class="text-center small text-muted mt-3">
                            En cliquant sur valider, vous acceptez que ces données soient transmises pour le développement de votre projet.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Gestion des messages de succès/erreur -->
{{-- @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif --}}

</main>
<script>
    (function () {
        const form = document.getElementById('onboarding-form');
        const statusEl = document.getElementById('autosave-status');
        if (!form || !statusEl) return;

        let debounceTimer = null;
        let isSaving = false;
        let hasQueuedSave = false;

        const setStatus = (text, colorClass = 'text-muted') => {
            statusEl.className = `small mb-3 text-center ${colorClass}`;
            statusEl.textContent = text;
        };

        const saveForm = async () => {
            if (isSaving) {
                hasQueuedSave = true;
                return;
            }

            isSaving = true;
            setStatus('Enregistrement en cours...', 'text-warning');

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                setStatus('Enregistre automatiquement.', 'text-success');
            } catch (error) {
                setStatus('Erreur d enregistrement. Verifiez la connexion.', 'text-danger');
            } finally {
                isSaving = false;
                if (hasQueuedSave) {
                    hasQueuedSave = false;
                    saveForm();
                }
            }
        };

        const scheduleSave = () => {
            clearTimeout(debounceTimer);
            setStatus('Modifications detectees...', 'text-muted');
            debounceTimer = setTimeout(saveForm, 900);
        };

        form.querySelectorAll('input, textarea, select').forEach((field) => {
            if (field.type === 'file') {
                field.addEventListener('change', scheduleSave);
            } else {
                field.addEventListener('input', scheduleSave);
                field.addEventListener('change', scheduleSave);
            }
        });
    })();
</script>
</body>
</html>
