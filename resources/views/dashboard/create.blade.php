<x-app-layout>

    @section('title', 'TAMBAH PREVIEW | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-8 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header Tengah --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Tambah Preview</h2>

            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Judul</label>
                    <input type="text" name="judul"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-inner transition"
                        required placeholder="Masukkan judul preview">
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-inner transition"
                        required placeholder="Format: DD/MM/YYYY">
                    <small class="font-bold text-yellow-400 italic">Tanggal Wajib Diisi</small>
                </div>

                {{-- File --}}
                <div class="mb-3">
                    <label class="block text-white font-semibold mb-1">Upload Preview</label>
                    <input type="file" name="file" id="fileInput"
                        class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-400">

                    {{-- Preview --}}
                    <div id="filePreviewContainer" class="mt-3 hidden">
                        <p class="text-white text-sm mb-1">Preview:</p>
                        <div id="filePreviewWrapper" class="rounded-md shadow-md"></div>
                    </div>
                </div>

                <script>
                    document.getElementById('fileInput').addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        const previewContainer = document.getElementById('filePreviewContainer');
                        const previewWrapper = document.getElementById('filePreviewWrapper');

                        previewWrapper.innerHTML = ""; // reset konten preview

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                if (file.type.startsWith('image/')) {
                                    // preview gambar
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.classList.add('w-40', 'rounded-md', 'shadow-md');
                                    previewWrapper.appendChild(img);
                                } else if (file.type.startsWith('video/')) {
                                    // preview video
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
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('dashboard.index') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md shadow-md hover:shadow-lg transition">
                        Simpan
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
