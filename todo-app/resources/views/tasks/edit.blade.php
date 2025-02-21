@extends('layouts.app')

@section('content')

    <h1>Edit task</h1>

    <form action="{{ route('tasks.update', $task['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ $task['title'] }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ $task['description'] }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save changes</button>
    </form>
    
@endsection
