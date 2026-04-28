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
<header class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold" style="font-family: 'Special Elite'; letter-spacing: 1px;">
            CONFIGURATION <span style="color: var(--nj-yellow);">&</span> FORMULAIRE
        </h1>
        <p class="lead">Définissez la structure des données collectées pour le projet <strong class="text-warning">{{ $project->name }}</strong>.</p>
    </div>
</header>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12">

            <!-- STYLE COLLAGE BOX -->
            <div class="collage-box rotate-right">

                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <div>
                        <span class="newspaper-badge">BUILDER</span>
                        <h2 class="h3 fw-bold m-0">Éditeur de Structure</h2>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-dark" style="border-radius: 0;">
                        <i class="bi bi-arrow-left me-2"></i> Retour
                    </a>
                </div>

                <!-- FORMULAIRE -->
                <form id="config-form" action="{{ route('admin.project.save.config', $project->id) }}" method="POST">
                    @csrf
                    <!-- Input caché qui va recevoir le JSON final -->
                    <input type="hidden" name="fields_json" id="fields_json_input">

                    <!-- CONTAINER DYNAMIQUE (Sections et champs générés par JS) -->
                    <div id="config-container">
                        <!-- Le contenu s'injectera ici -->
                    </div>

                    <!-- BOUTONS D'ACTION GENERAUX -->
                    <div class="mt-5 pt-4 border-top border-secondary d-flex justify-content-between align-items-center">
                        <button type="button" onclick="addSection()" class="btn btn-njie btn-njie-sm">
                            <i class="bi bi-plus-circle me-2"></i> Ajouter une Section
                        </button>

                        <button type="submit" class="btn btn-njie fw-bold" style="box-shadow: 5px 5px 0px var(--nj-white);">
                            <i class="bi bi-save me-2"></i> Enregistrer la Configuration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>

<script>
    // Données initiales depuis le contrôleur PHP
    // Si aucune config, on part d'un tableau vide
let configData = @json($project->formConfig->fields ?? []);

if (!Array.isArray(configData)) {
    configData = [];
}
    // FONCTION PRINCIPALE DE RENDU
    function renderConfig() {
        const container = document.getElementById('config-container');
        container.innerHTML = '';

        if (configData.length === 0) {
            container.innerHTML = `
                <div class="text-center py-5 bg-white border border-njie-dashed p-4">
                    <i class="bi bi-inbox fs-1 text-secondary"></i>
                    <p class="fw-bold mt-3">Aucune section configurée</p>
                    <p class="text-muted">Cliquez sur "Ajouter une Section" pour commencer.</p>
                </div>
            `;
            return;
        }

        configData.forEach((section, sIndex) => {
            // Génération HTML pour une section
            const sectionHtml = `
                <div class="card bg-white border-njie mb-4 shadow-sm position-relative">
                    <!-- Bouton supprimer section -->
                    <button type="button" onclick="removeSection(${sIndex})" class="btn-close position-absolute top-2 end-2 text-danger" title="Supprimer la section"></button>

                    <!-- Titre de la section (Input texte éditable) -->
                    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                        <input type="text" value="${section.section}" onchange="updateSectionName(${sIndex}, this.value)"
                            class="form-control bg-transparent border-0 p-0 fw-bold fs-5 text-njie"
                            style="font-family: 'Special Elite'; letter-spacing: 1px;"
                            placeholder="Nom de la section...">
                    </div>

                    <!-- Conteneur des champs de cette section -->
                    <div class="card-body px-4 pt-2">
                        <div class="fields-container">
                            ${section.fields.map((field, fIndex) => `
                                <div class="bg-light p-3 mb-2 border-start border-njie border-4 position-relative">
                                    <div class="row g-2 align-items-center">
                                        <!-- Colonne 1 : Clé (Key) -->
                                        <div class="col-md-3">
                                            <input type="text" value="${field.key}" onchange="updateField(${sIndex}, ${fIndex}, 'key', this.value)"
                                                class="form-control form-control-sm border-njie fw-medium font-monospace"
                                                placeholder="Clé (db)" required>
                                        </div>

                                        <!-- Colonne 2 : Label -->
                                        <div class="col-md-4">
                                            <input type="text" value="${field.label}" onchange="updateField(${sIndex}, ${fIndex}, 'label', this.value)"
                                                class="form-control form-control-sm border-njie"
                                                placeholder="Label visible" required>
                                        </div>

                                        <!-- Colonne 3 : Type (Select) -->
                                        <div class="col-md-3">
                                            <select onchange="updateField(${sIndex}, ${fIndex}, 'type', this.value)" class="form-select form-select-sm border-njie">
                                                <option value="text" ${field.type === 'text' ? 'selected' : ''}>Texte</option>
                                                <option value="email" ${field.type === 'email' ? 'selected' : ''}>Email</option>
                                                <option value="tel" ${field.type === 'tel' ? 'selected' : ''}>Téléphone</option>
                                                <option value="textarea" ${field.type === 'textarea' ? 'selected' : ''}>Zone de texte</option>
                                                <option value="number" ${field.type === 'number' ? 'selected' : ''}>Nombre</option>
                                                <option value="file" ${field.type === 'file' ? 'selected' : ''}>Fichier</option>
                                                <option value="color" ${field.type === 'color' ? 'selected' : ''}>Couleur</option>
                                            </select>
                                        </div>

                                        <!-- Colonne 4 : Checkbox & Delete -->
                                        <div class="col-md-2 d-flex justify-content-between align-items-center">
                                            <label class="form-check-label small">
                                                <input type="checkbox" ${field.required ? 'checked' : ''} onchange="updateField(${sIndex}, ${fIndex}, 'required', this.checked)" class="form-check-input">
                                                Oblig.
                                            </label>

                                            <button type="button" onclick="removeField(${sIndex}, ${fIndex})" class="btn btn-sm text-danger btn-link p-0">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>

                        <!-- Bouton ajouter champ dans la section -->
                        <button type="button" onclick="addField(${sIndex})" class="btn btn-sm btn-outline-dark w-100" style="border-style: dashed; font-family: 'JetBrains Mono';">
                            <i class="bi bi-plus-lg me-1"></i> Ajouter un champ
                        </button>
                    </div>
                </div>
            `;
            container.innerHTML += sectionHtml;
        });
    }

    // FONCTIONS DE MANIPULATION DES DONNÉES (Mettre à jour le tableau JS)
    function updateSectionName(index, val) {
        configData[index].section = val;
    }

    function updateField(sIndex, fIndex, key, val) {
        configData[sIndex].fields[fIndex][key] = val;
    }

    function addSection() {
        configData.push({ section: 'Nouvelle Section', fields: [] });
        renderConfig();
    }

    function removeSection(index) {
        if(confirm('Supprimer cette section et tous ses champs ?')) {
            configData.splice(index, 1);
            renderConfig();
        }
    }

    function addField(sIndex) {
        configData[sIndex].fields.push({
            key: 'nouveau_champ',
            label: 'Nouveau Champ',
            type: 'text',
            required: false
        });
        renderConfig();
    }

    function removeField(sIndex, fIndex) {
        if(confirm('Supprimer ce champ ?')) {
            configData[sIndex].fields.splice(fIndex, 1);
            renderConfig();
        }
    }

    // AVANT LE SUBMIT : On transforme l'objet JS en JSON string dans l'input caché
    const form = document.getElementById('config-form');
    if(form) {
        form.addEventListener('submit', function() {
            const jsonString = JSON.stringify(configData);
            document.getElementById('fields_json_input').value = jsonString;
        });
    }

    // INITIALISATION
    document.addEventListener('DOMContentLoaded', function() {
        renderConfig();
    });
</script>
</body>
</html>

