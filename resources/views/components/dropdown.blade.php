@props(['align' => 'right', 'width' => '48'])

@php
    $alignmentClasses = match($align) {
        'left' => 'origin-top-left left-0',
        'top' => 'origin-top',
        'none' => '',
        default => 'origin-top-right right-0',
    };

    $widthClass = match($width) {
        '48' => 'w-48',
        default => 'w-48',
    };
@endphp

<div x-data="{ open: false }" class="relative">
    <!-- Trigger -->
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <!-- Dropdown Content -->
    <div
        x-show="open"
        @click.away="open = false"
        x-transition
        class="absolute z-50 mt-2 rounded-md shadow-lg {{ $alignmentClasses }}"
        style="display: none;"
    >
        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-white {{ $widthClass }}">
            {{ $content }}
        </div>
    </div>
</div>
