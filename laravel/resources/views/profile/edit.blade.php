@extends('layouts.app')

@section('title', 'Profile - TaskApp')

@section('content')
<style>
    /* ============================================================
       PROFILE PAGE STYLES
       ============================================================ */
    .profile-page {
        max-width: 800px;
        margin: 0 auto;
        padding: var(--space-xl) var(--space-lg);
    }

    .profile-page h1 {
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .profile-page .subtitle {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-xl);
    }

    /* --- Section Card --- */
    .profile-section {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-xl);
        margin-bottom: var(--space-lg);
    }

    .profile-section-header {
        margin-bottom: var(--space-lg);
        padding-bottom: var(--space-md);
        border-bottom: 1px solid var(--border-color);
    }

    .profile-section-header h2 {
        font-size: var(--font-size-lg);
        font-weight: 600;
        color: var(--text-primary);
    }

    .profile-section-header p {
        font-size: var(--font-size-xs);
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* --- Form Styles --- */
    .form-group {
        margin-bottom: var(--space-md);
    }

    .form-label {
        display: block;
        font-size: var(--font-size-sm);
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .form-input {
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
        max-width: 480px;
    }

    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .form-input:disabled {
        background: var(--body-bg);
        color: var(--text-muted);
        cursor: not-allowed;
    }

    .form-error {
        color: var(--danger);
        font-size: var(--font-size-xs);
        margin-top: var(--space-xs);
    }

    .form-hint {
        font-size: var(--font-size-xs);
        color: var(--text-muted);
        margin-top: var(--space-xs);
    }

    /* --- Buttons --- */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-sm) var(--space-lg);
        background: var(--primary);
        color: var(--text-white);
        border: none;
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        box-shadow: var(--shadow-md);
    }

    .btn-primary svg {
        width: 16px;
        height: 16px;
    }

    .btn-danger {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-sm) var(--space-lg);
        background: var(--danger);
        color: var(--text-white);
        border: none;
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-danger:hover {
        background: var(--danger-hover);
        box-shadow: var(--shadow-md);
    }

    .btn-danger svg {
        width: 16px;
        height: 16px;
    }

    .btn-outline-danger {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-sm) var(--space-lg);
        background: transparent;
        color: var(--danger);
        border: 1px solid var(--danger);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-outline-danger:hover {
        background: var(--danger);
        color: var(--text-white);
    }

    .btn-outline-danger svg {
        width: 16px;
        height: 16px;
    }

    /* --- Success Message --- */
    .status-message {
        background: var(--success-light);
        color: var(--success-hover);
        padding: var(--space-sm) var(--space-md);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 500;
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .status-message svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    /* --- Delete Warning --- */
    .delete-warning {
        background: var(--danger-light);
        color: var(--danger-hover);
        padding: var(--space-md);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        line-height: 1.6;
        margin-bottom: var(--space-md);
        display: flex;
        align-items: flex-start;
        gap: var(--space-sm);
    }

    .delete-warning svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* --- Delete Modal --- */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: var(--space-md);
    }

    .modal-overlay.open {
        display: flex;
    }

    .modal-content {
        background: var(--card-bg);
        border-radius: var(--border-radius-lg);
        padding: var(--space-xl);
        max-width: 440px;
        width: 100%;
        box-shadow: var(--shadow-lg);
    }

    .modal-content h3 {
        font-size: var(--font-size-lg);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .modal-content p {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-lg);
        line-height: 1.6;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: var(--space-md);
    }

    @media (max-width: 768px) {
        .profile-page {
            padding: var(--space-md);
        }

        .form-input {
            max-width: 100%;
        }
    }
</style>

<div class="profile-page">
    <h1>Profile Settings</h1>
    <p class="subtitle">Manage your account information and security preferences.</p>

    <!-- ============================================================
         SECTION 1: Update Profile Information
         ============================================================ -->
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Profile Information</h2>
            <p>Update your account's profile information and email address.</p>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="status-message">
                <!-- Check Circle Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                Profile updated successfully.
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    class="form-input"
                    value="{{ old('name', Auth::user()->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                >
                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-input"
                    value="{{ old('email', Auth::user()->email) }}"
                    required
                    autocomplete="username"
                >
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror

                @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                    <p class="form-hint" style="color: var(--warning);">
                        Your email address is unverified.
                        <button type="submit" form="resend-verification" class="btn-link" style="background:none;border:none;color:var(--primary);cursor:pointer;font-size:var(--font-size-xs);text-decoration:underline;padding:0;">
                            Click here to re-send the verification email.
                        </button>
                    </p>
                @endif
            </div>

            <button type="submit" class="btn-primary">
                <!-- Save Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Save
            </button>
        </form>
    </div>

    <!-- Resend Verification Email (hidden form) -->
    @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
        <form id="resend-verification" method="POST" action="{{ route('verification.send') }}" style="display:none;">
            @csrf
        </form>
    @endif

    <!-- ============================================================
         SECTION 2: Update Password
         ============================================================ -->
    <div class="profile-section">
        <div class="profile-section-header">
            <h2>Update Password</h2>
            <p>Ensure your account is using a long, random password to stay secure.</p>
        </div>

        @if (session('status') === 'password-updated')
            <div class="status-message">
                <!-- Check Circle Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                Password updated successfully.
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div class="form-group">
                <label for="current_password" class="form-label">Current Password</label>
                <input
                    id="current_password"
                    type="password"
                    name="current_password"
                    class="form-input"
                    autocomplete="current-password"
                    required
                >
                @error('current_password', 'updatePassword')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-input"
                    autocomplete="new-password"
                    required
                >
                @error('password', 'updatePassword')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-input"
                    autocomplete="new-password"
                    required
                >
                @error('password_confirmation', 'updatePassword')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary">
                <!-- Lock Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                Update Password
            </button>
        </form>
    </div>

    <!-- ============================================================
         SECTION 3: Delete Account
         ============================================================ -->
    <div class="profile-section" style="border-color: var(--danger);">
        <div class="profile-section-header" style="border-color: var(--danger-light);">
            <h2 style="color: var(--danger);">Delete Account</h2>
            <p>Permanently delete your account and all associated data.</p>
        </div>

        <div class="delete-warning">
            <!-- Alert Triangle Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
            <span>
                <strong>Warning:</strong> Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </span>
        </div>

        <button type="button" class="btn-outline-danger" onclick="document.getElementById('delete-modal').classList.add('open')">
            <!-- Trash Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
            </svg>
            Delete Account
        </button>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="modal-overlay">
        <div class="modal-content">
            <h3>Are you sure?</h3>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.</p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label for="delete_password" class="form-label">Password</label>
                    <input
                        id="delete_password"
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="Enter your password"
                        style="max-width:100%;"
                        required
                    >
                    @error('password', 'userDeletion')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-outline-danger" onclick="document.getElementById('delete-modal').classList.remove('open')">
                        Cancel
                    </button>
                    <button type="submit" class="btn-danger">
                        <!-- Trash Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection