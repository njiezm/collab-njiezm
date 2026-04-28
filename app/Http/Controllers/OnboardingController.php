<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class OnboardingController extends Controller
{
    // --- MÉTHODE AFFICHAGE (GET) ---
    public function showForm($token)
    {
        $project = Project::where('token', $token)->firstOrFail();

        // 1. Récupérer les données brutes depuis la BDD
        $dbData = $project->data;

        // 2. Décoder si c'est une chaîne JSON
        if (is_string($dbData)) {
            $dbData = json_decode($dbData, true);
        }

        // 3. Si c'est null ou vide, on initialise des tableaux vides
        if (!is_array($dbData)) {
            $dbData = [];
        }

        // 4. Séparer clairement les données textes et les fichiers
        // Cela correspond à la structure que nous forçons dans submitForm
        $formData = $dbData['form_data'] ?? [];
        // dd($formData);
        $uploadedFiles = $dbData['uploaded_files'] ?? [];



        // 5. Retourner la vue avec toutes les variables nécessaires
        return view('onboarding.form', [
            'token' => $token,
            'project' => $project,
            'formData' => $formData,        // Pour les inputs textes (Nom, Email, etc.)
            'uploadedFiles' => $uploadedFiles // Pour afficher les images existantes
        ]);
    }

    // --- MÉTHODE ENREGISTREMENT (POST) ---
    public function submitForm(Request $request, $token)
    {
        $project = Project::where('token', $token)->firstOrFail();
        // 1. Récupérer les données textes du formulaire actuel
        $newFormData = $request->input('form_data', []);
        if (!is_array($newFormData)) {
            $newFormData = [];
        }

        // 2. Gestion des fichiers (Uploads)
        $newFilePaths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key => $file) {
                if ($file && $file->isValid()) {
                    // On stocke le fichier
                    $path = $file->store('projects/' . $project->client_id, 'public');
                    // On l'ajoute à la liste des NOUVEAUX fichiers
                    $newFilePaths[$key] = $path;
                }
            }
        }

        // 3. Récupérer les anciennes données de la base (pour ne pas écraser ce qui n'est pas changé)
        $existingDbData = $project->data;
        if (is_string($existingDbData)) {
            $existingDbData = json_decode($existingDbData, true);
        }
        if (!is_array($existingDbData)) {
            $existingDbData = [];
        }

        // On extrait les anciennes données textes et fichiers
        $oldFormData = $existingDbData['form_data'] ?? [];
        $oldFiles = $existingDbData['uploaded_files'] ?? [];

        // 4. Fusion intelligente des DONNÉES TEXTES
        // On fusionne les anciennes données avec les nouvelles (les nouvelles écrasent les anciennes si même clé)
        $finalFormData = array_merge($oldFormData, $newFormData);

        // 5. Fusion intelligente des FICHIERS
        // On commence par les anciens fichiers
        $finalFiles = $oldFiles;

        // Si le client a uploadé de NOUVEAUX fichiers, on les ajoute/majore
        // (array_merge écrase les clés existantes, donc un nouveau fichier écrase l'ancien si même clé)
        if (!empty($newFilePaths)) {
            $finalFiles = array_merge($finalFiles, $newFilePaths);
        }

        // 6. Construction du tableau final propre à sauvegarder en BDD
        // Nous forçons la structure : [ 'form_data' => ..., 'uploaded_files' => ... ]
        $finalDataToSave = [
            'form_data' => $finalFormData,
            'uploaded_files' => $finalFiles
        ];

        // 7. Update
        $project->update([
            'data' => $finalDataToSave,
            'status' => 'filled'
        ]);

        return redirect()->back()->with('success', 'Informations enregistrées avec succès !');
    }
}
