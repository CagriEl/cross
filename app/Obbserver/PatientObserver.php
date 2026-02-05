<?php

namespace App\Observers;

use App\Models\Patient;
use App\Services\Matching\MatchEngine;

class PatientObserver
{
    public function created(Patient $patient): void
    {
        app(MatchEngine::class)->syncMatchesForPatient($patient);
    }

    public function updated(Patient $patient): void
    {
        // kan grubu veya rh değiştiyse tekrar eşleştir
        if ($patient->wasChanged(['blood_group', 'rh'])) {
            app(MatchEngine::class)->syncMatchesForPatient($patient);
        }
    }
}
