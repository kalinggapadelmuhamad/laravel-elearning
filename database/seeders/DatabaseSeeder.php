<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        function generateCodeMapel($name)
        {
            $length = strlen($name);

            if ($length < 3) {
                $code = strtoupper($name);
            } else {
                $code = strtoupper(substr($name, 0, 1) . substr($name, floor($length / 2), 1) . substr($name, -1));
            }

            return $code;
        }

        DB::table('users')->insert([
            [
                'name' => fake()->name(),
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                'role' => fake()->randomElement(['admin', 'user']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => fake()->name(),
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('user'),
                'role' => fake()->randomElement(['admin', 'user']),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('mapels')->insert([
            [
                'name' => fake()->name(),
                'code' => generateCodeMapel('Sejarahmanusia'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => fake()->name(),
                'code' => generateCodeMapel('SejarahPerangDunia||'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('materis')->insert([
            [
                'mapel_id' => '1',
                'materi' => 'Materi 1',
                'semester' => '1',
                'pertemuan' => '1',
                'link_youtube' => 'https://youtu.be/-S93Zu5om60',
                'file_materi' => "materi.pdf",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'mapel_id' => '1',
                'materi' => 'Materi 2',
                'semester' => '1',
                'pertemuan' => '2',
                'link_youtube' => 'https://youtu.be/-S93Zu5om60',
                'file_materi' => "materi.pdf",
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
