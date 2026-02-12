<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@animaproperty.id',
                'email_verified_at' => '2025-08-05 13:28:29',
                'password' => '$2y$12$532W4jHf3dmOkyUX85joKOIIsNeC3ucRq82kERtzaD/67uO4JFIpy',
                'remember_token' => 'waUFX5Oz2tUoWVxDUVXi3Gul7uCrBR0RObVOoMue3xQNa5ULqFab8huaRdik',
                'created_at' => '2025-08-05 13:28:30',
                'updated_at' => '2025-08-18 11:11:48',
            ],
            [
                'id' => 2,
                'name' => 'Anima Info',
                'email' => 'info@animaproperty.id',
                'email_verified_at' => null,
                'password' => '$2y$12$LKPPtSmI7ISkKkGJ8tIs7eAUzw8y8IdfpkNcJPgGsME42yyNBKgji',
                'remember_token' => null,
                'created_at' => '2025-08-05 13:29:04',
                'updated_at' => '2025-08-05 13:29:04',
            ],
            [
                'id' => 3,
                'name' => 'Wicom Test',
                'email' => 'wicom@animaproperty.id',
                'email_verified_at' => null,
                'password' => '$2y$12$MelP2XB09UohyZE0Jur4kO7CCUegWhbzbLzr0i.0SfQ3JRw8dS/am',
                'remember_token' => null,
                'created_at' => '2025-08-05 13:58:03',
                'updated_at' => '2025-08-05 13:58:03',
            ],
            [
                'id' => 4,
                'name' => 'Info Saja',
                'email' => 'test@animaproperty.id',
                'email_verified_at' => null,
                'password' => '$2y$12$Yz9vj2dG6u5C83lHhAv6a.Y0nkIZOR18zRRhEvsh0xIxzYvLFkT3y',
                'remember_token' => null,
                'created_at' => '2025-08-05 14:15:41',
                'updated_at' => '2025-08-05 14:15:41',
            ],
            [
                'id' => 6,
                'name' => 'Admin Penjualan',
                'email' => 'adminpenj@animaproperty.id',
                'email_verified_at' => null,
                'password' => '$2y$12$RiFUHK6vZ1lJT2KEfXp1oeghTFnrJxYN/9uLRL8Z12fV7.i2.c77q',
                'remember_token' => null,
                'created_at' => '2025-08-06 14:45:30',
                'updated_at' => '2025-08-06 14:47:17',
            ],
            [
                'id' => 7,
                'name' => 'beatris',
                'email' => 'btrsresti@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$nY6qs/ovT25D6xCga6qLyeS6I5.FgsajKgmgqiFZJMqDdU9Md0wwK',
                'remember_token' => null,
                'created_at' => '2025-08-26 13:21:33',
                'updated_at' => '2025-08-26 13:29:39',
            ],
        ]);
    }
}
