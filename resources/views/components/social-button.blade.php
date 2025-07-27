@props(['icon', 'label'])

<div class="bg-white rounded-lg shadow p-4 w-28 h-24 flex flex-col items-center justify-center hover:bg-gray-100">
    <i class="bi {{ $icon }} text-2xl mb-2"></i>
    <span class="text-sm font-medium">{{ $label }}</span>
</div>
