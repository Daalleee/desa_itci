<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    public function run(): void
    {
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        foreach ($agama as $item) {
            Agama::create(['nama_agama' => $item]);
        }
    }
}
