<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index() {
    return view('tasks', ['tasks' => Task::get(['TaskID', 'Title', 'Description', 'IsCompleted'])]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    $VALIDATED = $request->validate([
      'Title' => 'required|max:255',
      'Description' => 'required'
    ]);

    Task::create($VALIDATED);
    return back()->with('success', 'Task created successfully.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Task $task) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Task $task) {
    return view('edit', compact('task'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Task $task) {
    $validated = $request->validate([
      'Title' => 'required|max:255',
      'Description' => 'required',
    ]);

    $task->update($validated);
    return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
  }

  public function complete(Task $task) {
    $task->update(['IsCompleted' => request()->has('IsCompleted') ? 1 : 0]);
    return redirect()->route('tasks.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
  }
}
