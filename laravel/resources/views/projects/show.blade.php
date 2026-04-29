@extends('layouts.app')

@section('title', $project->name . ' - TaskApp')

@section('content')
<style>
    .project-show {
        max-width: 1100px;
        margin: 0 auto;
        padding: var(--space-xl) var(--space-lg);
    }

    /* --- Breadcrumb --- */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-lg);
    }

    .breadcrumb a {
        color: var(--text-muted);
        text-decoration: none;
    }

    .breadcrumb a:hover {
        color: var(--primary);
    }

    .breadcrumb svg {
        width: 14px;
        height: 14px;
    }

    /* --- Header --- */
    .project-detail-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
    }

    .project-detail-header .left h1 {
        font-size: var(--font-size-3xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .project-detail-header .left .meta-row {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        flex-wrap: wrap;
        font-size: var(--font-size-sm);
        color: var(--text-muted);
    }

    .project-detail-header .left .meta-item {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .project-detail-header .left svg {
        width: 16px;
        height: 16px;
    }

    .project-detail-header .actions {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .btn-sm {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-sm) var(--space-md);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        border: none;
        font-family: var(--font-main);
    }

    .btn-primary {
        background: var(--primary);
        color: var(--text-white);
    }

    .btn-primary:hover {
        background: var(--primary-hover);
    }

    .btn-outline {
        background: transparent;
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
    }

    .btn-outline:hover {
        border-color: var(--text-secondary);
    }

    .btn-danger {
        background: transparent;
        color: var(--danger);
        border: 1px solid var(--danger);
    }

    .btn-danger:hover {
        background: var(--danger);
        color: var(--text-white);
    }

    .btn-success-sm {
        background: var(--success);
        color: var(--text-white);
        border: none;
    }

    .btn-success-sm:hover {
        background: var(--success-hover);
    }

    .btn-sm svg {
        width: 16px;
        height: 16px;
    }

    /* --- Badges --- */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 12px;
        border-radius: var(--border-radius-pill);
        font-size: var(--font-size-xs);
        font-weight: 600;
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

    /* --- Info Card --- */
    .project-info-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-xl);
        margin-bottom: var(--space-xl);
    }

    .project-description {
        font-size: var(--font-size-base);
        color: var(--text-secondary);
        line-height: 1.7;
    }

    /* --- Tasks Section --- */
    .tasks-section {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-xl);
    }

    .tasks-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: var(--space-md);
        margin-bottom: var(--space-lg);
        padding-bottom: var(--space-md);
        border-bottom: 1px solid var(--border-color);
    }

    .tasks-header h2 {
        font-size: var(--font-size-xl);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .tasks-header .task-count {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        font-weight: 400;
    }

    /* --- Add Task Form --- */
    .add-task-form {
        display: flex;
        align-items: flex-end;
        gap: var(--space-sm);
        margin-bottom: var(--space-lg);
        flex-wrap: wrap;
    }

    .add-task-form .form-group {
        flex: 1;
        min-width: 180px;
    }

    .add-task-form .form-input {
        width: 100%;
        padding: var(--space-sm) var(--space-md);
        background: var(--input-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-family: var(--font-main);
        color: var(--text-primary);
        transition: var(--transition);
        outline: none;
    }

    .add-task-form .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .add-task-form .form-input::placeholder {
        color: var(--text-muted);
    }

    .add-task-form .form-error {
        color: var(--danger);
        font-size: var(--font-size-xs);
        margin-top: 2px;
    }

    .btn-add-task {
        padding: var(--space-sm) var(--space-lg);
        background: var(--success);
        color: var(--text-white);
        border: none;
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        white-space: nowrap;
        height: 42px;
    }

    .btn-add-task:hover {
        background: var(--success-hover);
        box-shadow: var(--shadow-md);
    }

    .btn-add-task svg {
        width: 16px;
        height: 16px;
    }

    /* --- Task List --- */
    .task-list {
        display: flex;
        flex-direction: column;
        gap: var(--space-sm);
    }

    .task-item {
        display: flex;
        align-items: center;
        gap: var(--space-md);
        padding: var(--space-md);
        background: var(--body-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        transition: var(--transition);
    }

    .task-item:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    .task-item.completed-task {
        opacity: 0.7;
    }

    .task-item.completed-task .task-title {
        text-decoration: line-through;
        color: var(--text-muted);
    }

    /* --- Toggle Circle --- */
    .task-toggle {
        background: none;
        border: 2px solid var(--border-color);
        width: 22px;
        height: 22px;
        border-radius: 50%;
        cursor: pointer;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        padding: 0;
    }

    .task-toggle:hover {
        border-color: var(--success);
    }

    .task-toggle.completed {
        background: var(--success);
        border-color: var(--success);
    }

    .task-toggle.completed svg {
        display: block;
        color: var(--text-white);
    }

    .task-toggle svg {
        display: none;
        width: 12px;
        height: 12px;
    }

    .task-toggle.completed svg {
        display: block;
    }

    .task-content {
        flex: 1;
        min-width: 0;
    }

    .task-title {
        font-weight: 500;
        color: var(--text-primary);
        font-size: var(--font-size-sm);
    }

    .task-description {
        font-size: var(--font-size-xs);
        color: var(--text-muted);
        margin-top: 2px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .task-status-badge {
        font-size: var(--font-size-xs);
        padding: 2px 8px;
        border-radius: var(--border-radius-pill);
        font-weight: 600;
        white-space: nowrap;
    }

    .task-status-badge.completed {
        background: var(--success-light);
        color: var(--success);
    }

    .task-status-badge.pending {
        background: var(--warning-light);
        color: var(--warning);
    }

    .task-delete {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--text-muted);
        padding: var(--space-xs);
        border-radius: var(--border-radius-sm);
        transition: var(--transition);
        flex-shrink: 0;
    }

    .task-delete:hover {
        color: var(--danger);
        background: var(--danger-light);
    }

    .task-delete svg {
        width: 16px;
        height: 16px;
    }

    /* --- Empty State --- */
    .empty-tasks {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: var(--space-2xl) var(--space-md);
    }

    .empty-tasks svg {
        width: 56px;
        height: 56px;
        color: var(--text-muted);
        opacity: 0.4;
        margin-bottom: var(--space-md);
    }

    .empty-tasks h4 {
        font-size: var(--font-size-base);
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .empty-tasks p {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
    }

    /* --- Search tasks --- */
    .tasks-search {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .tasks-search .search-input-sm {
        padding: var(--space-sm) var(--space-md);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-family: var(--font-main);
        background: var(--input-bg);
        outline: none;
        transition: var(--transition);
        width: 200px;
    }

    .tasks-search .search-input-sm:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    @media (max-width: 768px) {
        .project-detail-header .left h1 {
            font-size: var(--font-size-2xl);
        }

        .add-task-form {
            flex-direction: column;
            align-items: stretch;
        }

        .add-task-form .form-group {
            min-width: 100%;
        }

        .task-item {
            flex-wrap: wrap;
        }

        .tasks-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="project-show">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('projects.index') }}">Projects</a>
        <!-- Chevron Right -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"/>
        </svg>
        <span>{{ $project->name }}</span>
    </div>

    <!-- Header -->
    <div class="project-detail-header">
        <div class="left">
            <h1>{{ $project->name }}</h1>
            <div class="meta-row">
                @if ($project->isCompleted())
                    <span class="badge badge-success">
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
                <span class="meta-item">
                    <!-- Calendar Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    {{ $project->created_at->format('M d, Y') }}
                </span>
            </div>
        </div>
        <div class="actions">
            <a href="{{ route('projects.edit', $project) }}" class="btn-sm btn-outline">
                <!-- Edit Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit
            </a>
            <form method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('Are you sure you want to delete this project?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">
                    <!-- Trash Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Info Card -->
    <div class="project-info-card">
        <p class="project-description">{{ $project->description ?: 'No description provided.' }}</p>
    </div>

    <!-- Tasks Section -->
    <div class="tasks-section">
        <div class="tasks-header">
            <h2>
                <!-- List Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="8" y1="6" x2="21" y2="6"/>
                    <line x1="8" y1="12" x2="21" y2="12"/>
                    <line x1="8" y1="18" x2="21" y2="18"/>
                    <line x1="3" y1="6" x2="3.01" y2="6"/>
                    <line x1="3" y1="12" x2="3.01" y2="12"/>
                    <line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
                Tasks
                <span class="task-count">({{ $tasks->count() }})</span>
            </h2>
            <div class="tasks-search">
                <form method="GET" action="{{ route('projects.show', $project) }}" style="display:flex; gap: 8px;">
                    <input type="text" name="search" class="search-input-sm" placeholder="Search tasks..." value="{{ request('search') }}">
                    <button type="submit" class="btn-sm btn-outline">Search</button>
                    @if (request('search'))
                        <a href="{{ route('projects.show', $project) }}" class="btn-sm btn-outline">Clear</a>
                    @endif
                </form>
                @if ($tasks->where('status', 'pending')->count() > 0)
                    <form method="POST" action="{{ route('tasks.completeAll', $project) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-sm btn-success-sm">
                            <!-- Check Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 11 12 14 22 4"/>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                            </svg>
                            Complete All
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Add Task Form -->
        <form method="POST" action="{{ route('tasks.store', $project) }}" class="add-task-form">
            @csrf
            <div class="form-group">
                <input
                    type="text"
                    name="title"
                    class="form-input"
                    placeholder="Task title..."
                    value="{{ old('title') }}"
                    required
                >
                @error('title')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input
                    type="text"
                    name="description"
                    class="form-input"
                    placeholder="Description (optional)..."
                    value="{{ old('description') }}"
                >
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn-add-task">
                <!-- Plus Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Add Task
            </button>
        </form>

        <!-- Task List -->
        @if ($tasks->isEmpty())
            <div class="empty-tasks">
                <!-- Clipboard Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                </svg>
                <h4>No tasks yet</h4>
                <p>Add your first task using the form above.</p>
            </div>
        @else
            <div class="task-list">
                @foreach ($tasks as $task)
                    <div class="task-item {{ $task->isCompleted() ? 'completed-task' : '' }}">
                        <!-- Toggle Status -->
                        <form method="POST" action="{{ route('tasks.toggle', $task) }}" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="task-toggle {{ $task->isCompleted() ? 'completed' : '' }}" title="{{ $task->isCompleted() ? 'Mark as pending' : 'Mark as completed' }}">
                                <!-- Check Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </button>
                        </form>

                        <!-- Task Content -->
                        <div class="task-content">
                            <div class="task-title">{{ $task->title }}</div>
                            @if ($task->description)
                                <div class="task-description">{{ $task->description }}</div>
                            @endif
                        </div>

                        <!-- Status Badge -->
                        <span class="task-status-badge {{ $task->isCompleted() ? 'completed' : 'pending' }}">
                            {{ $task->isCompleted() ? 'Done' : 'Pending' }}
                        </span>

                        <!-- Delete -->
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="task-delete" title="Delete task">
                                <!-- X Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection