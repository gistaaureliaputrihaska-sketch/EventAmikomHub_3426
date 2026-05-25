@extends('layouts.admin')

@section('page_title', 'Kelola Kategori')
@section('page_subtitle', 'Atur kategori event yang tersedia di platform.')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- KOLOM KIRI: FORM TAMBAH --}}
    <div class="lg:col-span-1 space-y-6">

        {{-- FORM TAMBAH --}}
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
            <h2 class="text-lg font-black text-slate-800 mb-6">Tambah Kategori Baru</h2>
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        placeholder="cth: Seminar IT"
                        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                        required>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                    + Simpan Kategori
                </button>
            </form>
        </div>

        {{-- INFO CARD --}}
        <div class="bg-indigo-50 border border-indigo-100 rounded-[2rem] p-6">
            <p class="text-sm font-bold text-indigo-700 mb-1">💡 Tips</p>
            <p class="text-xs text-indigo-500 leading-relaxed">Slug otomatis dibuat dari nama kategori. Kategori yang sudah memiliki event tidak dapat langsung dihapus tanpa memindahkan event terlebih dahulu.</p>
        </div>
    </div>

    {{-- KOLOM KANAN: TABEL --}}
    <div class="lg:col-span-2">

        {{-- SEARCH BAR --}}
        <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-4">
            <div class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama kategori..."
                    class="flex-1 px-5 py-3.5 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium text-sm">
                <button type="submit"
                    class="px-6 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition text-sm">
                    Cari
                </button>
                @if(request('search'))
                <a href="{{ route('admin.categories.index') }}"
                    class="px-6 py-3.5 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition text-sm">
                    Reset
                </a>
                @endif
            </div>
        </form>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4 w-12">No</th>
                            <th class="px-8 py-4">Nama Kategori</th>
                            <th class="px-8 py-4">Slug</th>
                            <th class="px-8 py-4 text-center">Event</th>
                            <th class="px-8 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-t">
                        @forelse($categories as $index => $category)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-8 py-5 font-bold text-slate-400">{{ $index + 1 }}</td>
                            <td class="px-8 py-5 font-black text-slate-800">{{ $category->name }}</td>
                            <td class="px-8 py-5">
                                <span class="text-xs font-mono bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg">
                                    {{ $category->slug }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 font-bold text-sm">
                                    {{ $category->events_count }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex gap-2 justify-center">
                                    {{-- EDIT BUTTON → buka modal --}}
                                    <button type="button"
                                        onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                        class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus kategori {{ addslashes($category->name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center">
                                <p class="text-slate-400 font-medium">
                                    @if(request('search'))
                                        Tidak ada kategori yang cocok dengan pencarian "{{ request('search') }}"
                                    @else
                                        Belum ada kategori. Tambahkan kategori pertama!
                                    @endif
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT KATEGORI --}}
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] p-8 w-full max-w-md shadow-2xl">
        <h2 class="text-xl font-black text-slate-800 mb-6">Edit Kategori</h2>
        <form id="editForm" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Kategori</label>
                <input type="text" id="editName" name="name"
                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                    required>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeEditModal()"
                    class="flex-1 px-6 py-4 text-slate-500 font-bold bg-slate-100 rounded-2xl hover:bg-slate-200 transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, name) {
    const baseUrl = '{{ url("admin/categories") }}';
    document.getElementById('editForm').action = baseUrl + '/' + id;
    document.getElementById('editName').value = name;
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}
function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}
// Tutup modal saat klik backdrop
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
</script>

@endsection
