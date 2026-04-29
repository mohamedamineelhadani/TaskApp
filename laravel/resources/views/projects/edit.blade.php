@extends('layouts.app')

@section('title', 'Edit ' . $project->name . ' - TaskApp')

@section('content')
<style>
    .form-page {
        max-width: 640px;
        margin: 0 auto;
        padding: var(--space-xl) var(--space-lg);
    }

    .form-page h1 {
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .form-page .subtitle {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-xl);
    }

    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-xl);
    }

    .form-group {
        margin-bottom: var(--space-lg);
    }

    .form-label {
        display: block;
        font-size: var(--font-size-sm);
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: var(--space-sm) var(--space-md);
        background: var(--input-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: var(--font-size-base);
        font-family: var(--font-main);
        color: var(--text-primary);
        transition: var(--transition);
        outline: none;
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .form-error {
        color: var(--danger);
        font-size: var(--font-size-xs);
        margin-top: var(--space-xs);
    }

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: var(--space-md);
    }

    .btn-submit {
        padding: var(--space-sm) var(--space-xl);
        background: var(--primary);
        color: var(--text-white);
        border: none;
        border-radius: var(--border-radius);
        font-size: var(--font-size-base);
        font-weight: 600;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .btn-submit:hover {
        background: var(--primary-hover);
    }

    .btn-cancel {
        padding: var(--space-sm) var(--space-xl);
        background: transparent;
        color: var(--text-muted);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        font-size: var(--font-size-base);
        font-weight: 500;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-cancel:hover {
        border-color: var(--text-muted);
    }
</style>

<div class="form-page">
    <h1>Edit Project</h1>
    <p class="subtitle">Update the details for <strong>{{ $project->name }}</strong>.</p>

    <div class="form-card">
        <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Project Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    class="form-input"
                    value="{{ old('name', $project->name) }}"
                    placeholder="e.g. Website Redesign"
                    required
                >
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-textarea"
                    placeholder="Describe your project..."
                >{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="pending" {{ old('status', $project->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="canceled" {{ old('status', $project->status) === 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
                @error('status')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('projects.show', $project) }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Update Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection