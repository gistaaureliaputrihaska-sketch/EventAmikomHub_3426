@extends('layouts.app')

@section('content')

<!-- ===== HERO SECTION ===== -->
<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
    <div class="flex-1 space-y-8">
        <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
            #1 Event Platform
        </span>
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
        </h1>
        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu.
            Pesan aman & cepat dengan Midtrans.
        </p>
        <div class="flex gap-4">
            <a href="#events"
                class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                Mulai Jelajah
            </a>
            <a href="#"
                class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                Cara Pesan
            </a>
        </div>
    </div>

    <div class="flex-1 relative">
        <div class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <img src="{{ asset('assets/concert.png') }}" alt="Concert"
            class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">
        <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-xl">✓</div>
                <div>
                    <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                    <p class="font-bold">Pembayaran Aman via Midtrans</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== KATEGORI SECTION (UTS Soal 4) ===== -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold mb-2">Jelajahi Berdasarkan Kategori</h2>
            <p class="text-slate-500 font-medium">Temukan event sesuai minat dan passionmu</p>
        </div>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ url('/') }}"
               class="group flex flex-col items-center gap-3 px-8 py-6 rounded-[1.5rem] border-2 transition
                      {{ !request('category') ? 'border-indigo-600 bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'border-slate-200 bg-white text-slate-700 hover:border-indigo-400 hover:text-indigo-600' }}">
                <span class="text-2xl">🎪</span>
                <span class="font-bold text-sm">Semua</span>
            </a>
            @foreach($categories as $cat)
            @php
                $icons = ['🎵','💻','🎓','🏆','🌟','🎨','🎤','🚀'];
                $icon = $icons[$loop->index % count($icons)];
            @endphp
            <a href="{{ url('/?category=' . $cat->slug) }}"
               class="group flex flex-col items-center gap-3 px-8 py-6 rounded-[1.5rem] border-2 transition
                      {{ request('category') === $cat->slug ? 'border-indigo-600 bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'border-slate-200 bg-white text-slate-700 hover:border-indigo-400 hover:text-indigo-600' }}">
                <span class="text-2xl">{{ $icon }}</span>
                <span class="font-bold text-sm text-center">{{ $cat->name }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== EVENT TERDEKAT SECTION ===== -->
<section id="events" class="max-w-7xl mx-auto px-6 py-20">

    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
            <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>
        @if(request('category'))
        <a href="{{ url('/') }}" class="text-sm font-bold text-indigo-600 hover:underline">
            Lihat semua →
        </a>
        @endif
    </div>

    <!-- GRID EVENT -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <!-- IMAGE -->
            <div class="relative overflow-hidden aspect-[3/4]">
                @if($event->poster_path)
                    @php
    $posterUrl = str_starts_with($event->poster_path, 'posters/')
        ? asset('storage/' . $event->poster_path)
        : asset('assets/' . basename($event->poster_path));
@endphp
                    <img src="{{ $posterUrl }}"
                         onerror="this.src='https://placehold.co/400x500/6366f1/white?text={{ urlencode($event->title) }}'"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-indigo-400 to-purple-600 flex items-center justify-center">
                        <span class="text-white font-bold text-lg text-center px-4">{{ $event->title }}</span>
                    </div>
                @endif
                <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 rounded-lg text-xs font-bold text-indigo-600">
                    {{ $event->category->name ?? '-' }}
                </div>
            </div>
            <!-- CONTENT -->
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">{{ $event->title }}</h3>
                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}
                </div>
                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    {{ $event->location }}
                </div>
                <div class="flex justify-between items-center pt-4 border-t">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Mulai dari</p>
                        <span class="text-2xl font-black text-indigo-600">
                            Rp {{ number_format($event->price, 0, ',', '.') }}
                        </span>
                    </div>
                    <a href="{{ route('events.show') }}"
                       class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-20 text-center">
            <div class="inline-flex flex-col items-center gap-4 text-slate-400">
                <svg class="w-16 h-16 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-2xl font-bold text-slate-600">Tidak Ada Event</h3>
                <p class="text-slate-500">Event pada kategori ini belum tersedia.</p>
                <a href="{{ url('/') }}" class="mt-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold text-sm hover:bg-indigo-700 transition">
                    Lihat Semua Event
                </a>
            </div>
        </div>
        @endforelse
    </div>

</section>

<!-- ===== PARTNER SECTION (UTS Soal 4) ===== -->
@if($partners->count() > 0)
<section class="bg-slate-50 border-t border-slate-100 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4">
                Dipercaya Oleh
            </span>
            <h2 class="text-3xl font-extrabold mb-3">Partner Kami</h2>
            <p class="text-slate-500 font-medium max-w-md mx-auto">
                Berkolaborasi bersama mitra terpercaya untuk memberikan pengalaman terbaik bagi pengunjung.
            </p>
        </div>

        <!-- GRID LOGO PARTNER -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($partners as $partner)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 p-5 flex flex-col items-center gap-3">
                <div class="w-full h-12 flex items-center justify-center overflow-hidden">
                    <img src="{{ $partner->logo_url }}"
                         alt="{{ $partner->name }}"
                         class="max-w-full max-h-full object-contain"
                         onerror="this.src='https://placehold.co/200x80/e2e8f0/94a3b8?text={{ urlencode($partner->name) }}'">
                </div>
                <p class="text-xs font-bold text-slate-500 text-center">{{ $partner->name }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
