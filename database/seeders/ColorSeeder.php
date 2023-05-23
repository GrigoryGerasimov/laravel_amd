<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

final class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $aqua = Color::create([
            'code' => '2035',
            'name' => 'AQUA'
        ]);

        $black = Color::create([
            'code' => '1010',
            'name' => 'BLACK'
        ]);

        $darkGreen = Color::create([
            'code' => '5021',
            'name' => 'DARK GREEN'
        ]);

        $dustyPink = Color::create([
            'code' => '4061',
            'name' => 'DUSTY PINK'
        ]);

        $green = Color::create([
            'code' => '5023',
            'name' => 'GREEN'
        ]);

        $indigoBlue = Color::create([
            'code' => '2014',
            'name' => 'INDIGO BLUE'
        ]);

        $lightBlue = Color::create([
            'code' => '2042',
            'name' => 'LIGHT BLUE'
        ]);

        $lightGreen = Color::create([
            'code' => '5041',
            'name' => 'LIGHT GREEN'
        ]);

        $lightGrey = Color::create([
            'code' => '3003',
            'name' => 'LIGHT GREY'
        ]);

        $mint = Color::create([
            'code' => '5044',
            'name' => 'MINT'
        ]);

        $navy = Color::create([
            'code' => '2028',
            'name' => 'NAVY'
        ]);

        $nightBlue = Color::create([
            'code' => '2022',
            'name' => 'NIGHT BLUE'
        ]);

        $olive = Color::create([
            'code' => '5031',
            'name' => 'OLIVE'
        ]);

        $red = Color::create([
            'code' => '4000',
            'name' => 'RED'
        ]);

        $rose = Color::create([
            'code' => '4041',
            'name' => 'ROSE'
        ]);

        $stoneBlue = Color::create([
            'code' => '2026',
            'name' => 'STONE BLUE'
        ]);

        $white = Color::create([
            'code' => '7000',
            'name' => 'WHITE'
        ]);
    }
}
