@extends('layouts.app')

@section('title', 'Task Details')

@section('content')

    <div class="tasks-container">
        <x-task :task="$task" />
    </div>
    <a href="{{ route('tasks.index') }}">Back</a>

@endsection
