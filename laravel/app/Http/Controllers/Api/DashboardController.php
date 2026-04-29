<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $recentProjects = $user->projects()
            ->withCount('tasks')
            ->latest()
            ->take(5)
            ->get();

        $projectsOverview = $user->projects()
            ->withCount(['tasks', 'completedTasks', 'pendingTasks'])
            ->latest()
            ->get();

        return response()->json([
            'stats' => [
                'total_projects' => $totalProjects,
                'completed_projects' => $completedProjects,
                'pending_projects' => $pendingProjects,
                'canceled_projects' => $canceledProjects,
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks,
                'pending_tasks' => $pendingTasks,
                'completion_rate' => $completionRate,
            ],
            'recent_projects' => $recentProjects,
            'projects_overview' => $projectsOverview,
        ]);
    }
}