<style>
    /* ============================================================
       NAVIGATION STYLES
       ============================================================ */
    .app-nav {
        background: var(--navbar-bg);
        border-bottom: 1px solid var(--navbar-border);
        padding: 0 var(--space-lg);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .app-nav .nav-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 64px;
    }

    /* --- Brand --- */
    .app-nav .nav-brand {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        font-size: var(--font-size-lg);
        font-weight: 700;
        color: var(--navbar-text);
    }

    .app-nav .nav-brand svg {
        width: 26px;
        height: 26px;
        color: var(--primary);
    }

    /* --- Links --- */
    .app-nav .nav-links {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .app-nav .nav-link {
        color: var(--navbar-link);
        font-size: var(--font-size-sm);
        font-weight: 500;
        padding: var(--space-sm) var(--space-md);
        border-radius: var(--border-radius);
        transition: var(--transition);
        white-space: nowrap;
    }

    .app-nav .nav-link:hover {
        color: var(--navbar-link-hover);
        background: rgba(255, 255, 255, 0.06);
    }

    .app-nav .nav-link.active {
        color: var(--navbar-link-hover);
        background: rgba(255, 255, 255, 0.1);
    }

    /* --- Right Section --- */
    .app-nav .nav-right {
        display: flex;
        align-items: center;
        gap: var(--space-md);
    }

    .app-nav .nav-welcome {
        color: var(--navbar-link);
        font-size: var(--font-size-sm);
    }

    .app-nav .nav-welcome strong {
        color: var(--navbar-link-hover);
        font-weight: 600;
    }

    .app-nav .btn-logout {
        display: inline-flex;
        align-items: center;
        gap: var(--space-xs);
        background: transparent;
        color: var(--danger-light);
        border: 1px solid var(--danger);
        padding: var(--space-sm) var(--space-md);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }

    .app-nav .btn-logout:hover {
        background: var(--danger);
        color: var(--text-white);
    }

    .app-nav .btn-logout svg {
        width: 16px;
        height: 16px;
    }

    /* --- Mobile Hamburger --- */
    .nav-hamburger {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: var(--space-xs);
        color: var(--navbar-link-hover);
    }

    .nav-hamburger svg {
        width: 24px;
        height: 24px;
    }

    @media (max-width: 768px) {
        .app-nav .nav-links {
            display: none;
            position: absolute;
            top: 64px;
            left: 0;
            right: 0;
            background: var(--navbar-bg);
            flex-direction: column;
            padding: var(--space-md);
            border-bottom: 1px solid var(--navbar-border);
            gap: var(--space-xs);
        }

        .app-nav .nav-links.open {
            display: flex;
        }

        .nav-hamburger {
            display: block;
        }

        .app-nav .nav-right {
            gap: var(--space-sm);
        }

        .app-nav .nav-welcome {
            display: none;
        }
    }
</style>

<nav class="app-nav" x-data="{ open: false }">
    <div class="nav-inner">
        <!-- Brand -->
        <a href="{{ route('home') }}" class="nav-brand">
            <!-- Clipboard Check Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                <polyline points="9 14 11 16 15 12"/>
            </svg>
            Task Management
        </a>

        <!-- Nav Links -->
        <div class="nav-links" :class="{ 'open': open }">
            <a href="{{ route('home') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">Home</a>
            <a href="{{ route('projects.index') }}" class="nav-link {{ request()->is('projects*') ? 'active' : '' }}">Projects</a>
            <a href="{{ route('about') }}" class="nav-link {{ request()->is('about*') ? 'active' : '' }}">About</a>
            <a href="{{ route('contact') }}" class="nav-link {{ request()->is('contact*') ? 'active' : '' }}">Contact</a>
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">Profile</a>
        </div>

        <!-- Right Side -->
        <div class="nav-right">
            <a href="{{ route('profile.edit') }}" class="nav-welcome">
                Welcome, <strong>{{ Auth::user()->name ?? 'User' }}</strong>
            </a>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <!-- Log Out Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Logout
                </button>
            </form>

            <!-- Hamburger -->
            <button class="nav-hamburger" @click="open = !open">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
        </div>
    </div>
</nav>