<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Método para crear una nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed'   => 'boolean',
            'project_id'  => 'required|exists:projects,id',
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    // Método para obtener todas las tareas
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    // Método para obtener una tarea específica
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    // Método para actualizar una tarea
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed'   => 'boolean',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json($task);
    }

    // Método para eliminar una tarea
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
