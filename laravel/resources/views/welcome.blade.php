@extends('layouts.guest')

@section('title', 'Welcome - TaskApp')

@section('content')
<style>
    /* ============================================================
       WELCOME PAGE STYLES
       ============================================================ */
    .welcome-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* --- NAV --- */
    .welcome-nav {
        background: var(--navbar-bg);
        border-bottom: 1px solid var(--navbar-border);
        padding: 0 var(--space-lg);
        position: sticky;
        top: 0;
        z-index: 100;
        backdrop-filter: blur(10px);
    }

    .welcome-nav .nav-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 64px;
    }

    .welcome-nav .logo {
        font-size: var(--font-size-xl);
        font-weight: 700;
        color: var(--navbar-text);
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .welcome-nav .logo svg {
        width: 28px;
        height: 28px;
        color: var(--primary);
    }

    .welcome-nav .nav-links {
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .btn-nav-login {
        background: transparent;
        color: var(--navbar-link-hover);
        border: 1px solid var(--navbar-link);
        padding: var(--space-sm) var(--space-lg);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .btn-nav-login:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: var(--navbar-link-hover);
    }

    .btn-nav-register {
        background: var(--primary);
        color: var(--text-white);
        border: none;
        padding: var(--space-sm) var(--space-lg);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .btn-nav-register:hover {
        background: var(--primary-hover);
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
    }

    /* --- HERO --- */
    .hero {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: var(--space-2xl) var(--space-lg);
        position: relative;
        overflow: hidden;
        min-height: 85vh;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, var(--primary-light) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, var(--success-light) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .hero-content {
        max-width: 720px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        background: var(--primary-light);
        color: var(--primary);
        font-size: var(--font-size-xs);
        font-weight: 600;
        padding: var(--space-xs) var(--space-md);
        border-radius: var(--border-radius-pill);
        margin-bottom: var(--space-lg);
    }

    .hero-badge .dot {
        width: 8px;
        height: 8px;
        background: var(--success);
        border-radius: 50%;
        animation: pulse-dot 2s infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.3); }
    }

    .hero h1 {
        font-size: var(--font-size-4xl);
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1.2;
        margin-bottom: var(--space-md);
        letter-spacing: -0.5px;
    }

    .hero h1 span {
        color: var(--primary);
        position: relative;
    }

    .hero h1 span::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 0;
        width: 100%;
        height: 8px;
        background: var(--primary-light);
        border-radius: var(--border-radius-pill);
        z-index: -1;
        opacity: 0.6;
    }

    .hero p {
        font-size: var(--font-size-lg);
        color: var(--text-secondary);
        margin-bottom: var(--space-xl);
        max-width: 550px;
        margin-inline: auto;
        line-height: 1.7;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-md);
        flex-wrap: wrap;
    }

    .btn-primary-lg {
        background: var(--primary);
        color: var(--text-white);
        border: none;
        padding: var(--space-md) var(--space-xl);
        border-radius: var(--border-radius);
        font-size: var(--font-size-base);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .btn-primary-lg:hover {
        background: var(--primary-hover);
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .btn-outline-lg {
        background: var(--card-bg);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        padding: var(--space-md) var(--space-xl);
        border-radius: var(--border-radius);
        font-size: var(--font-size-base);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .btn-outline-lg:hover {
        border-color: var(--primary);
        color: var(--primary);
        box-shadow: var(--shadow-sm);
        transform: translateY(-1px);
    }

    /* --- STATS --- */
    .stats {
        display: flex;
        justify-content: center;
        gap: var(--space-2xl);
        margin-top: var(--space-2xl);
        padding-top: var(--space-xl);
        border-top: 1px solid var(--border-color);
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: var(--font-size-3xl);
        font-weight: 800;
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

    /* --- FEATURES --- */
    .features {
        padding: var(--space-2xl) var(--space-lg);
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .features-header {
        text-align: center;
        margin-bottom: var(--space-2xl);
    }

    .features-header h2 {
        font-size: var(--font-size-3xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .features-header p {
        color: var(--text-muted);
        font-size: var(--font-size-base);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: var(--space-lg);
    }

    .feature-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-xl);
        transition: var(--transition);
        text-align: center;
    }

    .feature-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-3px);
        border-color: transparent;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--border-radius);
        margin: 0 auto var(--space-md);
    }

    .feature-icon svg {
        width: 28px;
        height: 28px;
    }

    .feature-icon.blue {
        background: var(--primary-light);
        color: var(--primary);
    }

    .feature-icon.green {
        background: var(--success-light);
        color: var(--success);
    }

    .feature-icon.amber {
        background: var(--warning-light);
        color: var(--warning);
    }

    .feature-icon.red {
        background: var(--danger-light);
        color: var(--danger);
    }

    .feature-card h3 {
        font-size: var(--font-size-lg);
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .feature-card p {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* --- CONTACT SECTION --- */
    .contact-section {
        background: var(--card-bg);
        border-top: 1px solid var(--border-color);
        padding: var(--space-2xl) var(--space-lg);
    }

    .contact-inner {
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
    }

    .contact-inner h2 {
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .contact-inner .contact-subtitle {
        font-size: var(--font-size-base);
        color: var(--text-muted);
        margin-bottom: var(--space-xl);
    }

    .contact-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: var(--space-lg);
        margin-bottom: var(--space-xl);
    }

    .contact-card {
        background: var(--body-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-lg);
        text-align: center;
        transition: var(--transition);
    }

    .contact-card:hover {
        box-shadow: var(--shadow-sm);
    }

    .contact-card-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--border-radius);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: var(--space-md);
    }

    .contact-card-icon.blue {
        background: var(--primary-light);
        color: var(--primary);
    }

    .contact-card-icon.green {
        background: var(--success-light);
        color: var(--success);
    }

    .contact-card-icon.amber {
        background: var(--warning-light);
        color: var(--warning);
    }

    .contact-card-icon svg {
        width: 22px;
        height: 22px;
    }

    .contact-card h4 {
        font-size: var(--font-size-sm);
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
    }

    .contact-card p {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
    }

    .contact-card a {
        color: var(--text-muted);
        text-decoration: none;
    }

    .contact-card a:hover {
        color: var(--primary);
    }

    .btn-contact {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-md) var(--space-xl);
        background: var(--primary);
        color: var(--text-white);
        border: none;
        border-radius: var(--border-radius);
        font-size: var(--font-size-base);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-contact:hover {
        background: var(--primary-hover);
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .btn-contact svg {
        width: 18px;
        height: 18px;
    }

    /* --- FOOTER --- */
    .welcome-footer {
        text-align: center;
        padding: var(--space-lg);
        border-top: 1px solid var(--border-color);
        color: var(--text-muted);
        font-size: var(--font-size-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-xs);
    }

    .welcome-footer svg {
        width: 14px;
        height: 14px;
        color: var(--danger);
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: var(--font-size-3xl);
        }

        .hero p {
            font-size: var(--font-size-base);
        }

        .welcome-nav .nav-inner {
            flex-direction: column;
            height: auto;
            padding: var(--space-md) 0;
            gap: var(--space-sm);
        }

        .hero {
            padding: var(--space-xl) var(--space-md);
            min-height: auto;
        }

        .stats {
            gap: var(--space-lg);
            flex-wrap: wrap;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="welcome-wrapper">
    <!-- Navigation -->
    <nav class="welcome-nav">
        <div class="nav-inner">
            <a href="{{ url('/') }}" class="logo">
                <!-- Clipboard Check Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                    <polyline points="9 14 11 16 15 12"/>
                </svg>
                TaskApp
            </a>
            <div class="nav-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-nav-register">
                            <!-- Layout Dashboard Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7"/>
                                <rect x="14" y="3" width="7" height="7"/>
                                <rect x="14" y="14" width="7" height="7"/>
                                <rect x="3" y="14" width="7" height="7"/>
                            </svg>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-login">
                            <!-- Log In Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                <polyline points="10 17 15 12 10 7"/>
                                <line x1="15" y1="12" x2="3" y2="12"/>
                            </svg>
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-nav-register">
                                <!-- User Plus Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="8.5" cy="7" r="4"/>
                                    <line x1="20" y1="8" x2="20" y2="14"/>
                                    <line x1="23" y1="11" x2="17" y2="11"/>
                                </svg>
                                Get Started
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="dot"></span>
                Simple & Powerful Task Management
            </div>
            <h1>
                Organize your <span>projects</span> with ease
            </h1>
            <p>
                Create projects, manage tasks, and track progress — all in one place.
                Stay productive and never miss a deadline.
            </p>
            <div class="hero-actions">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary-lg">
                        <!-- Rocket Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/>
                            <path d="M12 15l-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/>
                            <path d="M9 12H4l.5-2.5"/>
                            <path d="M15 12h5l-.5 2.5"/>
                        </svg>
                        Start Free
                    </a>
                @endif
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn-outline-lg">
                        <!-- Arrow Right Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                        Sign In
                    </a>
                @endif
            </div>

            <!-- Stats Row -->
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Free to Use</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">CRUD</div>
                    <div class="stat-label">Full Control</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Available</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="features-header">
            <h2>Everything you need to stay organized</h2>
            <p>Manage your workflow efficiently with our core features.</p>
        </div>
        <div class="features-grid">
            <!-- Card 1: Projects -->
            <div class="feature-card">
                <div class="feature-icon blue">
                    <!-- Folder Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3>Projects</h3>
                <p>Create and manage multiple projects effortlessly. Keep all your work organized and accessible in one central place.</p>
            </div>

            <!-- Card 2: Tasks -->
            <div class="feature-card">
                <div class="feature-icon green">
                    <!-- Check Square Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                </div>
                <h3>Tasks</h3>
                <p>Break projects into actionable tasks. Update statuses, set priorities, and track completion with full CRUD control.</p>
            </div>

            <!-- Card 3: Security -->
            <div class="feature-card">
                <div class="feature-icon amber">
                    <!-- Shield Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Secure Access</h3>
                <p>Your data stays private. Register and log in to manage only your own projects with complete security.</p>
            </div>

            <!-- Card 4: Track Progress -->
            <div class="feature-card">
                <div class="feature-icon red">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                        <polyline points="17 6 23 6 23 12"/>
                    </svg>
                </div>
                <h3>Track Progress</h3>
                <p>Monitor your project milestones and task completion at a glance. Stay on top of deadlines effortlessly.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-inner">
            <h2>Get in touch</h2>
            <p class="contact-subtitle">Have questions? We'd love to hear from you.</p>
            <div class="contact-cards">
                <!-- Email -->
                <div class="contact-card">
                    <div class="contact-card-icon blue">
                        <!-- Mail Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <h4>Email</h4>
                    <p><a href="mailto:support@taskapp.com">support@taskapp.com</a></p>
                </div>
                <!-- Location -->
                <div class="contact-card">
                    <div class="contact-card-icon green">
                        <!-- Map Pin Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h4>Location</h4>
                    <p>Casablanca, Morocco</p>
                </div>
                <!-- Hours -->
                <div class="contact-card">
                    <div class="contact-card-icon amber">
                        <!-- Clock Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h4>Hours</h4>
                    <p>Mon – Fri, 9 AM – 6 PM</p>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="btn-contact">
                <!-- Send Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
                Send us a Message
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="welcome-footer">
        &copy; {{ date('Y') }} TaskApp. Made with
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
        Built with Laravel.
    </footer>
</div>
@endsection