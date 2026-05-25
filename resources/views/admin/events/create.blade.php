@extends('layouts.admin')

@section('title', 'Tambah Event Baru - Admin')
@section('page_title', 'Tambah Event Baru')
@section('page_subtitle', 'Masukkan detail acara baru yang akan diselenggarakan.')

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm max-w-3xl">

<form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
@csrf

{{-- JUDUL --}}
<div>
    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Judul Event</label>
    <input type="text" name="title" value="{{ old('title') }}"
        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl"
        required>
</div>

{{-- KATEGORI --}}
<div>
    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Kategori</label>
    <select name="category_id" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl" required>
        <option value="">Pilih Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>

{{-- DESKRIPSI --}}
<div>
    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Deskripsi</label>
    <textarea name="description" rows="4"
        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl"></textarea>
</div>

{{-- TANGGAL --}}
<div>
    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Tanggal</label>
    <input type="datetime-local" name="date"
        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl"
        required>
</div>

{{-- LOKASI --}}
<div>
    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Lokasi</label>
    <input type="text" name="location"
        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl"
        required>
</div>

{{-- HARGA (INI YANG TADI KURANG) --}}
<div>
    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Harga Tiket</label>
    <input type="number" name="price"
        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl"
        required>
</div>

{{-- STOK --}}
<div>
    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Stok</label>
    <input type="number" name="stock"
        class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl"
        required>
</div>

{{-- POSTER --}}
<div>
    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Poster</label>
    <input type="file" name="poster" class="w-full">
</div>

{{-- BUTTON --}}
<div class="pt-4 flex justify-end gap-4">
    <a href="{{ route('admin.events.index') }}">Batal</a>
    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-xl">
        Simpan Event
    </button>
</div>

</form>
</div>
@endsection