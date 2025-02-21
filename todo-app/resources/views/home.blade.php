@extends('layouts.app')

@section('title', 'Home')

@section('header', 'To-Do App')

@section('content')

    <div class="home-container">
        <h1>Hello</h1>
        <p>Welcome to To-Do App. Manage yuor tasks quickly and easily.</p>
        <ul>
            <li><a href="{{ route('tasks.index') }}">List of tasks</a></li>
            <li><a href="{{ route('tasks.create') }}">Create a task</a></li>
        </ul>
        <p>To-Do App helps you to optimise your time managment.</p>
    </div>
@endsection