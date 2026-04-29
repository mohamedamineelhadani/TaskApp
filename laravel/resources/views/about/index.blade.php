@extends('layouts.app')

@section('title', 'About - TaskApp')

@section('content')
<style>
    /* ============================================================
       ABOUT PAGE STYLES
       ============================================================ */
    .about-page {
        max-width: 1100px;
        margin: 0 auto;
        padding: var(--space-xl) var(--space-lg);
    }

    /* --- Hero Section --- */
    .about-hero {
        text-align: center;
        margin-bottom: var(--space-2xl);
        position: relative;
    }

    .about-hero .hero-icon {
        width: 80px;
        height: 80px;
        border-radius: var(--border-radius-xl);
        background: var(--primary-light);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: var(--space-lg);
    }

    .about-hero .hero-icon svg {
        width: 40px;
        height: 40px;
    }

    .about-hero h1 {
        font-size: var(--font-size-4xl);
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: var(--space-md);
        letter-spacing: -0.5px;
    }

    .about-hero h1 span {
        color: var(--primary);
    }

    .about-hero .lead {
        font-size: var(--font-size-lg);
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* --- Mission Section --- */
    .about-mission {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-2xl);
        margin-bottom: var(--space-2xl);
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-2xl);
        align-items: center;
    }

    .mission-text h2 {
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-md);
    }

    .mission-text p {
        font-size: var(--font-size-base);
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: var(--space-md);
    }

    .mission-text p:last-child {
        margin-bottom: 0;
    }

    .mission-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-lg);
    }

    .mission-stat {
        text-align: center;
        background: var(--body-bg);
        border-radius: var(--border-radius-lg);
        padding: var(--space-xl);
    }

    .mission-stat .stat-number {
        font-size: var(--font-size-3xl);
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        margin-bottom: var(--space-xs);
    }

    .mission-stat .stat-label {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        font-weight: 500;
    }

    /* --- Features Highlight --- */
    .features-highlight {
        margin-bottom: var(--space-2xl);
    }

    .features-highlight h2 {
        text-align: center;
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .features-highlight .section-subtitle {
        text-align: center;
        color: var(--text-muted);
        font-size: var(--font-size-base);
        margin-bottom: var(--space-xl);
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
        text-align: center;
        transition: var(--transition);
    }

    .feature-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-3px);
        border-color: transparent;
    }

    .feature-card .feature-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--border-radius);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: var(--space-md);
    }

    .feature-card .feature-icon svg {
        width: 26px;
        height: 26px;
    }

    .feature-card .feature-icon.blue {
        background: var(--primary-light);
        color: var(--primary);
    }

    .feature-card .feature-icon.green {
        background: var(--success-light);
        color: var(--success);
    }

    .feature-card .feature-icon.amber {
        background: var(--warning-light);
        color: var(--warning);
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

    /* --- Tech Stack --- */
    .tech-stack {
        background: var(--navbar-bg);
        border-radius: var(--border-radius-lg);
        padding: var(--space-2xl);
        margin-bottom: var(--space-2xl);
        text-align: center;
    }

    .tech-stack h2 {
        font-size: var(--font-size-2xl);
        font-weight: 700;
        color: var(--navbar-text);
        margin-bottom: var(--space-xs);
    }

    .tech-stack .section-subtitle {
        color: var(--navbar-link);
        font-size: var(--font-size-base);
        margin-bottom: var(--space-xl);
    }

    .tech-badges {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: var(--space-md);
    }

    .tech-badge {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        padding: var(--space-sm) var(--space-lg);
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid var(--navbar-border);
        border-radius: var(--border-radius-pill);
        color: var(--navbar-text);
        font-size: var(--font-size-sm);
        font-weight: 500;
        transition: var(--transition);
    }

    .tech-badge:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: var(--navbar-link-hover);
    }

    .tech-badge svg {
        width: 18px;
        height: 18px;
        color: var(--primary);
    }

   
    /* --- Responsive --- */
    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: var(--font-size-3xl);
        }

        .about-mission {
            grid-template-columns: 1fr;
            padding: var(--space-xl);
        }

        .mission-stats {
            grid-template-columns: 1fr 1fr;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="about-page">
    <!-- Hero -->
    <div class="about-hero">
        <div class="hero-icon">
            <!-- Clipboard Check Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                <polyline points="9 14 11 16 15 12"/>
            </svg>
        </div>
        <h1>About <span>TaskApp</span></h1>
        <p class="lead">
            A simple yet powerful task management application built to help you organize projects, track progress, and boost your productivity.
        </p>
    </div>

    <!-- Mission -->
    <div class="about-mission">
        <div class="mission-text">
            <h2>Our Mission</h2>
            <p>
                At TaskApp, we believe managing tasks shouldn't be complicated. Our mission is to provide a clean, intuitive platform where you can create projects, organize tasks, and track completion — all in one place.
            </p>
            <p>
                Whether you're a solo developer, a freelancer, or part of a team, TaskApp helps you stay focused on what matters most: getting things done.
            </p>
        </div>
        <div class="mission-stats">
            <div class="mission-stat">
                <div class="stat-number">100%</div>
                <div class="stat-label">Free</div>
            </div>
            <div class="mission-stat">
                <div class="stat-number">CRUD</div>
                <div class="stat-label">Full Control</div>
            </div>
            <div class="mission-stat">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Available</div>
            </div>
            <div class="mission-stat">
                <div class="stat-number">Secure</div>
                <div class="stat-label">Private Data</div>
            </div>
        </div>
    </div>

    <!-- Features Highlight -->
    <div class="features-highlight">
        <h2>What makes TaskApp great</h2>
        <p class="section-subtitle">Everything you need to manage your workflow efficiently.</p>
        <div class="features-grid">
            <!-- Feature 1 -->
            <div class="feature-card">
                <div class="feature-icon blue">
                    <!-- Folder Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3>Project Management</h3>
                <p>Create unlimited projects and organize them with ease. Each project serves as a container for all your related tasks.</p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card">
                <div class="feature-icon green">
                    <!-- Check Square Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 11 12 14 22 4"/>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                </div>
                <h3>Task Tracking</h3>
                <p>Add tasks to any project, toggle their status with one click, and watch your progress grow with each completed item.</p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card">
                <div class="feature-icon amber">
                    <!-- Shield Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Private & Secure</h3>
                <p>Your data belongs to you. Each user has their own private workspace — no one else can see your projects.</p>
            </div>
        </div>
    </div>

    <!-- Tech Stack -->
    <div class="tech-stack">
        <h2>Built with modern tools</h2>
        <p class="section-subtitle">Powered by a robust and reliable technology stack.</p>
        <div class="tech-badges">
            <span class="tech-badge">
                <!-- Code Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="16 18 22 12 16 6"/>
                    <polyline points="8 6 2 12 8 18"/>
                </svg>
                Laravel 10
            </span>
            <span class="tech-badge">
                <!-- Database Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <ellipse cx="12" cy="5" rx="9" ry="3"/>
                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                </svg>
                MySQL
            </span>
            <span class="tech-badge">
                <!-- Layout Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <line x1="3" y1="9" x2="21" y2="9"/>
                    <line x1="9" y1="21" x2="9" y2="9"/>
                </svg>
                Blade Templates
            </span>
            <span class="tech-badge">
                <!-- Palette Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="13.5" cy="6.5" r="1.5"/>
                    <circle cx="17.5" cy="10.5" r="1.5"/>
                    <circle cx="8.5" cy="7.5" r="1.5"/>
                    <circle cx="6.5" cy="12.5" r="1.5"/>
                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.93 0 1.5-.67 1.5-1.5 0-.4-.15-.75-.4-1.02-.25-.28-.35-.63-.35-1 0-.83.67-1.5 1.5-1.5H18c3.3 0 6-2.7 6-6 0-5.5-5-9-12-9z"/>
                </svg>
                Custom CSS
            </span>
            <span class="tech-badge">
                <!-- Feather Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/>
                    <line x1="16" y1="8" x2="2" y2="22"/>
                    <line x1="17.5" y1="15" x2="9" y2="15"/>
                </svg>
                SVG Icons
            </span>
        </div>
    </div>

</div>
@endsection