<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['rt' => '001', 'rw' => '001'],
            ['rt' => '002', 'rw' => '001'],
            ['rt' => '003', 'rw' => '001'],
            ['rt' => '004', 'rw' => '001'],
            ['rt' => '005', 'rw' => '001'],
        ];

        foreach ($data as $item) {
            Wilayah::create($item);
        }
    }
}
