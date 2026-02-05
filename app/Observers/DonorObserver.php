<?php

namespace App\Observers;
use App\Models\Donor;
use App\Services\MatchingService;

class DonorObserver {
    public function created(Donor $donor) {
        (new MatchingService())->checkForDonor($donor);
    }
}