<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

    // Método para obtener todos los proyectos
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    // Método para obtener un proyecto específico
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    // Método para actualizar un proyecto
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json($project);
    }

    // Método para eliminar un proyecto
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(null, 204);
    }
}
