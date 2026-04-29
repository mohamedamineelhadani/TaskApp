@extends('layouts.guest')

@section('title', 'Confirm Password - TaskApp')

@section('content')
<style>
    /* ============================================================
       CONFIRM PASSWORD PAGE STYLES
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
        background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, transparent 70%);
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
        margin-bottom: var(--space-lg);
    }

    .auth-form-header h1 {
        font-size: var(--font-size-3xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    /* --- Shield Icon --- */
    .shield-icon-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: var(--space-lg);
    }

    .shield-icon-circle {
        width: 72px;
        height: 72px;
        background: var(--warning-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .shield-icon-circle svg {
        width: 36px;
        height: 36px;
        color: var(--warning);
    }

    /* --- Warning Box --- */
    .warning-box {
        background: var(--warning-light);
        color: var(--warning-hover);
        padding: var(--space-md) var(--space-lg);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        line-height: 1.7;
        margin-bottom: var(--space-lg);
        display: flex;
        align-items: flex-start;
        gap: var(--space-sm);
    }

    .warning-box svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* --- Form Styles --- */
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

    /* --- Submit Button --- */
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
            <h2>Secure area</h2>
            <p>Please confirm your password before accessing this sensitive section of the application.</p>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h1>Confirm password</h1>
            </div>

            <!-- Shield Icon -->
            <div class="shield-icon-wrapper">
                <div class="shield-icon-circle">
                    <!-- Shield Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
            </div>

            <!-- Warning Box -->
            <div class="warning-box">
                <!-- Alert Triangle Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <span>This is a secure area of the application. Please confirm your password before continuing.</span>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
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
                    Confirm
                </button>
            </form>
        </div>
    </div>
</div>
@endsection