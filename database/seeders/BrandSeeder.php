<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

final class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $core = Brand::create([
            'code' => 'R59'
        ]);

        $plus = Brand::create([
            'code' => 'RAC'
        ]);
    }
}
