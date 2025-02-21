<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = [
            ['id' => 1, 'title' => 'Lab 2', 'description' => 'Description for Task 1', 'created_at' => '2024-20-09', 'updated_at' => '2024-17-10', 'status' => false, 'priority' => 'High', 'assignment' => 'Andrei Macarinschi'],
            ['id' => 2, 'title' => 'Task 2', 'description' => 'Description for Task 2', 'created_at' => '2024-01-03', 'updated_at' => '2024-01-04', 'status' => true, 'priority' => 'Medium', 'assignment' => 'User 2'],
            ['id' => 3, 'title' => 'Task 3', 'description' => 'Description for Task 3', 'created_at' => '2024-01-05', 'updated_at' => '2024-01-06', 'status' => false, 'priority' => 'Low', 'assignment' => 'User 3'],
        ];

        return view('tasks.index', ['tasks' => $tasks]);
    }


    public function create()
    {
        return view('tasks.create');
    }

    public function store()
    {
    
    }

    public function show($id)
    {
        $task = [
            'id' => $id,
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => now()->subDays(3)->format('Y-m-d'),
            'updated_at' => now()->format('Y-m-d'),
            'status' => false,
            'priority' => 'Medium',
            'assignedTo' => 'Andrei Macarinschi',
        ];

        return view('tasks.show', ['task' => $task]);
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }
}
