<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::updateOrCreate(
            ['nip' => '1234567890'],
            [
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'unit' => 'staf',
                'foto' => '',
            ]
        );
        // User::updateOrCreate(
        //     ['nip' => '0987654321'],
        //     [
        //         'uuid' => Uuid::uuid4()->toString(),
        //         'name' => 'wahyu',
        //         'email' => 'wahyu@gmail.com',
        //         'password' => Hash::make('wahyu'),
        //         'role' => 'guru',
        //         'unit' => 'staf',
        //         'foto' => '',
        //     ]
        // );
        User::updateOrCreate(
            ['nip' => '0987654321'],
            [
                'uuid' => Uuid::uuid4()->toString(),
                'name' => 'Kepala Sekolah',
                'email' => 'kepsek@gmail.com',
                'password' => Hash::make('kepsek'),
                'role' => 'kepsek',
                'unit' => 'kepsek',
                'foto' => '',
            ]
        );
    }
}
