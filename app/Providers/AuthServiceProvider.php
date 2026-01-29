<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Model => Policy eşlemesi
        \App\Models\KullaniciIzinleri::class => \App\Policies\RolePolicy::class,
        \App\Models\Cihaz::class => \App\Policies\CihazPolicy::class,
        \App\Models\Hastane::class => \App\Policies\HastanePolicy::class,
        \App\Models\Kart::class => \App\Policies\KartPolicy::class,
        \App\Models\Sonuc::class => \App\Policies\SonucPolicy::class,
        \App\Models\Test::class => \App\Policies\TestPolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Ek Gate tanımları yapabilirsiniz
    }
    
}
