@extends('layouts.app')

@section('title', 'Tasks List')

@section('content')

    <div class="tasks-container">
        <h2>List of tasks:</h2>
        <ul>
            @foreach ($tasks as $task)
                <li>
                    <a href="{{ route('tasks.show', $task['id']) }}">{{ $task['title'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
