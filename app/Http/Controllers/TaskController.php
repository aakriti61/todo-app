<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->with('categories')->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $categories = auth()->user()->categories;
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $task = auth()->user()->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
        ]);

        $task->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    public function edit(string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $categories = auth()->user()->categories;
        $selectedCategoryIds = $task->categories->pluck('id')->toArray();

        return view('tasks.edit', compact('task', 'categories', 'selectedCategoryIds'));
    }

    public function update(Request $request, string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
        ]);

        $task->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function toggleComplete(string $id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->update(['completed' => !$task->completed]);

        return redirect()->route('tasks.index')->with('success', 'Task status updated!');
    }
}