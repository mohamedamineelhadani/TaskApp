@extends('layouts.app')

@section('title', 'Contact Us - TaskApp')

@section('content')
<style>
    /* ============================================================
       CONTACT PAGE STYLES
       ============================================================ */
    .contact-page {
        max-width: 1100px;
        margin: 0 auto;
        padding: var(--space-xl) var(--space-lg);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-xl);
        align-items: start;
    }

    /* --- Left: Info --- */
    .contact-info h1 {
        font-size: var(--font-size-3xl);
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
    }

    .contact-info .subtitle {
        font-size: var(--font-size-base);
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: var(--space-xl);
    }

    .contact-details {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
        margin-bottom: var(--space-xl);
    }

    .contact-detail-item {
        display: flex;
        align-items: flex-start;
        gap: var(--space-md);
    }

    .contact-detail-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--border-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .contact-detail-icon.blue {
        background: var(--primary-light);
        color: var(--primary);
    }

    .contact-detail-icon.green {
        background: var(--success-light);
        color: var(--success);
    }

    .contact-detail-icon.amber {
        background: var(--warning-light);
        color: var(--warning);
    }

    .contact-detail-icon svg {
        width: 20px;
        height: 20px;
    }

    .contact-detail-text h4 {
        font-size: var(--font-size-sm);
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 2px;
    }

    .contact-detail-text p {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        line-height: 1.5;
    }

    .contact-detail-text a {
        color: var(--text-muted);
        text-decoration: none;
    }

    .contact-detail-text a:hover {
        color: var(--primary);
    }

    /* --- Social Links --- */
    .social-links {
        display: flex;
        gap: var(--space-sm);
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: var(--border-radius);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        transition: var(--transition);
        text-decoration: none;
    }

    .social-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-light);
    }

    .social-link svg {
        width: 18px;
        height: 18px;
    }

    /* --- Right: Form --- */
    .contact-form-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: var(--space-xl);
        box-shadow: var(--shadow-sm);
    }

    .contact-form-card h2 {
        font-size: var(--font-size-xl);
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: var(--space-xs);
    }

    .contact-form-card .form-subtitle {
        font-size: var(--font-size-sm);
        color: var(--text-muted);
        margin-bottom: var(--space-lg);
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

    .form-input,
    .form-textarea {
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

    .form-textarea {
        resize: vertical;
        min-height: 140px;
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
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

    /* --- Responsive --- */
    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .contact-info h1 {
            font-size: var(--font-size-2xl);
        }
    }
</style>

<div class="contact-page">
    <div class="contact-grid">
        <!-- Left: Contact Info -->
        <div class="contact-info">
            <h1>Get in touch</h1>
            <p class="subtitle">
                Have a question, suggestion, or just want to say hello? We'd love to hear from you. Fill out the form and we'll get back to you as soon as possible.
            </p>

            <div class="contact-details">
                <!-- Email -->
                <div class="contact-detail-item">
                    <div class="contact-detail-icon blue">
                        <!-- Mail Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="contact-detail-text">
                        <h4>Email</h4>
                        <p><a href="mailto:support@taskapp.com">support@taskapp.com</a></p>
                    </div>
                </div>

                <!-- Location -->
                <div class="contact-detail-item">
                    <div class="contact-detail-icon green">
                        <!-- Map Pin Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div class="contact-detail-text">
                        <h4>Location</h4>
                        <p>Casablanca, Morocco</p>
                    </div>
                </div>

                <!-- Hours -->
                <div class="contact-detail-item">
                    <div class="contact-detail-icon amber">
                        <!-- Clock Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="contact-detail-text">
                        <h4>Hours</h4>
                        <p>Monday – Friday, 9:00 AM – 6:00 PM</p>
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="social-links">
                <a href="#" class="social-link" title="Twitter">
                    <!-- Twitter Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                    </svg>
                </a>
                <a href="#" class="social-link" title="GitHub">
                    <!-- GitHub Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
                    </svg>
                </a>
                <a href="#" class="social-link" title="LinkedIn">
                    <!-- Linkedin Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                        <rect x="2" y="9" width="4" height="12"/>
                        <circle cx="4" cy="4" r="2"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="contact-form-card">
            <h2>Send us a message</h2>
            <p class="form-subtitle">We'll get back to you within 24 hours.</p>

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <!-- Subject -->
                <div class="form-group">
                    <label for="subject" class="form-label">Subject</label>
                    <input
                        id="subject"
                        type="text"
                        name="subject"
                        class="form-input"
                        placeholder="What's this about?"
                        value="{{ old('subject') }}"
                    >
                    @error('subject')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="form-group">
                    <label for="message" class="form-label">Message</label>
                    <textarea
                        id="message"
                        name="message"
                        class="form-textarea"
                        placeholder="Tell us what's on your mind..."
                        required
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">
                    <!-- Send Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection