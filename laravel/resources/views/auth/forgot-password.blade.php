@extends('layouts.guest')

@section('title', 'Forgot Password - TaskApp')

@section('content')
<style>
    /* ============================================================
       FORGOT PASSWORD PAGE STYLES
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

    .auth-form-header a {
        color: var(--primary);
        font-weight: 600;
    }

    .auth-form-header a:hover {
        text-decoration: underline;
    }

    .auth-description {
        background: var(--warning-light);
        color: var(--warning-hover);
        padding: var(--space-md);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        line-height: 1.6;
        margin-bottom: var(--space-lg);
        display: flex;
        align-items: flex-start;
        gap: var(--space-sm);
    }

    .auth-description svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        margin-top: 1px;
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

    .session-status {
        background: var(--success-light);
        color: var(--success);
        padding: var(--space-sm) var(--space-md);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 500;
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .session-status svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
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

    .back-link {
        text-align: center;
        margin-top: var(--space-md);
    }

    .back-link a {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .back-link a:hover {
        color: var(--primary);
    }

    .back-link svg {
        width: 16px;
        height: 16px;
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
            <h2>No worries!</h2>
            <p>We'll send you a link to reset your password. Just enter the email you signed up with.</p>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h1>Forgot password?</h1>
            </div>

            <!-- Description -->
            <div class="auth-description">
                <!-- Info Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="12"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
                <span>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</span>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">
                    <!-- Check Circle Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-input"
                        placeholder="you@example.com"
                        required
                        autofocus
                    >
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <!-- Mail Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    Email Password Reset Link
                </button>
            </form>

            <!-- Back to Login -->
            <div class="back-link">
                <a href="{{ route('login') }}">
                    <!-- Arrow Left Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"/>
                        <polyline points="12 19 5 12 12 5"/>
                    </svg>
                    Back to log in
                </a>
            </div>
        </div>
    </div>
</div>
@endsection