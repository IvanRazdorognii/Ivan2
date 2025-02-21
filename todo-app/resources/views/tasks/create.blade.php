@extends('layouts.app')

@section('content')
    <h1>Create new task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title::</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
