<x-app-layout>
    @section('title', 'USERS | SETUKPA LEMDIKLAT POLRI')

    <div class="pt-4 pb-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="relative bg-gray-50 backdrop-blur-md rounded-xl shadow-lg px-6 py-4 mb-8 overflow-hidden">

                {{-- Judul Header --}}
                <div class="text-center">
                    <h2 class="text-lg md:text-xl lg:text-lg font-bold text-white inline-flex items-center gap-2
                                bg-gradient-to-r from-slate-700 via-slate-600 to-slate-800
                                px-4 py-1 rounded-xl shadow-md">
                        <i class="bi bi-people-fill text-white text-xl md:text-lg"></i>
                        MANAGE USERS
                    </h2>
                </div>

                {{-- Tombol Tambah & Hapus Semua --}}
                @auth
                    @if(Auth::user()->role === 'super_admin')
                        <div class="absolute right-6 top-6 flex gap-2">
                            {{-- Tambah User --}}
                            <a href="{{ route('users.create') }}"
                                class="bg-[#800000] hover:bg-[#660000]
                                    text-white px-3 py-1.5 rounded-md text-sm shadow-md
                                    transition duration-300 ease-in-out inline-flex items-center">
                                <i class="bi bi-plus-circle text-sm mr-1"></i>
                                Tambah User
                            </a>

                            {{-- Hapus Semua User --}}
                            <button type="button"
                                class="bg-red-600 hover:bg-red-700
                                    text-white px-3 py-1.5 rounded-md text-sm shadow-md
                                    transition duration-300 ease-in-out inline-flex items-center"
                                data-bs-toggle="modal"
                                data-bs-target="#hapusSemuaUserModal">
                                <i class="bi bi-trash3 mr-1"></i>
                                Hapus Semua
                            </button>
                        </div>
                    @endif
                @endauth

                {{-- LIST USERS --}}
                <div class="overflow-x-auto mt-8">
                    <table class="w-full border-collapse">
                        <thead class="bg-slate-700 text-white text-sm">
                            <tr>
                                <th class="px-4 py-2 text-left">No</th>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Role</th>
                                <th class="px-4 py-2 text-left">Created</th>
                                <th class="px-4 py-2 text-left">Updated</th>
                                <th class="px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y">
                            @forelse($users as $index => $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 font-semibold text-gray-800">{{ $user->name }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $user->email }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ $user->role == 'super_admin' ? 'bg-purple-100 text-purple-700' :
                                                ($user->role == 'admin' ? 'bg-blue-100 text-blue-700' :
                                                    ($user->role == 'personel' ? 'bg-green-100 text-green-700' :
                                                        ($user->role == 'siswa' ? 'bg-pink-100 text-pink-700' : 'bg-gray-100 text-gray-700'))) }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 text-gray-500">{{ $user->updated_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 text-center">

                                        {{-- Button Edit Delete --}}
                                         @if(Auth::user()->role === 'super_admin')
                                            <div class="flex justify-center gap-2">
                                                {{-- Edit --}}
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    onclick="event.stopPropagation()"
                                                    class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100
                                                        shadow transition" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v12a2 2 0
                                                            002 2h12a2 2 0 002-2v-5M18.5
                                                            2.5a2.121 2.121 0 113 3L12 15l-4
                                                            1 1-4 9.5-9.5z"/>
                                                    </svg>
                                                </a>

                                                {{-- Hapus --}}
                                                <button type="button"
                                                        onclick="event.stopPropagation()"
                                                        class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100
                                                            shadow transition"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusUserModal{{ $user->id }}"
                                                        title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0
                                                            0116.138 21H7.862a2 2 0
                                                            01-1.995-1.858L5 7m5 4v6m4-6v6M9
                                                            7h6m-3-4v4"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">
                                        Belum ada user yang ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus User --}}
    @foreach ($users as $user)
        <div class="modal fade" id="hapusUserModal{{ $user->id }}" tabindex="-1"
            aria-labelledby="hapusLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered custom-modal">
                <div class="modal-content rounded-2xl shadow-lg border-0">

                    <div class="modal-header bg-red-600 text-white rounded-t-2xl py-2 px-3">
                        <h5 class="modal-title fs-6" id="hapusLabel{{ $user->id }}">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
                            Konfirmasi Hapus
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-center py-3 px-3">
                        <i class="bi bi-trash3-fill text-danger fs-3 mb-2"></i>
                        <p class="fw-semibold text-gray-700 mt-4 mb-2" style="font-size: 0.9rem;">
                            Apakah anda yakin ingin menghapus user <br>
                            <span class="text-danger">"{{ $user->name }}"</span>?
                        </p>
                    </div>

                    <div class="modal-footer d-flex justify-content-center gap-2 border-0 pb-3">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-3 py-1 rounded-pill shadow-sm">
                                Hapus
                            </button>
                        </form>
                        <button type="button"
                                class="btn btn-primary btn-sm px-3 py-1 rounded-pill shadow-sm"
                                data-bs-dismiss="modal">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Hapus Semua User --}}
    <div class="modal fade" id="hapusSemuaUserModal" tabindex="-1"
        aria-labelledby="hapusSemuaUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal">
            <div class="modal-content rounded-2xl shadow-lg border-0">

                <div class="modal-header bg-red-700 text-white rounded-t-2xl py-2 px-3">
                    <h5 class="modal-title fs-6" id="hapusSemuaUserLabel">
                        <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
                        Konfirmasi Hapus Semua
                    </h5>
                    <button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center py-3 px-3">
                    <i class="bi bi-trash3-fill text-danger fs-3 mb-2"></i>
                    <p class="fw-semibold text-gray-700 mt-4 mb-2" style="font-size: 0.9rem;">
                        Apakah anda yakin ingin menghapus <br>
                        <span class="text-danger">SEMUA user</span> kecuali akun Anda sendiri?
                    </p>
                </div>

                <div class="modal-footer d-flex justify-content-center gap-2 border-0 pb-3">
                    <form action="{{ route('users.destroyAll') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm px-3 py-1 rounded-pill shadow-sm">
                            Hapus Semua
                        </button>
                    </form>
                    <button type="button"
                            class="btn btn-primary btn-sm px-3 py-1 rounded-pill shadow-sm"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
