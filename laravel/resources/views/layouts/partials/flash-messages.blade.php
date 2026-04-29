<style>
    /* ============================================================
       FLASH MESSAGES
       ============================================================ */
    .flash-container {
        position: fixed;
        top: 80px;
        right: var(--space-lg);
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: var(--space-sm);
        max-width: 420px;
        width: 100%;
        pointer-events: none;
    }

    .flash-message {
        display: flex;
        align-items: flex-start;
        gap: var(--space-sm);
        padding: var(--space-md) var(--space-lg);
        border-radius: var(--border-radius);
        font-size: var(--font-size-sm);
        font-weight: 500;
        line-height: 1.5;
        box-shadow: var(--shadow-lg);
        pointer-events: auto;
        animation: slideInRight 0.35s ease, fadeOutRight 0.35s ease 4.5s forwards;
        position: relative;
    }

    .flash-message svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .flash-message .flash-text {
        flex: 1;
    }

    .flash-message .flash-close {
        background: none;
        border: none;
        cursor: pointer;
        padding: 2px;
        flex-shrink: 0;
        opacity: 0.6;
        transition: var(--transition);
    }

    .flash-message .flash-close:hover {
        opacity: 1;
    }

    .flash-message .flash-close svg {
        width: 16px;
        height: 16px;
    }

    /* --- Types --- */
    .flash-success {
        background: var(--success-light);
        color: var(--success-hover);
        border-left: 4px solid var(--success);
    }

    .flash-success .flash-close svg {
        color: var(--success);
    }

    .flash-error {
        background: var(--danger-light);
        color: var(--danger-hover);
        border-left: 4px solid var(--danger);
    }

    .flash-error .flash-close svg {
        color: var(--danger);
    }

    .flash-warning {
        background: var(--warning-light);
        color: var(--warning-hover);
        border-left: 4px solid var(--warning);
    }

    .flash-warning .flash-close svg {
        color: var(--warning);
    }

    .flash-info {
        background: var(--primary-light);
        color: var(--primary-hover);
        border-left: 4px solid var(--primary);
    }

    .flash-info .flash-close svg {
        color: var(--primary);
    }

    /* --- Animations --- */
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }

    /* --- Responsive --- */
    @media (max-width: 768px) {
        .flash-container {
            top: 16px;
            right: var(--space-md);
            left: var(--space-md);
            max-width: none;
        }
    }
</style>

@if (session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info') || $errors->any())
    <div class="flash-container" x-data="{ messages: [] }" x-init="
        @if (session()->has('success'))
            messages.push({ type: 'success', text: '{{ addslashes(session('success')) }}', id: Date.now() + 1 });
        @endif
        @if (session()->has('error'))
            messages.push({ type: 'error', text: '{{ addslashes(session('error')) }}', id: Date.now() + 2 });
        @endif
        @if (session()->has('warning'))
            messages.push({ type: 'warning', text: '{{ addslashes(session('warning')) }}', id: Date.now() + 3 });
        @endif
        @if (session()->has('info'))
            messages.push({ type: 'info', text: '{{ addslashes(session('info')) }}', id: Date.now() + 4 });
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                messages.push({ type: 'error', text: '{{ addslashes($error) }}', id: Date.now() + {{ $loop->iteration + 10 }} });
            @endforeach
        @endif

        // Auto remove after 5 seconds
        setTimeout(() => { messages = []; }, 5000);
    ">
        <template x-for="message in messages" :key="message.id">
            <div :class="'flash-message flash-' + message.type" x-show="true">
                <!-- Success Icon -->
                <template x-if="message.type === 'success'">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                        <path d='M22 11.08V12a10 10 0 1 1-5.93-9.14'/>
                        <polyline points='22 4 12 14.01 9 11.01'/>
                    </svg>
                </template>
                <!-- Error Icon -->
                <template x-if="message.type === 'error'">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                        <circle cx='12' cy='12' r='10'/>
                        <line x1='15' y1='9' x2='9' y2='15'/>
                        <line x1='9' y1='9' x2='15' y2='15'/>
                    </svg>
                </template>
                <!-- Warning Icon -->
                <template x-if="message.type === 'warning'">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                        <path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'/>
                        <line x1='12' y1='9' x2='12' y2='13'/>
                        <line x1='12' y1='17' x2='12.01' y2='17'/>
                    </svg>
                </template>
                <!-- Info Icon -->
                <template x-if="message.type === 'info'">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                        <circle cx='12' cy='12' r='10'/>
                        <line x1='12' y1='16' x2='12' y2='12'/>
                        <line x1='12' y1='8' x2='12.01' y2='8'/>
                    </svg>
                </template>
                <span class="flash-text" x-text="message.text"></span>
                <button class="flash-close" @click="messages = messages.filter(m => m.id !== message.id)">
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                        <line x1='18' y1='6' x2='6' y2='18'/>
                        <line x1='6' y1='6' x2='18' y2='18'/>
                    </svg>
                </button>
            </div>
        </template>
    </div>
@endif