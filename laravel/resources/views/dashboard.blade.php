@extends('layouts.app')

@section('title', 'Dashboard - TaskApp')

@section('content')
<style>
    /* ============================================================
       DASHBOARD STYLES
       ============================================================ */
    .dashboard {
        max-width: 1200px;
        margin: 0 auto;
        padding: var(--space-xl) var(--space-lg);
    }

    /* --- Welcome Header --- */
    .dashboard-welcome {
        margin-bottom: var(--space-xl);
    }

    .dashboard-welcome h1 {
        font-size: var(--font-size-3xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .dashboard-welcome p {
        color: var(--text-muted);
        font-size: var(--font-size-base);
    }

    .dashboard-welcome strong {
        color: var(--primary);
    }

    /* --- Stats Grid --- */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: var(--space-lg);
        margin-bottom: var(--space-xl);
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-lg);
        display: flex;
        align-items: flex-start;
        gap: var(--space-md);
        transition: var(--transition);
    }

    .stat-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
        border-color: transparent;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--border-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 24px;
        height: 24px;
    }

    .stat-icon.blue {
        background: var(--primary-light);
        color: var(--primary);
    }

    .stat-icon.green {
        background: var(--success-light);
        color: var(--success);
    }

    .stat-icon.amber {
        background: var(--warning-light);
        color: var(--warning);
    }

    .stat-icon.red {
        background: var(--danger-light);
        color: var(--danger);
    }

    .stat-icon.purple {
        background: #ede9fe;
        color: #7c3aed;
    }

    .stat-info {
        flex: 1;
        min-width: 0;
    }

    .stat-value {
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
    }

    .stat-label {
        font-size: var(--font-size-xs);
        color: var(--text-muted);
        margin-top: var(--space-xs);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-sub {
        font-size: var(--font-size-xs);
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* --- Two Column Layout --- */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-lg);
    }

    /* --- Panel --- */
    .dashboard-panel {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        overflow: hidden;
    }

    .dashboard-panel.full-width {
        grid-column: 1 / -1;
    }

    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--space-md) var(--space-lg);
        border-bottom: 1px solid var(--border-color);
        background: var(--body-bg);
    }

    .panel-header h3 {
        font-size: var(--font-size-base);
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .panel-header h3 svg {
        width: 18px;
        height: 18px;
        color: var(--primary);
    }

    .panel-header .view-all {
        font-size: var(--font-size-xs);
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }

    .panel-header .view-all:hover {
        text-decoration: underline;
    }

    .panel-body {
        padding: 0;
    }

    /* --- Recent Projects List --- */
    .project-list-item {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        padding: var(--space-md) var(--space-lg);
        border-bottom: 1px solid var(--border-color);
        transition: var(--transition);
        text-decoration: none;
    }

    .project-list-item:last-child {
        border-bottom: none;
    }

    .project-list-item:hover {
        background: var(--body-bg);
    }

    .project-list-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--border-radius);
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .project-list-icon svg {
        width: 20px;
        height: 20px;
    }

    .project-list-info {
        flex: 1;
        min-width: 0;
    }

    .project-list-name {
        font-weight: 600;
        font-size: var(--font-size-sm);
        color: var(--text-primary);
    }

    .project-list-meta {
        font-size: var(--font-size-xs);
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: var(--space-md);
        margin-top: 2px;
    }

    .project-list-meta span {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .project-list-meta svg {
        width: 12px;
        height: 12px;
    }

    .project-list-badge {
        flex-shrink: 0;
    }

    .badge-sm {
        display: inline-block;
        padding: 3px 10px;
        border-radius: var(--border-radius-pill);
        font-size: var(--font-size-xs);
        font-weight: 600;
    }

    .badge-sm.success {
        background: var(--success-light);
        color: var(--success);
    }

    .badge-sm.pending {
        background: var(--warning-light);
        color: var(--warning);
    }

    .badge-sm.canceled {
        background: var(--canceled-light);
        color: var(--canceled);
    }

    /* --- Overview Table --- */
    .overview-table {
        width: 100%;
        border-collapse: collapse;
    }

    .overview-table th {
        text-align: left;
        padding: var(--space-sm) var(--space-lg);
        font-size: var(--font-size-xs);
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: var(--body-bg);
        border-bottom: 1px solid var(--border-color);
    }

    .overview-table td {
        padding: var(--space-md) var(--space-lg);
        font-size: var(--font-size-sm);
        border-bottom: 1px solid var(--border-color);
        color: var(--text-secondary);
    }

    .overview-table tr:last-child td {
        border-bottom: none;
    }

    .overview-table tr:hover td {
        background: var(--body-bg);
    }

    .overview-table .project-name {
        font-weight: 600;
        color: var(--text-primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .overview-table .project-name:hover {
        color: var(--primary);
    }

    .overview-table .project-name svg {
        width: 16px;
        height: 16px;
        color: var(--text-muted);
    }

    .progress-bar-wrapper {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .progress-bar {
        flex: 1;
        height: 8px;
        background: var(--border-color);
        border-radius: var(--border-radius-pill);
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: var(--success);
        border-radius: var(--border-radius-pill);
        transition: width 0.5s ease;
    }

    .progress-text {
        font-size: var(--font-size-xs);
        font-weight: 600;
        color: var(--text-muted);
        min-width: 36px;
        text-align: right;
    }

    /* --- Quick Actions --- */
    .quick-actions {
        display: flex;
        gap: var(--space-md);
        flex-wrap: wrap;
        margin-bottom: var(--space-xl);
    }

    .quick-action-btn {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-sm) var(--space-lg);
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 500;
        color: var(--text-primary);
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }

    .quick-action-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    .quick-action-btn svg {
        width: 18px;
        height: 18px;
    }

    .quick-action-btn.primary {
        background: var(--primary);
        color: var(--text-white);
        border-color: var(--primary);
    }

    .quick-action-btn.primary:hover {
        background: var(--primary-hover);
    }

    /* --- Empty State --- */
    .empty-row {
        text-align: center;
        padding: var(--space-xl);
        color: var(--text-muted);
    }

    /* --- Responsive --- */
    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-welcome h1 {
            font-size: var(--font-size-2xl);
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: var(--space-md);
        }

        .overview-table {
            font-size: var(--font-size-xs);
        }

        .overview-table th,
        .overview-table td {
            padding: var(--space-sm);
        }
    }
</style>

<div class="dashboard">
    <!-- Welcome -->
    <div class="dashboard-welcome">
        <h1>Welcome back, <strong>{{ Auth::user()->name }}</strong></h1>
        <p>Here's what's happening with your projects today.</p>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="{{ route('projects.create') }}" class="quick-action-btn primary">
            <!-- Plus Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            New Project
        </a>
        <a href="{{ route('projects.index') }}" class="quick-action-btn">
            <!-- Folder Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
            </svg>
            All Projects
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <!-- Total Projects -->
        <div class="stat-card">
            <div class="stat-icon blue">
                <!-- Folder Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalProjects }}</div>
                <div class="stat-label">Total Projects</div>
                <div class="stat-sub">{{ $completedProjects }} completed</div>
            </div>
        </div>

        <!-- Total Tasks -->
        <div class="stat-card">
            <div class="stat-icon green">
                <!-- Check Square Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 11 12 14 22 4"/>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $totalTasks }}</div>
                <div class="stat-label">Total Tasks</div>
                <div class="stat-sub">{{ $completedTasks }} done</div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="stat-card">
            <div class="stat-icon amber">
                <!-- Clock Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $pendingTasks }}</div>
                <div class="stat-label">Pending Tasks</div>
                <div class="stat-sub">Needs attention</div>
            </div>
        </div>

        <!-- Completion Rate -->
        <div class="stat-card">
            <div class="stat-icon purple">
                <!-- Trending Up Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $completionRate }}%</div>
                <div class="stat-label">Completion Rate</div>
                <div class="stat-sub">{{ $completedTasks }}/{{ $totalTasks }} tasks</div>
            </div>
        </div>
    </div>

    <!-- Two Column Grid -->
    <div class="dashboard-grid">
        <!-- Recent Projects -->
        <div class="dashboard-panel">
            <div class="panel-header">
                <h3>
                    <!-- Clock Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    Recent Projects
                </h3>
                <a href="{{ route('projects.index') }}" class="view-all">View all →</a>
            </div>
            <div class="panel-body">
                @if ($recentProjects->isEmpty())
                    <div class="empty-row">
                        <p>No projects yet. <a href="{{ route('projects.create') }}">Create one</a></p>
                    </div>
                @else
                    @foreach ($recentProjects as $project)
                        <a href="{{ route('projects.show', $project) }}" class="project-list-item">
                            <div class="project-list-icon">
                                <!-- Folder Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                                </svg>
                            </div>
                            <div class="project-list-info">
                                <div class="project-list-name">{{ $project->name }}</div>
                                <div class="project-list-meta">
                                    <span>
                                        <!-- List Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="8" y1="6" x2="21" y2="6"/>
                                            <line x1="8" y1="12" x2="21" y2="12"/>
                                            <line x1="8" y1="18" x2="21" y2="18"/>
                                            <line x1="3" y1="6" x2="3.01" y2="6"/>
                                            <line x1="3" y1="12" x2="3.01" y2="12"/>
                                            <line x1="3" y1="18" x2="3.01" y2="18"/>
                                        </svg>
                                        {{ $project->tasks_count }} tasks
                                    </span>
                                    <span>
                                        <!-- Calendar Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                            <line x1="16" y1="2" x2="16" y2="6"/>
                                            <line x1="8" y1="2" x2="8" y2="6"/>
                                            <line x1="3" y1="10" x2="21" y2="10"/>
                                        </svg>
                                        {{ $project->created_at->format('M d') }}
                                    </span>
                                </div>
                            </div>
                            <div class="project-list-badge">
                                @if ($project->isCompleted())
                                    <span class="badge-sm success">Done</span>
                                @elseif ($project->isPending())
                                    <span class="badge-sm pending">Active</span>
                                @else
                                    <span class="badge-sm canceled">Canceled</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Projects Overview -->
        <div class="dashboard-panel">
            <div class="panel-header">
                <h3>
                    <!-- Bar Chart Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                    Projects Overview
                </h3>
            </div>
            <div class="panel-body" style="overflow-x: auto;">
                @if ($projectsOverview->isEmpty())
                    <div class="empty-row">
                        <p>No projects yet.</p>
                    </div>
                @else
                    <table class="overview-table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Progress</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projectsOverview as $project)
                                <tr>
                                    <td>
                                        <a href="{{ route('projects.show', $project) }}" class="project-name">
                                            <!-- Folder Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                                            </svg>
                                            {{ $project->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            $taskTotal = $project->tasks_count;
                                            $taskDone = $project->completed_tasks_count ?? 0;
                                            $progressPercent = $taskTotal > 0 ? round(($taskDone / $taskTotal) * 100) : 0;
                                        @endphp
                                        <div class="progress-bar-wrapper">
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: {{ $progressPercent }}%"></div>
                                            </div>
                                            <span class="progress-text">{{ $progressPercent }}%</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($project->isCompleted())
                                            <span class="badge-sm success">Completed</span>
                                        @elseif ($project->isPending())
                                            <span class="badge-sm pending">Active</span>
                                        @else
                                            <span class="badge-sm canceled">Canceled</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection