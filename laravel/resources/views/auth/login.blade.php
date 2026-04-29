@extends('layouts.guest')

@section('title', 'Log in - TaskApp')

@section('content')
<style>
    /* ============================================================
       LOGIN PAGE STYLES
       ============================================================ */
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
    }

    /* --- Left Branding Panel --- */
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

    .auth-panel .panel-features {
        margin-top: var(--space-xl);
        display: flex;
        flex-direction: column;
        gap: var(--space-md);
    }

    .auth-panel .panel-feature {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        color: var(--navbar-link);
        font-size: var(--font-size-sm);
    }

    .auth-panel .panel-feature svg {
        width: 18px;
        height: 18px;
        color: var(--success);
        flex-shrink: 0;
    }

    /* --- Right Form Panel --- */
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

    .auth-form-header a {
        color: var(--primary);
        font-weight: 600;
    }

    .auth-form-header a:hover {
        text-decoration: underline;
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

    /* --- Remember & Forgot Row --- */
    .form-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: var(--space-lg);
    }

    .remember-me {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        cursor: pointer;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
        cursor: pointer;
        border-radius: var(--border-radius-sm);
    }

    .remember-me span {
        font-size: var(--font-size-sm);
        color: var(--text-secondary);
        user-select: none;
    }

    .forgot-link {
        font-size: var(--font-size-sm);
        color: var(--primary);
        font-weight: 500;
    }

    .forgot-link:hover {
        text-decoration: underline;
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

    /* --- Session Status --- */
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

    /* --- Responsive --- */
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
            <h2>Welcome back!</h2>
            <p>Log in to manage your projects and stay on top of your tasks.</p>
            <div class="panel-features">
                <div class="panel-feature">
                    <!-- Check Circle Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Manage your projects
                </div>
                <div class="panel-feature">
                    <!-- Check Circle Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Track task progress
                </div>
                <div class="panel-feature">
                    <!-- Check Circle Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Secure & private
                </div>
            </div>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h1>Log in</h1>
                <p>
                    Don't have an account?
                    <a href="{{ route('register') }}">Sign up</a>
                </p>
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

            <form method="POST" action="{{ route('login') }}">
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
                        autocomplete="username"
                    >
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

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

                <!-- Remember Me & Forgot Password -->
                <div class="form-row">
                    <label for="remember_me" class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <!-- Log In Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                    Log in
                </button>
            </form>
        </div>
    </div>
</div>
@endsection