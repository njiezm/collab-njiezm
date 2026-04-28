<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\FormConfig;

class AdminController extends Controller
{
    // --- AJOUTE CECI : LA METHODE DASHBOARD ---
    public function dashboard()
    {
        // Récupérer tous les projets avec leur client associé
        $projects = Project::with('client')->latest()->get();
        $clients = Client::all(); // Pour lister les clients existants si besoin

        return view('admin.dashboard', compact('projects', 'clients'));
    }
    // ------------------------------------------

    public function createProject(Request $request)
    {
        // 1. Trouver ou créer le client par email
        $client = Client::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->company_name,
                'phone' => $request->phone,
                'contact_name' => $request->contact_name,
            ]
        );

        // 2. Créer le projet
        $project = Project::create([
            'client_id' => $client->id,
            'name' => $request->project_name,
            'domain' => $request->domain,
            'token' => \Str::random(32), // Token de sécurité
            'status' => 'onboarding'
        ]);

        // 3. Rediriger avec le lien
        $onboardingLink = route('client.onboarding', ['token' => $project->token]);

        return back()->with('success', "Projet créé ! Voici le lien à envoyer : " . $onboardingLink);
    }

    public function configProject($id)
{
    $project = Project::findOrFail($id);

    // Si pas de config, on en crée une par défaut avec les champs standards
    if (!$project->formConfig) {
        $defaultFields = [
            ['section' => 'Entreprise', 'fields' => [
                ['key' => 'company_name', 'label' => 'Raison Sociale', 'type' => 'text', 'required' => true],
                ['key' => 'siret', 'label' => 'SIRET', 'type' => 'text', 'required' => false],
            ]],
            ['section' => 'Contact', 'fields' => [
                ['key' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
                ['key' => 'phone', 'label' => 'Téléphone', 'type' => 'tel', 'required' => true],
            ]],
            ['section' => 'Projet', 'fields' => [
                ['key' => 'logo', 'label' => 'Logo', 'type' => 'file', 'required' => false],
                ['key' => 'colors', 'label' => 'Couleurs préférées', 'type' => 'textarea', 'required' => false],
            ]]
        ];
        FormConfig::create(['project_id' => $project->id, 'fields' => $defaultFields]);
    }

    return view('admin.config-project', compact('project'));
}

public function saveConfig(Request $request, $id)
{
    $project = Project::findOrFail($id);

    $fields = json_decode($request->fields_json, true);

    if (!is_array($fields)) {
        $fields = [];
    }

    $project->formConfig()->updateOrCreate(
        ['project_id' => $project->id],
        ['fields' => $fields]
    );

    return redirect()->back()->with('success', 'Configuration du formulaire mise à jour !');
}

public function viewProjectData($id)
{
    $project = Project::with('client', 'formConfig')->findOrFail($id);
    return view('admin.view-data', compact('project'));
}

public function login(Request $request)
{
    // MOT DE PASSE EN DUR (Change "votre_secret_ici" par ce que tu veux)
    $hardcodedPassword = 'njiezm2026';

    // Vérification
    if ($request->password === $hardcodedPassword) {
        // On crée la session
        session(['admin_logged_in' => true]);

        // Redirection vers le dashboard
        return redirect()->route('admin.dashboard');
    }

    // Si erreur, on redirige vers la page de login avec un message
    return back()->with('error', 'Mot de passe incorrect. Veuillez réessayer.');
}

public function logout()
{
    // On détruit la session
    session()->forget('admin_logged_in');

    return redirect()->route('admin.login');
}

public function deleteProject($id)
{
    $project = Project::findOrFail($id);
    $project->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Projet supprimé avec succès !');
}

public function showLoginForm()
{
    return view('admin.login');
}
}
