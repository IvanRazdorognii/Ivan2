@props(['task'])

<div class="task border p-4 rounded mb-4">
    <h2 class="text-xl font-semibold">{{ $title }}</h2>
    <p>{{ $description }}</p>
    <p><strong>Created:</strong> {{ $created_at }}</p>
    <p><strong>Last update:</strong> {{ $updated_at }}</p>
    <p><strong>Status:</strong> {{ $status ? 'Done' : 'In progress' }}</p>
    <p><strong>Priority:</strong> {{ $priority }}</p>
    <p><strong>Assigned to:</strong> {{ $assignedTo }}</p>

    <div class="mt-4">
        <a href="{{ route('tasks.edit', $id) }}" class="text-blue-500">Edit</a>
        <form action="{{ route('tasks.destroy', $id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500">Delete</button>
        </form>
    </div>
</div>
