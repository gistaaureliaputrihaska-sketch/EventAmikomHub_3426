@extends('layouts.admin')

@section('page_title', 'Tambah Partner Baru')
@section('page_subtitle', 'Daftarkan mitra baru untuk platform AmikomEventHub.')

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10">

        <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- NAMA PARTNER --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                    Nama Partner
                </label>
                <input type="text" name="name" value="{{ old('name') }}"
                    placeholder="cth: Midtrans, Tokopedia, GoPay..."
                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                    required>
                @error('name')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- LOGO URL --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                    URL Logo
                </label>
                <input type="url" name="logo_url" value="{{ old('logo_url') }}"
                    id="logoUrlInput"
                    placeholder="https://placehold.co/200x80/6366f1/white?text=Partner"
                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                    required>
                @error('logo_url')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror

                {{-- PREVIEW LOGO --}}
                <div id="logoPreview" class="mt-4 hidden">
                    <p class="text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Preview Logo:</p>
                    <div class="w-48 h-16 bg-slate-50 border-2 border-slate-100 rounded-2xl flex items-center justify-center overflow-hidden">
                        <img id="logoImg" src="" alt="Preview" class="max-w-full max-h-full object-contain">
                    </div>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="flex gap-4 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.partners.index') }}"
                    class="px-6 py-4 text-slate-500 font-bold bg-slate-100 rounded-2xl hover:bg-slate-200 transition">
                    Batal
                </a>
                <button type="submit"
                    class="flex-1 px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                    Simpan Partner
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const input = document.getElementById('logoUrlInput');
const preview = document.getElementById('logoPreview');
const img = document.getElementById('logoImg');

input.addEventListener('input', function() {
    const val = this.value.trim();
    if (val.startsWith('http')) {
        img.src = val;
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
});

// Trigger on load if old value exists
if (input.value.trim()) {
    img.src = input.value.trim();
    preview.classList.remove('hidden');
}
</script>

@endsection
