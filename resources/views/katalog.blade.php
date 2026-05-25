<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Event</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-10 shadow-lg">
        <div class="max-w-7xl mx-auto px-6">

            <h1 class="text-4xl font-bold text-white">
                {{ $category->name ?? 'Semua Event' }}
            </h1>

            <p class="text-indigo-100 mt-2 text-lg">
                Temukan event terbaik sesuai kategori pilihanmu
            </p>

        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-6 py-10">

        @if(isset($events) && $events->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($events as $event)

                    <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300">

                        <!-- Image -->
                        <div class="relative">

                            @if($event->poster_path)

                                <img
                                    src="{{ asset('storage/' . $event->poster_path) }}"
                                    alt="{{ $event->title }}"
                                    class="w-full h-[350px] object-cover"
                                >

                            @else

                                <div class="w-full h-[350px] bg-gray-300 flex items-center justify-center text-gray-500 text-xl">
                                    No Image
                                </div>

                            @endif

                            <!-- Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-white text-indigo-600 text-xs font-bold px-4 py-2 rounded-full shadow">
                                    {{ $category->name ?? 'Event' }}
                                </span>
                            </div>

                        </div>

                        <!-- Body -->
                        <div class="p-6">

                            <h2 class="text-2xl font-bold text-gray-800 mb-3">
                                {{ $event->title }}
                            </h2>

                            <p class="text-gray-600 text-sm leading-relaxed mb-5">
                                {{ $event->description }}
                            </p>

                            <div class="space-y-2 text-sm text-gray-500">

                                <p>
                                    📅 
                                    {{ \Carbon\Carbon::parse($event->date)->format('d M Y - H:i') }}
                                </p>

                                <p>
                                    📍 {{ $event->location }}
                                </p>

                                <p>
                                    🎟️ Stock: {{ $event->stock }}
                                </p>

                            </div>

                            <!-- Footer -->
                            <div class="flex items-center justify-between mt-6">

                                <div>

                                    <p class="text-xs text-gray-500">
                                        Harga
                                    </p>

                                    <p class="text-3xl font-bold text-indigo-600">
                                        Rp {{ number_format($event->price, 0, ',', '.') }}
                                    </p>

                                </div>

                                <a href="{{ route('events.show') }}"
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-2xl transition">
                                    Lihat Detail
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-3xl p-12 shadow text-center">

                <h2 class="text-3xl font-bold text-gray-700">
                    Tidak Ada Event
                </h2>

                <p class="text-gray-500 mt-3 text-lg">
                    Event untuk kategori ini belum tersedia.
                </p>

            </div>

        @endif

    </div>

</body>
</html>