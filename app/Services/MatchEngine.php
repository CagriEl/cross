<?php

namespace App\Services\Matching;

use App\Models\CmatchMatch;
use App\Models\Patient;
use App\Models\Donor;

class MatchEngine
{
    public function syncMatchesForPatient(Patient $patient, int $limit = 2000): void
    {
        if (empty($patient->blood_group)) return; // boşsa çık

        $donors = Donor::query()
            ->whereIn('blood_group', $this->compatibleAboDonors($patient->blood_group))
            ->when(($patient->rh ?? null) === '-', fn ($q) => $q->where('rh', '-'))
            ->limit($limit)
            ->get(['id', 'blood_group', 'rh']);

        foreach ($donors as $donor) {
            CmatchMatch::updateOrCreate(
                ['patient_id' => $patient->id, 'donor_id' => $donor->id],
                [
                    'blood_compatible' => true,
                    'match_score' => 100,
                    'matched_tests' => [
                        'blood_group' => [
                            'patient' => ($patient->blood_group ?? null) . ($patient->rh ?? ''),
                            'donor'   => ($donor->blood_group ?? null) . ($donor->rh ?? ''),
                            'ok' => true,
                        ],
                    ],
                ]
            );
        }
    }

    public function syncMatchesForDonor(Donor $donor, int $limit = 2000): void
    {
        if (empty($donor->blood_group)) return;

        $patients = Patient::query()
            ->whereIn('blood_group', $this->compatibleAboPatients($donor->blood_group))
            ->limit($limit)
            ->get(['id', 'blood_group', 'rh']);

        foreach ($patients as $patient) {
            // Hasta Rh- ise donör Rh- olmalı
            if (($patient->rh ?? null) === '-' && ($donor->rh ?? null) !== '-') {
                continue;
            }

            CmatchMatch::updateOrCreate(
                ['patient_id' => $patient->id, 'donor_id' => $donor->id],
                [
                    'blood_compatible' => true,
                    'match_score' => 100,
                    'matched_tests' => [
                        'blood_group' => [
                            'patient' => ($patient->blood_group ?? null) . ($patient->rh ?? ''),
                            'donor'   => ($donor->blood_group ?? null) . ($donor->rh ?? ''),
                            'ok' => true,
                        ],
                    ],
                ]
            );
        }
    }

    private function compatibleAboDonors(string $patientAbo): array
    {
        $abo = strtoupper(trim($patientAbo));
        return match ($abo) {
            'O', '0' => ['O','0'],
            'A'      => ['A', 'O','0'],
            'B'      => ['B', 'O','0'],
            'AB'     => ['A','B','AB','O','0'],
            default  => [],
        };
    }

    private function compatibleAboPatients(string $donorAbo): array
    {
        $abo = strtoupper(trim($donorAbo));
        return match ($abo) {
            'O', '0' => ['O','0','A','B','AB'],
            'A'      => ['A','AB'],
            'B'      => ['B','AB'],
            'AB'     => ['AB'],
            default  => [],
        };
    }
}
