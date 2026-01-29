<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KullaniciIzinleri;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'rol_adi' => 'Admin',
                'cihaz_ekleme' => true,
                'hastane_ekleme' => true,
                'kart_ekleme' => true,
                'sonuc_ekleme' => true,
                'test_ekleme' => true,
                'kullanici_ekleme' => true,
            ],
            [
                'rol_adi' => 'Doktor',
                'cihaz_ekleme' => false,
                'hastane_ekleme' => false,
                'kart_ekleme' => true,
                'sonuc_ekleme' => true,
                'test_ekleme' => true,
                'kullanici_ekleme' => false,
            ],
            [
                'rol_adi' => 'Baş Teknisyen',
                'cihaz_ekleme' => false,
                'hastane_ekleme' => false,
                'kart_ekleme' => false,
                'sonuc_ekleme' => true,
                'test_ekleme' => true,
                'kullanici_ekleme' => false,
            ],
            [
                'rol_adi' => 'Teknisyen',
                'cihaz_ekleme' => false,
                'hastane_ekleme' => false,
                'kart_ekleme' => false,
                'sonuc_ekleme' => true,
                'test_ekleme' => true,
                'kullanici_ekleme' => false,
            ],
        ];

        foreach ($roles as $role) {
            KullaniciIzinleri::updateOrCreate(['rol_adi' => $role['rol_adi']], $role);
        }
    }
}
