<?php

namespace App\Http\Controllers;

use App\Models\Todoinfo;
use Illuminate\Http\Request;

class TodoInfoController extends Controller
{
    // Display the list of tasks
    public function index()
    {
        $todos = Todoinfo::orderBy('created_at', 'desc')->get();
        return view('todo', compact('todos'));  // Ensure 'todo' is the correct view name
    }

    // Show the form for adding a new task
    public function create()
    {
        return view('create');
    }

    // Store the newly added task
    public function todoinfo(Request $request)
    {
        $validatedData = $request->validate([
            'task' => 'required',
        ]);

        TodoInfo::create($validatedData);

        return redirect()->route('todo')->with('success', 'Task added successfully!');
    }

       

    // Update the 'is_done' status (checkbox toggle)
    public function updateStatus($id)
    {
        $todo = Todoinfo::findOrFail($id);
        $todo->is_done = !$todo->is_done;  // Toggle the is_done value
        $todo->save();

        return response()->json(['success' => true]);
    }

    // Show the form for editing an existing task
    public function edit($id)
    {
        $todo = Todoinfo::findOrFail($id);
        return view('edit', compact('todo'));
    }

    // Update an existing task
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'task' => 'required|string|max:255',
        ]);

        $todo = Todoinfo::findOrFail($id);
        $todo->task = $validatedData['task'];
        $todo->save();

        return redirect('/')->with('success', 'Task updated successfully!');
    }

    // Delete a task
    public function destroy($id)
    {
        $todo = Todoinfo::findOrFail($id);
        $todo->delete();

        return redirect('/')->with('success', 'Task deleted successfully!');
    }

    
}
