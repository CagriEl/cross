<?php

namespace App\Filament\Resources\CmatchResource\Pages;

use App\Filament\Resources\CmatchResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Carbon\Carbon;

class CreateCmatch extends CreateRecord
{
    protected static string $resource = CmatchResource::class;

    /**
     * Kayıt oluşturulduktan sonra tetiklenir.
     */
    protected function afterCreate(): void
    {
        $record = $this->record;
        $disk = Storage::disk('local');

        $key1 = $record->file_1;
        $key2 = $record->file_2;

        if (! $disk->exists($key1) || ! $disk->exists($key2)) {
            return;
        }

        $path1 = $disk->path($key1);
        $path2 = $disk->path($key2);

        $groups1 = $this->readGroups($path1);
        $groups2 = $this->readGroups($path2);

        if (empty($groups1) || empty($groups2)) {
            return;
        }

        $counts1 = array_count_values($groups1);
        $counts2 = array_count_values($groups2);
        $common = array_intersect(array_keys($counts1), array_keys($counts2));

        $matches = [];
        foreach ($common as $group) {
            $stock = min($counts1[$group], $counts2[$group]);
            $matches[] = [
                'blood_group'     => $group,
                'stock_count'     => $stock,
                'expiration_date' => Carbon::now()->addDays(40)->toDateTimeString(),
            ];
        }

        $record->update([
            'matched_records' => $matches,
        ]);
    }

    /**
     * Excel dosyasındaki "Kan Grubu" sütununu bulur ve değerlerini döner.
     */
    protected function readGroups(string $path): array
    {
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        // 1. satır: header
        $highestColumn = $sheet->getHighestColumn();
        $headerRow = $sheet->rangeToArray('A1:' . $highestColumn . '1')[0];

        $colIndex = null;
        foreach ($headerRow as $i => $value) {
            if (stripos(str_replace(' ', '', (string) $value), 'kangrubu') !== false) {
                $colIndex = $i;
                break;
            }
        }

        if ($colIndex === null) {
            return [];
        }

        $highestRow = $sheet->getHighestRow();
        $groups = [];
        for ($row = 2; $row <= $highestRow; $row++) {
            $columnLetter = Coordinate::stringFromColumnIndex($colIndex + 1);
            $coordinate = $columnLetter . $row;
            $cell = $sheet->getCell($coordinate);
            $value = trim((string) $cell->getValue());
            if ($value !== '') {
                $groups[] = $value;
            }
        }

        return $groups;
    }
}
