<?php

namespace App\Observers;
use App\Models\Hasta;
use App\Services\MatchingService;

class HastaObserver {
    public function created(Hasta $hasta) {
        (new MatchingService())->checkForHasta($hasta);
    }
}