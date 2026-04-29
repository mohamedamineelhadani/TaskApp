<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;

class ProjectsController extends Controller
{

    public function index(Request $request)
    {
        $query = Auth::user()->projects()->withCount('tasks');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $projects = $query->latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:pending,completed,canceled',
        ]);

        Auth::user()->projects()->create([
            'id_user'     => Auth::id(),
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status ?? 'pending',
        ]);

        return redirect()->route('projects.index')
                         ->with('success', 'Project created successfully!');
    }

    public function show(Request $request, Projects $project)
    {
        $this->authorizeProject($project);

        $taskQuery = $project->tasks();

        if ($request->filled('search')) {
            $taskQuery->where('title', 'like', '%' . $request->search . '%');
        }

        $tasks = $taskQuery->latest()->get();

        return view('projects.show', compact('project', 'tasks'));
    }

    public function edit(Projects $project)
    {
        $this->authorizeProject($project);

        return view('projects.edit', compact('project'));
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

        return redirect()->route('projects.show', $project)
                         ->with('success', 'Project updated successfully!');
    }

    public function destroy(Projects $project)
    {
        $this->authorizeProject($project);

        $project->delete();

        return redirect()->route('projects.index')
                         ->with('success', 'Project deleted successfully!');
    }

    public function updateStatus(Request $request, Projects $project)
    {
        $this->authorizeProject($project);

        $request->validate([
            'status' => 'required|in:pending,completed,canceled',
        ]);

        $project->update(['status' => $request->status]);

        return redirect()->back()
                         ->with('success', 'Project status updated successfully!');
    }


    private function authorizeProject(Projects $project)
    {
        if ($project->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    } 
    
}



