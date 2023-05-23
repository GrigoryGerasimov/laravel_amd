<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Seeder;

final class SeasonSeeder extends Seeder
{
    public function run(): void
    {
        $hw23e = Season::create([
            'code' => '234'
        ]);
    }
}
