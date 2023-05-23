<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

final class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $china = Country::create([
            'iso_code' => 'CN'
        ]);

        $turkey = Country::create([
            'iso_code' => 'TR'
        ]);
    }
}
