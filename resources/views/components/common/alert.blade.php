<div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
    <div class="alert alert-{{ $type }} flex items-center p-5 bg-red-500 text-white border border-red-900 rounded-lg">
        <span class="svg-icon svg-icon-2hx svg-icon-{{ $type }} me-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)"
                    fill="currentColor" />
                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)"
                    fill="currentColor" />
            </svg>
        </span>
        <div class="inline">
            <h4 class="mb-1 text-{{ $type }}">{{ $title }}</h4>
            {{ $slot }}
        </div>
    </div>
</div>
