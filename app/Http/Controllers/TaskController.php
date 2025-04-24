<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Afficher toutes les tâches
    public function index()
    {
        $tasks = Task::all();  // Récupérer toutes les tâches
        return view('tasks.index', compact('tasks'));  // Passer les tâches à la vue
    }

    // Créer une nouvelle tâche
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Task::create([
            'name' => $request->name,
        ]);

        return redirect()->route('tasks.index');  // Rediriger vers la page des tâches
    }

    // Supprimer une tâche
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();  // Supprimer la tâche
        return redirect()->route('tasks.index');  // Rediriger vers la page des tâches
    }

    public function toggleCompleted($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = !$task->completed;  // Inverse l'état actuel (si true, devient false, et vice versa)
        $task->save();

        return redirect()->route('tasks.index');
    }
}
