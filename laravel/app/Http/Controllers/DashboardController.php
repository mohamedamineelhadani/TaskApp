<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use App\Models\Tasks;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalProjects = $user->projects()->count();
        $completedProjects = $user->projects()->where('status', 'completed')->count();
        $pendingProjects = $user->projects()->where('status', 'pending')->count();
        $canceledProjects = $user->projects()->where('status', 'canceled')->count();

        $totalTasks = Tasks::whereHas('project', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->count();
        
        $completedTasks = Tasks::whereHas('project', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->where('status', 'completed')->count();
        
        $pendingTasks = Tasks::whereHas('project', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })->where('status', 'pending')->count();

        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        $recentProjects = $user->projects()->withCount('tasks')->latest()->take(5)->get();

        $projectsOverview = $user->projects()
            ->withCount(['tasks', 'completedTasks', 'pendingTasks'])
            ->latest()
            ->get();

        return view('dashboard', compact(
            'totalProjects',
            'completedProjects',
            'pendingProjects',
            'canceledProjects',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'completionRate',
            'recentProjects',
            'projectsOverview'
        ));
    }
}
