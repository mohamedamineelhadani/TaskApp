<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $query = Auth::user()->projects()->withCount('tasks');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $projects = $query->latest()->get();

        return response()->json($projects);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,completed,canceled',
        ]);

        $project = Auth::user()->projects()->create([
            'id_user'     => Auth::id(),
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status ?? 'pending',
        ]);

        return response()->json([
            'message' => 'Project created successfully!',
            'project' => $project->loadCount('tasks'),
        ], 201);
    }


    public function show(Request $request, Projects $project)
    {
        $this->authorizeProject($project);

        $taskQuery = $project->tasks();

        if ($request->filled('search')) {
            $taskQuery->where('title', 'like', '%' . $request->search . '%');
        }

        $tasks = $taskQuery->latest()->get();

        return response()->json([
            'project' => $project,
            'tasks'   => $tasks,
        ]);
    }

    public function update(Request $request, Projects $project)
    {
        $this->authorizeProject($project);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,completed,canceled',
        ]);

        $project->update([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return response()->json([
            'message' => 'Project updated successfully!',
            'project' => $project->loadCount('tasks'),
        ]);
    }


    public function destroy(Projects $project)
    {
        $this->authorizeProject($project);

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully!',
        ]);
    }


    public function updateStatus(Request $request, Projects $project)
    {
        $this->authorizeProject($project);

        $request->validate([
            'status' => 'required|in:pending,completed,canceled',
        ]);

        $project->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Project status updated successfully!',
            'project' => $project->loadCount('tasks'),
        ]);
    }


    private function authorizeProject(Projects $project)
    {
        if ($project->id_user !== Auth::id()) {
            abort(response()->json([
                'message' => 'Unauthorized action.',
            ], 403));
        }
    }
}