<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use App\Models\Tasks;


class TasksController extends Controller
{
    public function store(Request $request, Projects $project)
    {
        $this->authorizeProject($project);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->tasks()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => 'pending',
        ]);

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Task added successfully!');
    }

    public function toggleStatus(Tasks $task)
    {
        $this->authorizeTask($task);

        $task->update([
            'status' => $task->isCompleted() ? 'pending' : 'completed',
        ]);

        return redirect()->back()
                         ->with('success', 'Task status updated!');
    }

    public function completeAll(Projects $project)
    {
        $this->authorizeProject($project);

        $project->tasks()->update(['status' => 'completed']);

        return redirect()->back()
                         ->with('success', 'All tasks marked as completed!');
    }

    public function destroy(Tasks $task)
    {
        $this->authorizeTask($task);

        $project = $task->project;
        $task->delete();

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Task deleted successfully!');
    }

    private function authorizeProject(Projects $project)
    {
        if ($project->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function authorizeTask(Tasks $task)
    {
        if ($task->project->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
