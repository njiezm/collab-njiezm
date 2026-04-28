<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Affiche ou télécharge un fichier d'un projet.
     * Path attendu : projects/{client_id}/{filename}
     */
    public function getProjectFile($path)
    {
        // Sécurité : On s'assure que le chemin est bien dans le dossier projects
        // On utilise le disque 'public' qui pointe vers storage/app/public
        $disk = Storage::disk('public');

        // Vérification d'existence
        if ($disk->exists($path)) {
            // On renvoie le fichier. Le 2ème argument force le téléchargement (pour éviter que le navigateur ouvre l'image direct).
            // Si tu veux visualiser l'image dans le navigateur, retire le 2ème argument.
            return $disk->download($path, null, []);
        }

        // Si le fichier n'existe pas
        abort(404, 'Fichier introuvable');
    }
}
