<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;        // ← Bunu ekleyin
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // 1) Admin kullanıcısı
        $admin = User::create([
            'name'              => 'Admin Kullanıcı',
            'email'             => 'admin@example.com',
            'password'          => bcrypt('123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
            'role_id'           => 1,
        ]);

        // 2) Yetki tablosuna Admin izinleri
        DB::table('kullanici_izinleri')->insert([
            'rol_adi'          => 'Admin',
            'cihaz_ekleme'     => 1,
            'hastane_ekleme'   => 1,
            'kart_ekleme'      => 1,
            'sonuc_ekleme'     => 1,
            'test_ekleme'      => 1,
            'kullanici_ekleme' => 1,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }
}
