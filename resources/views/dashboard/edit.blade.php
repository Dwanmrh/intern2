<x-app-layout>

    @section('title', 'EDIT PREVIEW | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-5 rounded-xl shadow-xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-semibold text-center mb-4">Edit Preview</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-4 py-2 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('dashboard.update', $dashboard->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white text-sm font-medium mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $dashboard->judul }}"
                        class="w-full bg-white text-black placeholder-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Masukkan judul preview">
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white text-sm font-medium mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" value="{{ $dashboard->tanggal }}"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                    <small class="font-bold text-yellow-400 italic">Tanggal Wajib Diisi</small>
                </div>

                {{-- File Lama --}}
                @if ($dashboard->file)
                    <div class="mb-3">
                        <label class="block text-white font-semibold mb-1">File Saat Ini</label>

                        {{-- Preview file lama --}}
                        @php
                            $ext = pathinfo($dashboard->file, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ asset('storage/' . $dashboard->file) }}" class="w-40 rounded-md shadow-md mb-2">
                        @elseif (in_array(strtolower($ext), ['mp4', 'webm', 'ogg']))
                            <video src="{{ asset('storage/' . $dashboard->file) }}" controls class="w-60 rounded-md shadow-md mb-2"></video>
                        @else
                            <p class="text-gray-300 text-sm mb-2">File lama tidak bisa dipreview (format: {{ $ext }})</p>
                        @endif

                        {{-- Checkbox Hapus File Lama --}}
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="hapusFile" name="hapus_file" value="1"
                                class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            <label for="hapusFile" class="text-white text-sm">Hapus file lama</label>
                        </div>
                    </div>
                @endif

                {{-- Ganti File --}}
                <div class="mb-4">
                    <label class="block text-white font-semibold mb-1">Ganti File (Opsional)</label>
                    <input type="file" name="file" id="fileInput"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">
                         <p class="mt-1 text-sm text-red-500">
                        Ukuran file max 40 MB
                    </p>

                    {{-- Preview File Baru --}}
                    <div id="filePreviewContainer" class="mt-3 hidden">
                        <p class="text-white text-sm mb-1">Preview File Baru:</p>
                        <div id="filePreviewWrapper" class="rounded-md shadow-md"></div>
                    </div>
                </div>

                <script>
                    document.getElementById('fileInput').addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        const previewContainer = document.getElementById('filePreviewContainer');
                        const previewWrapper = document.getElementById('filePreviewWrapper');

                        previewWrapper.innerHTML = ""; // reset isi preview

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                if (file.type.startsWith('image/')) {
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.classList.add('w-40', 'rounded-md', 'shadow-md');
                                    previewWrapper.appendChild(img);
                                } else if (file.type.startsWith('video/')) {
                                    const video = document.createElement('video');
                                    video.src = e.target.result;
                                    video.controls = true;
                                    video.classList.add('w-60', 'rounded-md', 'shadow-md');
                                    previewWrapper.appendChild(video);
                                }
                                previewContainer.classList.remove('hidden');
                            };
                            reader.readAsDataURL(file);
                        } else {
                            previewContainer.classList.add('hidden');
                        }
                    });
                </script>

                {{-- Tombol --}}
                <div class="flex justify-end gap-2 pt-4">
                    <a href="{{ route('dashboard.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow hover:shadow-md transition text-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow hover:shadow-md transition text-sm">
                        Perbarui
                    </button>
                </div>
            </form>

            {{-- Flatpickr --}}
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
            <script>
                flatpickr("#tanggal", {
                    dateFormat: "d/m/Y",
                    locale: "id",
                });
            </script>
        </div>
    </div>
</x-app-layout>
