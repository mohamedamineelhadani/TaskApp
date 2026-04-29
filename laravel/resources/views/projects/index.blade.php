@extends('layouts.app')

@section('title', 'My Projects - TaskApp')

@section('content')
<style>
    /* ============================================================
       PROJECTS INDEX STYLES
       ============================================================ */
    .projects-page {
        max-width: 1200px;
        margin: 0 auto;
        padding: var(--space-xl) var(--space-lg);
    }

    /* --- Header --- */
    .projects-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: var(--space-md);
        margin-bottom: var(--space-xl);
    }

    .projects-header h1 {
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .projects-header h1 svg {
        width: 28px;
        height: 28px;
        color: var(--primary);
    }

    .btn-create {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        background: var(--primary);
        color: var(--text-white);
        border: none;
        padding: var(--space-sm) var(--space-lg);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-create:hover {
        background: var(--primary-hover);
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
    }

    .btn-create svg {
        width: 18px;
        height: 18px;
    }

    /* --- Toolbar --- */
    .projects-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .search-form {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input-wrapper svg {
        position: absolute;
        left: var(--space-sm);
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: var(--text-muted);
        pointer-events: none;
    }

    .search-input {
        padding: var(--space-sm) var(--space-md) var(--space-sm) 36px;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-family: var(--font-main);
        color: var(--text-primary);
        background: var(--input-bg);
        outline: none;
        transition: var(--transition);
        width: 260px;
    }

    .search-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .search-input::placeholder {
        color: var(--text-muted);
    }

    .btn-search {
        padding: var(--space-sm) var(--space-md);
        background: var(--primary);
        color: var(--text-white);
        border: none;
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 500;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-search:hover {
        background: var(--primary-hover);
    }

    .btn-clear {
        padding: var(--space-sm) var(--space-md);
        background: transparent;
        color: var(--text-muted);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 500;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-clear:hover {
        border-color: var(--text-muted);
        color: var(--text-primary);
    }

    .projects-count {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
    }

    .projects-count strong {
        color: var(--text-primary);
    }

    /* --- Grid --- */
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: var(--space-lg);
    }

    /* --- Card --- */
    .project-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-lg);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }

    .project-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
        border-color: transparent;
    }

    .project-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: var(--space-sm);
        margin-bottom: var(--space-sm);
    }

    .project-card-header h3 {
        font-size: var(--font-size-lg);
        font-weight: 600;
        color: var(--text-primary);
        flex: 1;
    }

    .project-card-header h3 a {
        color: var(--text-primary);
        text-decoration: none;
    }

    .project-card-header h3 a:hover {
        color: var(--primary);
    }

    .project-card p {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        line-height: 1.6;
        flex: 1;
        margin-bottom: var(--space-md);
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* --- Badges --- */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: 2px var(--space-sm);
        border-radius: var(--border-radius-pill);
        font-size: var(--font-size-xs);
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-success {
        background: var(--success-light);
        color: var(--success);
    }

    .badge-pending {
        background: var(--warning-light);
        color: var(--warning);
    }

    .badge-canceled {
        background: var(--canceled-light);
        color: var(--canceled);
    }

    /* --- Card Footer --- */
    .project-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: var(--space-md);
        border-top: 1px solid var(--border-color);
    }

    .project-stats {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        font-size: var(--font-size-xs);
        color: var(--text-muted);
    }

    .project-stats .stat {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .project-stats .stat svg {
        width: 14px;
        height: 14px;
    }

    .project-stats .stat.tasks {
        color: var(--text-secondary);
    }

    .project-stats .stat.completed {
        color: var(--success);
    }

    .project-card-actions {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .btn-icon {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--border-radius);
        border: none;
        cursor: pointer;
        transition: var(--transition);
        background: transparent;
        color: var(--text-muted);
        text-decoration: none;
    }

    .btn-icon:hover {
        background: var(--body-bg);
        color: var(--primary);
    }

    .btn-icon.danger:hover {
        background: var(--danger-light);
        color: var(--danger);
    }

    .btn-icon svg {
        width: 16px;
        height: 16px;
    }

    /* --- Status Dropdown --- */
    .status-select {
        padding: var(--space-xs) var(--space-sm);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: var(--font-size-xs);
        font-family: var(--font-main);
        font-weight: 600;
        background: var(--input-bg);
        color: var(--text-primary);
        cursor: pointer;
        outline: none;
        transition: var(--transition);
    }

    .status-select:focus {
        border-color: var(--primary);
    }

    /* --- Empty State --- */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: var(--space-2xl);
        grid-column: 1 / -1;
    }

    .empty-state svg {
        width: 72px;
        height: 72px;
        color: var(--text-muted);
        margin-bottom: var(--space-md);
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: var(--font-size-lg);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .empty-state p {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-lg);
    }

    @media (max-width: 768px) {
        .projects-grid {
            grid-template-columns: 1fr;
        }

        .projects-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-form {
            flex-direction: column;
        }

        .search-input {
            width: 100%;
        }
    }
</style>

<div class="projects-page">
    <!-- Header -->
    <div class="projects-header">
        <h1>
            <!-- Folder Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
            </svg>
            My Projects
        </h1>
        <a href="{{ route('projects.create') }}" class="btn-create">
            <!-- Plus Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            New Project
        </a>
    </div>

    <!-- Toolbar -->
    <div class="projects-toolbar">
        <form method="GET" action="{{ route('projects.index') }}" class="search-form">
            <div class="search-input-wrapper">
                <!-- Search Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    class="search-input"
                    placeholder="Search projects..."
                    value="{{ request('search') }}"
                >
            </div>
            <button type="submit" class="btn-search">Search</button>
            @if (request('search'))
                <a href="{{ route('projects.index') }}" class="btn-clear">Clear</a>
            @endif
        </form>
        <span class="projects-count">
            <strong>{{ $projects->count() }}</strong> project{{ $projects->count() !== 1 ? 's' : '' }}
        </span>
    </div>

    <!-- Projects Grid -->
    @if ($projects->isEmpty())
        <div class="projects-grid">
            <div class="empty-state">
                <!-- Folder Open Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                </svg>
                <h3>No projects yet</h3>
                <p>Create your first project and start organizing your tasks.</p>
                <a href="{{ route('projects.create') }}" class="btn-create">Create Project</a>
            </div>
        </div>
    @else
        <div class="projects-grid">
            @foreach ($projects as $project)
                <div class="project-card">
                    <!-- Header -->
                    <div class="project-card-header">
                        <h3>
                            <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                        </h3>
                        @if ($project->isCompleted())
                            <span class="badge badge-success">
                                <!-- Check Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                Completed
                            </span>
                        @elseif ($project->isPending())
                            <span class="badge badge-pending">Pending</span>
                        @else
                            <span class="badge badge-canceled">Canceled</span>
                        @endif
                    </div>

                    <!-- Description -->
                    <p>{{ $project->description ?: 'No description provided.' }}</p>

                    <!-- Footer -->
                    <div class="project-card-footer">
                        <div class="project-stats">
                            <span class="stat tasks">
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
                        </div>
                        <div class="project-card-actions">
                            <!-- Edit -->
                            <a href="{{ route('projects.edit', $project) }}" class="btn-icon" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                            </a>
                            <!-- Delete -->
                            <form method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('Are you sure you want to delete this project?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon danger" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection