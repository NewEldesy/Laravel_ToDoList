<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        .completed {
            text-decoration: line-through;
            color: grey;
        }
    </style>
</head>
<body>
    <h1>To-Do List</h1>

    <!-- Formulaire pour ajouter une tâche -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nouvelle tâche" required>
        <button type="submit">Ajouter</button>
    </form>

    <ul>
        @foreach ($tasks as $task)
            <li>
                <span class="{{ $task->completed ? 'completed' : '' }}">
                    {{ $task->name }}
                </span>

                <!-- Bouton pour marquer comme complété/non complété -->
                <form action="{{ route('tasks.toggleCompleted', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">
                        {{ $task->completed ? 'Marquer comme non complétée' : 'Marquer comme complétée' }}
                    </button>
                </form>

                <!-- Bouton pour supprimer une tâche -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>