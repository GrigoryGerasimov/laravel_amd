<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

final class SizeSeeder extends Seeder
{
    public function run(): void
    {
        $xs = Size::create([
            'code' => 'XS'
        ]);

        $s = Size::create([
            'code' => 'S'
        ]);

        $m = Size::create([
            'code' => 'M'
        ]);

        $l = Size::create([
            'code' => 'L'
        ]);

        $xl = Size::create([
            'code' => 'XL'
        ]);

        $xxl = Size::create([
            'code' => 'XXL'
        ]);

        $xxxl = Size::create([
            'code' => '3XL'
        ]);

        $xxxxl = Size::create([
            'code' => '4XL'
        ]);

        $xxxxxl = Size::create([
            'code' => '5XL'
        ]);

        $plus44 = Size::create([
            'code' => '44'
        ]);

        $plus46 = Size::create([
            'code' => '46'
        ]);

        $plus48 = Size::create([
            'code' => '48'
        ]);

        $plus50 = Size::create([
            'code' => '50'
        ]);
    }
}
