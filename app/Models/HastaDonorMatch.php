<?php

namespace App\Services;

use App\Models\Hasta;
use App\Models\Donor;
use App\Models\HastaDonorMatch;

class HastaDonorMatchService
{
    public function matchHasta(int $hastaId): int
    {
        $hasta = Hasta::query()->findOrFail($hastaId);

        // sadece hasta kayıtları eşleşsin
        if (($hasta->kayit_tipi ?? 'hasta') !== 'hasta') {
            return 0;
        }

        // 1) KAN GRUBU (zorunlu)
        $donors = Donor::query()
            ->where('kan_grubu', $hasta->kan_grubu)
            ->when(\Schema::hasColumn('donors', 'son_kullanma_tarihi'), fn ($q) =>
                $q->whereDate('son_kullanma_tarihi', '>=', now())
            )
            ->get();

        $created = 0;

        foreach ($donors as $donor) {
            // 2) DİĞER TESTLER (puanlama / eşleşme)
            // Şimdilik testleri JSON kabul ediyorum (aşağıdaki alan adlarını projene göre bağlarız)
            $hastaTests = is_array($hasta->test_sonuclari ?? null)
                ? $hasta->test_sonuclari
                : json_decode($hasta->test_sonuclari ?? '[]', true);

            $donorTests = is_array($donor->test_sonuclari ?? null)
                ? $donor->test_sonuclari
                : json_decode($donor->test_sonuclari ?? '[]', true);

            [$score, $matchedTests, $missingTests] = $this->compareTests($hastaTests, $donorTests);

            HastaDonorMatch::updateOrCreate(
                [
                    'hasta_id' => $hasta->id,
                    'donor_id' => $donor->id,
                ],
                [
                    'kan_grubu'      => $hasta->kan_grubu,
                    'match_score'    => $score,
                    'matched_tests'  => $matchedTests,
                    'missing_tests'  => $missingTests,
                    'status'         => 'pending',
                ]
            );

            $created++;
        }

        return $created;
    }

    private function compareTests(array $hastaTests, array $donorTests): array
    {
        $keys = array_values(array_unique(array_merge(array_keys($hastaTests), array_keys($donorTests))));

        if (count($keys) === 0) {
            return [0, [], []];
        }

        $hit = 0;
        $matched = [];
        $missing = [];

        foreach ($keys as $k) {
            $hv = $hastaTests[$k] ?? null;
            $dv = $donorTests[$k] ?? null;

            if ($hv !== null && $dv !== null && (string) $hv === (string) $dv) {
                $matched[$k] = $hv;
                $hit++;
            } else {
                $missing[$k] = ['hasta' => $hv, 'donor' => $dv];
            }
        }

        $score = (int) round(($hit / count($keys)) * 100);

        return [$score, $matched, $missing];
    }
}
