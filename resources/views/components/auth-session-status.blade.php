@props(['status'])

@if ($status)
    <div id="statusMessage" {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById('statusMessage');
            if (msg) {
                msg.style.display = 'none';
            }
        }, 10000); // 10000 ms = 10 detik
    </script>
@endif
