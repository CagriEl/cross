<?php

use App\Models\Patient;
use App\Models\Donor;
use App\Observers\PatientObserver;
use App\Observers\DonorObserver;

public function boot(): void
{
    Patient::observe(PatientObserver::class);
    Donor::observe(DonorObserver::class);
}
