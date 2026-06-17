<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AgamaSeeder::class,
            PendidikanSeeder::class,
            PekerjaanSeeder::class,
            WilayahSeeder::class,
            JenisSuratSeeder::class,
        ]);

        $this->call(RolePermissionSeeder::class);
        $this->call(KeluargaSeeder::class);

        $admin = User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa-itci.id',
        ]);
        $admin->assignRole('admin');

        $operator = User::factory()->create([
            'name' => 'Operator CMS',
            'email' => 'operator@desa-itci.id',
        ]);
        $operator->assignRole('operator_cms');
    }
}
