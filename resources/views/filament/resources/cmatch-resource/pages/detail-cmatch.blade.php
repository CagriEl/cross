{{-- File: resources/views/filament/resources/cmatch-resource/pages/detail-cmatch.blade.php --}}
<x-filament::page>
    @php
        $raw = data_get($this->record, 'matched_records');
        $records = is_string($raw)
            ? json_decode($raw, true) ?: []
            : (is_array($raw) ? $raw : []);

        $matches = collect($records)
            ->filter(fn($item) => is_array($item) && isset($item['blood_group'], $item['matched_at']))
            ->map(function(array $item) {
                $matchedAt = \Carbon\Carbon::parse($item['matched_at']);
                return [
                    'blood_group'     => $item['blood_group'],
                    'expiration_date' => $matchedAt->addDays(40),
                    'remaining'       => now()->diff($matchedAt->addDays(40)),
                ];
            });

        $bloodGroups = $matches->pluck('blood_group')->countBy();
    @endphp

    <div class="grid grid-cols-3 gap-4 mb-6">
        <x-filament::card>
            <div class="text-sm text-gray-600">Toplam Eşleşme</div>
            <div class="text-xl font-semibold">{{ $matches->count() }}</div>
        </x-filament::card>
        <x-filament::card>
            <div class="text-sm text-gray-600">Farklı Kan Grupları</div>
            <div class="text-xl font-semibold">{{ $bloodGroups->count() }}</div>
        </x-filament::card>
        <x-filament::card>
            <div class="text-sm text-gray-600">Kan Grupları Dağılımı</div>
            <ul class="mt-2 list-disc list-inside">
                @foreach($bloodGroups as $group => $count)
                    <li>{{ $group }}: {{ $count }}</li>
                @endforeach
            </ul>
        </x-filament::card>
    </div>

    <table class="filament-tables-table w-full">
        <thead>
            <tr>
                <th>Kan Grubu</th>
                <th>Son Kullanma Tarihi</th>
                <th>Kalan Gün</th>
                <th>Kalan Saat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matches as $m)
                <tr>
                    <td>{{ $m['blood_group'] }}</td>
                    <td>{{ $m['expiration_date']->format('d M Y H:i') }}</td>
                    <td>{{ $m['remaining']->d }}</td>
                    <td>{{ $m['remaining']->h }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-4">Eşleşme bulunamadı.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-filament::page>
