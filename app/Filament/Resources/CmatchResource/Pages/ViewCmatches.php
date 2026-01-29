<?php

namespace App\Filament\Resources\CmatchResource\Pages;

use App\Filament\Resources\CmatchResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCmatch extends ViewRecord
{
    protected static string $resource = CmatchResource::class;
    protected static string $view     = 'filament.resources.cmatch-resource.pages.view-cmatch';

    // Kullanılacak adetleri burada tutuyoruz
    public array $usageAmounts = [];

    public function mount($record): void
    {
        parent::mount($record);

        // Her blood_group için başlangıçta 1
        foreach ($this->record->matched_records as $item) {
            $this->usageAmounts[$item['blood_group']] = 1;
        }
    }

    public function useBlood(string $group): void
    {
        $records = $this->record->matched_records;
        $amount  = (int) ($this->usageAmounts[$group] ?? 1);

        // Geçersiz kullanım: 1’den küçük veya stoktan büyükse abort
        foreach ($records as $item) {
            if ($item['blood_group'] === $group) {
                if ($amount < 1 || $amount > $item['stock_count']) {
                    $this->dispatchBrowserEvent('notification', [
                        'type'    => 'danger',
                        'message' => 'Geçersiz adet! Stok sınırı aşılamaz.',
                    ]);
                    return;
                }
                break;
            }
        }

        // Stoktan düşme
        foreach ($records as &$item) {
            if ($item['blood_group'] === $group) {
                $item['stock_count'] -= $amount;
                break;
            }
        }
        unset($item);

        // Kaydet ve tekrar yükle
        $this->record->update(['matched_records' => $records]);
        $this->record->refresh();
    }
}
