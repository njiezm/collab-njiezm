<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class OnboardingController extends Controller
{
    public function showForm($token)
    {
        $project = Project::where('token', $token)->firstOrFail();

        $dbData = $project->data;
        if (is_string($dbData)) {
            $dbData = json_decode($dbData, true);
        }
        if (!is_array($dbData)) {
            $dbData = [];
        }

        $formData = $dbData['form_data'] ?? [];
        $uploadedFiles = $dbData['uploaded_files'] ?? [];

        return view('onboarding.form', [
            'token' => $token,
            'project' => $project,
            'formData' => $formData,
            'uploadedFiles' => $uploadedFiles,
        ]);
    }

    public function submitForm(Request $request, $token)
    {
        $project = Project::where('token', $token)->firstOrFail();

        $newFormData = $request->input('form_data', []);
        if (!is_array($newFormData)) {
            $newFormData = [];
        }

        $newFilePaths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key => $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('projects/' . $project->client_id, 'public');
                    $newFilePaths[$key] = $path;
                }
            }
        }

        $existingDbData = $project->data;
        if (is_string($existingDbData)) {
            $existingDbData = json_decode($existingDbData, true);
        }
        if (!is_array($existingDbData)) {
            $existingDbData = [];
        }

        $oldFormData = $existingDbData['form_data'] ?? [];
        $oldFiles = $existingDbData['uploaded_files'] ?? [];

        $finalFormData = array_merge($oldFormData, $newFormData);
        $finalFiles = !empty($newFilePaths) ? array_merge($oldFiles, $newFilePaths) : $oldFiles;

        $project->update([
            'data' => [
                'form_data' => $finalFormData,
                'uploaded_files' => $finalFiles,
            ],
            'status' => 'filled',
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Informations enregistrees avec succes !',
                'updated_at' => optional($project->fresh()->updated_at)->toDateTimeString(),
            ]);
        }

        return redirect()->back()->with('success', 'Informations enregistrees avec succes !');
    }
}
