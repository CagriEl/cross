<?php

namespace App\Services;

use App\Models\Hasta;
use App\Models\Donor;
use App\Models\Cmatch;

class MatchingService
{
    public function checkForHasta($hasta)
{
    // Kan grubu aynı olan donörleri bul
    $donors = \App\Models\Donor::where('kan_grubu', $hasta->kan_grubu)->get();

    foreach ($donors as $donor) {
        \App\Models\Cmatch::firstOrCreate([
            'hasta_id' => $hasta->id,
            'donor_id' => $donor->id,
            'source'   => 'manual',
        ], ['status' => 'pending']);
    }
}

    public function checkForDonor(Donor $donor)
    {
        // Aynı kan grubuna sahip hastaları bul
        $hastalar = Hasta::where('kan_grubu', $donor->kan_grubu)->get();

        foreach ($hastalar as $hasta) {
            $this->createMatch($hasta->id, $donor->id);
        }
    }

    protected function createMatch($hastaId, $donorId)
    {
        Cmatch::firstOrCreate([
            'hasta_id' => $hastaId,
            'donor_id' => $donorId,
        ], [
            'status' => 'pending',
            'source' => 'manual',
        ]);
    }
}