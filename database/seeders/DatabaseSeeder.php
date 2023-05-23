<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([BrandSeeder::class, ColorSeeder::class, CountrySeeder::class, SeasonSeeder::class, SizeSeeder::class]);
    }
}
