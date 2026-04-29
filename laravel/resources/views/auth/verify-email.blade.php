@extends('layouts.guest')

@section('title', 'Verify Email - TaskApp')

@section('content')
<style>
    /* ============================================================
       VERIFY EMAIL PAGE STYLES
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
        max-width: 460px;
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

    /* --- Mail Icon --- */
    .mail-icon-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: var(--space-lg);
    }

    .mail-icon-circle {
        width: 72px;
        height: 72px;
        background: var(--primary-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mail-icon-circle svg {
        width: 36px;
        height: 36px;
        color: var(--primary);
    }

    /* --- Info Box --- */
    .info-box {
        background: var(--primary-light);
        color: var(--primary-hover);
        padding: var(--space-md) var(--space-lg);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        line-height: 1.7;
        margin-bottom: var(--space-lg);
        display: flex;
        align-items: flex-start;
        gap: var(--space-sm);
    }

    .info-box svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* --- Success Status --- */
    .status-success {
        background: var(--success-light);
        color: var(--success);
        padding: var(--space-sm) var(--space-md);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 500;
        margin-bottom: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .status-success svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    /* --- Actions --- */
    .verify-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--space-md);
        flex-wrap: wrap;
    }

    .btn-primary {
        padding: var(--space-sm) var(--space-xl);
        background: var(--primary);
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
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
    }

    .btn-primary svg {
        width: 16px;
        height: 16px;
    }

    .btn-logout {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: var(--font-size-sm);
        font-weight: 500;
        font-family: var(--font-main);
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-xs) 0;
    }

    .btn-logout:hover {
        color: var(--danger);
    }

    .btn-logout svg {
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

        .verify-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-logout {
            text-align: center;
            justify-content: center;
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
            <h2>One more step!</h2>
            <p>Verify your email to unlock all features and start managing your projects.</p>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h1>Verify your email</h1>
            </div>

            <!-- Mail Icon -->
            <div class="mail-icon-wrapper">
                <div class="mail-icon-circle">
                    <!-- Mail Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <!-- Info Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="12"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
                <span>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</span>
            </div>

            <!-- Success Status -->
            @if (session('status') == 'verification-link-sent')
                <div class="status-success">
                    <!-- Check Circle Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif

            <!-- Actions -->
            <div class="verify-actions">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-primary">
                        <!-- Send Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                        Resend Verification Email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <!-- Log Out Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection