@extends('layouts.guest')

@section('title', 'Reset Password - TaskApp')

@section('content')
<style>
    /* ============================================================
       RESET PASSWORD PAGE STYLES
       ============================================================ */
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
    }

    .auth-panel {
        flex: 1;
        background: var(--navbar-bg);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: var(--space-2xl);
        position: relative;
        overflow: hidden;
        display: none;
    }

    .auth-panel::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -30%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .auth-panel::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: -20%;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(22, 163, 74, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .auth-panel-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 400px;
    }

    .auth-panel .panel-logo {
        display: inline-flex;
        align-items: center;
        gap: var(--space-sm);
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--navbar-text);
        margin-bottom: var(--space-lg);
    }

    .auth-panel .panel-logo svg {
        width: 36px;
        height: 36px;
        color: var(--primary);
    }

    .auth-panel h2 {
        font-size: var(--font-size-2xl);
        color: var(--navbar-text);
        margin-bottom: var(--space-md);
        font-weight: 700;
    }

    .auth-panel p {
        color: var(--navbar-link);
        font-size: var(--font-size-sm);
        line-height: 1.7;
    }

    .auth-form-panel {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: var(--space-2xl);
        background: var(--body-bg);
    }

    .auth-form-container {
        width: 100%;
        max-width: 420px;
    }

    .auth-form-header {
        margin-bottom: var(--space-xl);
    }

    .auth-form-header h1 {
        font-size: var(--font-size-3xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .auth-form-header p {
        color: var(--text-muted);
        font-size: var(--font-size-sm);
    }

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
    }

    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .form-input::placeholder {
        color: var(--text-muted);
    }

    .form-error {
        color: var(--danger);
        font-size: var(--font-size-xs);
        margin-top: var(--space-xs);
    }

    .btn-submit {
        width: 100%;
        padding: var(--space-md);
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
        justify-content: center;
        gap: var(--space-sm);
        margin-top: var(--space-lg);
    }

    .btn-submit:hover {
        background: var(--primary-hover);
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
    }

    .btn-submit svg {
        width: 18px;
        height: 18px;
    }

    @media (min-width: 768px) {
        .auth-panel {
            display: flex;
        }
    }

    @media (max-width: 767px) {
        .auth-form-panel {
            padding: var(--space-xl) var(--space-md);
        }

        .auth-form-header h1 {
            font-size: var(--font-size-2xl);
        }
    }
</style>

<div class="auth-wrapper">
    <!-- Left Branding Panel -->
    <div class="auth-panel">
        <div class="auth-panel-content">
            <div class="panel-logo">
                <!-- Clipboard Check Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                    <polyline points="9 14 11 16 15 12"/>
                </svg>
                TaskApp
            </div>
            <h2>Almost there!</h2>
            <p>Choose a new password and you'll be back to managing your projects in no time.</p>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h1>Reset password</h1>
                <p>Enter your new password below.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        class="form-input"
                        placeholder="you@example.com"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="Enter new password"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
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
                        placeholder="Re-enter new password"
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <!-- Lock Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection