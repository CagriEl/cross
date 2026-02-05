<?php

namespace App\Observers;

use App\Models\Donor;
use App\Services\Matching\MatchEngine;

class DonorObserver
{
    public function created(Donor $donor): void
    {
        app(MatchEngine::class)->syncMatchesForDonor($donor);
    }

    public function updated(Donor $donor): void
    {
        if ($donor->wasChanged(['blood_group', 'rh'])) {
            app(MatchEngine::class)->syncMatchesForDonor($donor);
        }
    }
}
