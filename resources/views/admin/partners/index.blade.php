@extends('layouts.admin')

@section('page_title', 'Kelola Partner')
@section('page_subtitle', 'Daftar mitra yang mendukung platform AmikomEventHub.')

@section('content')

{{-- TOOLBAR: SEARCH + TOMBOL TAMBAH --}}
<div class="flex flex-col sm:flex-row gap-4 mb-6">
    <form method="GET" action="{{ route('admin.partners.index') }}" class="flex gap-3 flex-1">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari nama partner..."
            class="flex-1 px-5 py-3.5 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium text-sm">
        <button type="submit"
            class="px-6 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition text-sm">
            Cari
        </button>
        @if(request('search'))
        <a href="{{ route('admin.partners.index') }}"
            class="px-5 py-3.5 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition text-sm">
            Reset
        </a>
        @endif
    </form>
    <a href="{{ route('admin.partners.create') }}"
        class="inline-flex items-center gap-2 px-6 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition text-sm whitespace-nowrap">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Partner
    </a>
</div>

{{-- TABEL PARTNER --}}
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4 w-12">No</th>
                    <th class="px-8 py-4">Logo</th>
                    <th class="px-8 py-4">Nama Partner</th>
                    <th class="px-8 py-4">Logo URL</th>
                    <th class="px-8 py-4">Bergabung</th>
                    <th class="px-8 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($partners as $index => $partner)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-5 font-bold text-slate-400">
                        {{ $partners->firstItem() + $index }}
                    </td>
                    <td class="px-8 py-5">
                        <div class="w-24 h-10 rounded-xl overflow-hidden bg-slate-50 border border-slate-100 flex items-center justify-center">
                            <img src="{{ $partner->logo_url }}"
                                 alt="{{ $partner->name }}"
                                 class="max-w-full max-h-full object-contain"
                                 onerror="this.src='https://placehold.co/200x80/e2e8f0/94a3b8?text=No+Logo'">
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <p class="font-black text-slate-800">{{ $partner->name }}</p>
                    </td>
                    <td class="px-8 py-5 max-w-[200px]">
                        <p class="text-xs text-slate-400 truncate font-mono" title="{{ $partner->logo_url }}">
                            {{ $partner->logo_url }}
                        </p>
                    </td>
                    <td class="px-8 py-5">
                        <p class="text-sm text-slate-400">{{ $partner->created_at->format('d M Y') }}</p>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex gap-2 justify-center">
                            {{-- EDIT --}}
                            <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            {{-- DELETE --}}
                            <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                onsubmit="return confirm('Hapus partner {{ addslashes($partner->name) }}?')">
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
                    <td colspan="6" class="px-8 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-400">
                            <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                            </svg>
                            <p class="font-medium">
                                @if(request('search'))
                                    Tidak ada partner yang cocok dengan "{{ request('search') }}"
                                @else
                                    Belum ada data partner
                                @endif
                            </p>
                            @unless(request('search'))
                            <a href="{{ route('admin.partners.create') }}"
                                class="mt-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold text-sm hover:bg-indigo-700 transition">
                                + Tambah Partner Pertama
                            </a>
                            @endunless
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-8 py-6 bg-slate-50/50 border-t">
        {{ $partners->links() }}
    </div>
</div>

@endsection
