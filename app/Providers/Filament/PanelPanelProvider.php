<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;

class PanelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('panel')
            ->path('panel')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }


public function boot()
{
    Filament::serving(function () {
        // Kullanıcının yetkilerine göre modülleri göstermek için
        Filament::registerNavigationGroups($this->getNavigationGroups());
    });
}
protected function getNavigationGroups(): array
{
    $groups = [];

    // Kullanıcı oturumunu kontrol edin
    if (auth()->check()) {
        $user = auth()->user();

        if ($user->hasPermission('cihaz_ekleme')) {
            $groups[] = NavigationGroup::make()
                ->label('Cihaz Yönetimi')
                ->items([
                    \App\Filament\Resources\CihazResource::class,
                ]);
        }

        // Diğer modüller için kontroller
        if ($user->hasPermission('hastane_ekleme')) {
            $groups[] = NavigationGroup::make()
                ->label('Hastane Yönetimi')
                ->items([
                    \App\Filament\Resources\HastaneResource::class,
                ]);
        }
    }

    return $groups;
}

}
