<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KullaniciIzinleri; // Model adınızı kontrol edin

class KullaniciIzinleriSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['rol_adi' => 'Admin', 'kullanici_ekleme_yetkisi' => true, 'veri_duzenleme_yetkisi' => true],
            ['rol_adi' => 'Doktor', 'kullanici_ekleme_yetkisi' => false, 'veri_duzenleme_yetkisi' => false],
            ['rol_adi' => 'Baş Teknisyen', 'kullanici_ekleme_yetkisi' => true, 'veri_duzenleme_yetkisi' => true],
            ['rol_adi' => 'Teknisyen', 'kullanici_ekleme_yetkisi' => false, 'veri_duzenleme_yetkisi' => false],
        ];

        foreach ($roles as $role) {
            KullaniciIzinleri::create($role);
        }
    }
}
