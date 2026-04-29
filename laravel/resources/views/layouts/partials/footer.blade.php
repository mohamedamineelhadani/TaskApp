<style>
    .app-footer {
        background: var(--navbar-bg);
        border-top: 1px solid var(--navbar-border);
        padding: var(--space-lg);
    }

    .app-footer .footer-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: var(--space-md);
    }

    .app-footer .footer-brand {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
        font-weight: 600;
        color: var(--navbar-text);
        font-size: var(--font-size-sm);
    }

    .app-footer .footer-brand svg {
        width: 18px;
        height: 18px;
        color: var(--primary);
    }

    .app-footer .footer-links {
        display: flex;
        align-items: center;
        gap: var(--space-lg);
    }

    .app-footer .footer-link {
        color: var(--navbar-link);
        font-size: var(--font-size-sm);
        transition: var(--transition);
    }

    .app-footer .footer-link:hover {
        color: var(--navbar-link-hover);
    }

    .app-footer .footer-copy {
        color: var(--text-muted);
        font-size: var(--font-size-xs);
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .app-footer .footer-copy svg {
        width: 12px;
        height: 12px;
        color: var(--danger);
    }

    @media (max-width: 768px) {
        .app-footer .footer-inner {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<footer class="app-footer">
    <div class="footer-inner">
        <a href="{{ url('/') }}" class="footer-brand">
            <!-- Clipboard Check Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                <polyline points="9 14 11 16 15 12"/>
            </svg>
            TaskApp
        </a>

        <div class="footer-links">
            <a href="#" class="footer-link">Privacy</a>
            <a href="#" class="footer-link">Terms</a>
            <a href="#" class="footer-link">Contact</a>
        </div>

        <span class="footer-copy">
            &copy; {{ date('Y') }} TaskApp. Made with
            <!-- Heart Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
        </span>
    </div>
</footer>