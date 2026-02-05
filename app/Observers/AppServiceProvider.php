<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Modellerinizi içeri aktarın
use App\Models\Hasta;
use App\Models\Donor;
// Observer'larınızı içeri aktarın
use App\Observers\HastaObserver;
use App\Observers\DonorObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * Observer kayıtları burada yapılır.
     */
    public function boot(): void
    {
        // Hasta modeli oluşturulduğunda veya güncellendiğinde HastaObserver'ı tetikle
        Hasta::observe(HastaObserver::class);

        // Donor modeli oluşturulduğunda veya güncellendiğinde DonorObserver'ı tetikle
        Donor::observe(DonorObserver::class);
    }
}