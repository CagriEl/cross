<?php

namespace App\Providers;

use Filament\Navigation\NavigationGroup;
use Illuminate\Support\Facades\Auth;
use Filament\PluginServiceProvider;

class FilamentServiceProvider extends PluginServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->app['filament']->registerNavigationGroups(function () {
            $user = Auth::user();
            $groups = [];

            if ($user->hasPermission('cihaz_ekleme')) {
                $groups[] = NavigationGroup::make()
                    ->label('Cihaz Yönetimi')
                    ->items([\App\Filament\Resources\CihazResource::class]);
            }

            if ($user->hasPermission('hastane_ekleme')) {
                $groups[] = NavigationGroup::make()
                    ->label('Hastane Yönetimi')
                    ->items([\App\Filament\Resources\HastaneResource::class]);
            }

            if ($user->hasPermission('kart_ekleme')) {
                $groups[] = NavigationGroup::make()
                    ->label('Kart Yönetimi')
                    ->items([\App\Filament\Resources\KartResource::class]);
            }

            if ($user->hasPermission('sonuc_ekleme')) {
                $groups[] = NavigationGroup::make()
                    ->label('Sonuç Yönetimi')
                    ->items([\App\Filament\Resources\SonucResource::class]);
            }

            if ($user->hasPermission('test_ekleme')) {
                $groups[] = NavigationGroup::make()
                    ->label('Test Yönetimi')
                    ->items([\App\Filament\Resources\TestResource::class]);
            }

            if ($user->hasPermission('kullanici_ekleme')) {
                $groups[] = NavigationGroup::make()
                    ->label('Kullanıcı Yönetimi')
                    ->items([\App\Filament\Resources\UserResource::class]);
            }

            return $groups;
        });
    }
    protected function registerMiddleware(): void
{
    $this->app['router']->aliasMiddleware('check.permission', \App\Http\Middleware\CheckUserPermission::class);
}

}
