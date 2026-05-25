<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $category1 = \App\Models\Category::firstOrCreate(['name' => 'Seminar IT'],            ['slug' => 'seminar-it']);
        $category2 = \App\Models\Category::firstOrCreate(['name' => 'Entertainment'],         ['slug' => 'entertainment']);
        $category3 = \App\Models\Category::firstOrCreate(['name' => 'Education & Workshop'],  ['slug' => 'education-workshop']);
        $category4 = \App\Models\Category::firstOrCreate(['name' => 'Competition & Esports'], ['slug' => 'competition-esports']);
        $category5 = \App\Models\Category::firstOrCreate(['name' => 'Lifestyle & Community'], ['slug' => 'lifestyle-community']);

        \App\Models\Event::create([
            'category_id' => $category2->id,
            'title'       => 'Jazz Night 2025',
            'description' => 'Nikmati malam yang indah dengan alunan musik jazz yang merdu.',
            'date'        => '2026-05-10 19:00:00',
            'location'    => 'Amikom Baru',
            'price'       => 50000,
            'stock'       => 100,
            'poster_path' => 'https://picsum.photos/seed/jazz/400/500',
        ]);

        \App\Models\Event::create([
            'category_id' => $category1->id,
            'title'       => 'Hackathon - Unleash Your Inner Developer',
            'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!',
            'date'        => '2026-05-05 10:00:00',
            'location'    => 'Inkubator Amikom',
            'price'       => 50000,
            'stock'       => 100,
            'poster_path' => 'https://picsum.photos/seed/hack/400/500',
        ]);

        \App\Models\Event::create([
            'category_id' => $category1->id,
            'title'       => 'AI & Future Tech Summit 2026',
            'description' => 'Jelajahi tren terkini dalam kecerdasan buatan dan teknologi masa depan.',
            'date'        => '2026-05-01 13:00:00',
            'location'    => 'Cinema Unit 6',
            'price'       => 50000,
            'stock'       => 100,
            'poster_path' => 'https://picsum.photos/seed/ai/400/500',
        ]);

        \App\Models\Event::create([
            'category_id' => $category4->id,
            'title'       => 'E-Sport U-Champ 2026',
            'description' => 'Turnamen esports antar kampus untuk mencari tim terbaik.',
            'date'        => '2026-05-15 09:00:00',
            'location'    => 'Sport Center Amikom',
            'price'       => 25000,
            'stock'       => 200,
            'poster_path' => 'https://picsum.photos/seed/esport/400/500',
        ]);

        \App\Models\Event::create([
            'category_id' => $category3->id,
            'title'       => 'UI/UX Masterclass: Design Thinking',
            'description' => 'Belajar UI/UX modern langsung dari praktisi industri.',
            'date'        => '2026-05-12 13:00:00',
            'location'    => 'Design Lab Amikom',
            'price'       => 75000,
            'stock'       => 80,
            'poster_path' => 'https://picsum.photos/seed/uiux/400/500',
        ]);

        \App\Models\Event::create([
            'category_id' => $category5->id,
            'title'       => 'Campus Music & Art Festival',
            'description' => 'Festival musik, seni, dan kreativitas mahasiswa.',
            'date'        => '2026-05-20 18:00:00',
            'location'    => 'Outdoor Stage Amikom',
            'price'       => 60000,
            'stock'       => 300,
            'poster_path' => 'https://picsum.photos/seed/music/400/500',
        ]);

        $this->call(PartnerSeeder::class);
    }
}