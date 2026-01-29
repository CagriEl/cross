<?php


namespace App\Filament\Resources\CmatchResource\Pages;

use App\Filament\Resources\CmatchResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EditCmatch extends EditRecord
{
    protected static string $resource = CmatchResource::class;

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('file_1')
                ->label('1. Excel Dosyası')
                ->directory('cmatches')
                ->storeFileNamesIn('file_1_name')
                ->preserveFilenames()
                ->deleteUploadedFile(),

            FileUpload::make('file_2')
                ->label('2. Excel Dosyası')
                ->directory('cmatches')
                ->storeFileNamesIn('file_2_name')
                ->preserveFilenames()
                ->deleteUploadedFile(),
        ];
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        if (! $record->file_1 || ! $record->file_2) {
            return;
        }

        $data1 = $this->readExcel(Storage::path($record->file_1));
        $data2 = $this->readExcel(Storage::path($record->file_2));
        $matched = array_values(array_intersect($data1, $data2));

        $record->matched_records = json_encode($matched, JSON_UNESCAPED_UNICODE);
        $record->save();
    }

    private function readExcel(string $path): array
    {
        $sheet = IOFactory::load($path)->getActiveSheet();
        $out   = [];
        foreach ($sheet->getRowIterator() as $i => $row) {
            if ($i === 1) continue;
            $cells = iterator_to_array($row->getCellIterator());
            $vals  = array_map(fn($c) => trim((string)$c->getValue()), $cells);
            if (count($vals) >= 2) {
                $out[] = $vals[0] . ' ' . $vals[1];
            }
        }
        return $out;
    }
}



