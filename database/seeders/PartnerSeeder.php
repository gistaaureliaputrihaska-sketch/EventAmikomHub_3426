<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use Faker\Factory as Faker;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $partners = [
            ['name' => 'Midtrans',   'logo_url' => 'https://placehold.co/200x80/00a8e8/white?text=Midtrans'],
            ['name' => 'Tokopedia',  'logo_url' => 'https://placehold.co/200x80/42b549/white?text=Tokopedia'],
            ['name' => 'Bank BCA',   'logo_url' => 'https://placehold.co/200x80/005baa/white?text=BCA'],
            ['name' => 'Telkomsel',  'logo_url' => 'https://placehold.co/200x80/e4032e/white?text=Telkomsel'],
            ['name' => 'Gojek',      'logo_url' => 'https://placehold.co/200x80/00aa13/white?text=Gojek'],
            ['name' => 'GrabFood',   'logo_url' => 'https://placehold.co/200x80/00b14f/white?text=Grab'],
            ['name' => 'OVO',        'logo_url' => 'https://placehold.co/200x80/4c3494/white?text=OVO'],
            ['name' => 'Traveloka',  'logo_url' => 'https://placehold.co/200x80/0066cc/white?text=Traveloka'],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }

        // Tambahan dummy dengan Faker
        for ($i = 0; $i < 3; $i++) {
            $colorHex = ltrim($faker->hexColor, '#');
            Partner::create([
                'name'     => $faker->company,
                'logo_url' => 'https://placehold.co/200x80/' . $colorHex . '/white?text=Partner',
            ]);
        }
    }
}
