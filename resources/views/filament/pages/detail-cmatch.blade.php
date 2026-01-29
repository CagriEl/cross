<x-filament::page>
    <h2 class="text-2xl font-bold mb-4">Eşleşme Detayı</h2>

    @php
        // JSON olarak saklanan matched_records içeriğini diziye alalım
        $matches = collect(json_decode($record->matched_records ?? '[]', true))
            ->map(function($item) {
                $matchedAt   = \Carbon\Carbon::parse($item['matched_at']);
                $expiration  = $matchedAt->addDays(40);
                $remaining   = now()->diff($expiration);
                return [
                    'blood_group'     => $item['blood_group'],
                    'expiration_date' => $expiration->format('d M Y H:i'),
                    'remaining_days'  => $remaining->d,
                    'remaining_hours' => $remaining->h,
                ];
            });

        // Kan grubu dağılımı
        $bloodGroups = $matches->pluck('blood_group')->countBy();
    @endphp

    {{-- Toplam ve dağılım kartları --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <x-filament::card>
            <span>Toplam Eşleşme</span>
            <div class="text-xl font-semibold">{{ $matches->count() }}</div>
        </x-filament::card>
        <x-filament::card>
            <span>Farklı Kan Grupları</span>
            <div class="text-xl font-semibold">{{ $bloodGroups->count() }}</div>
        </x-filament::card>
        <x-filament::card>
            <span>Kan Grupları Dağılımı</span>
            <ul class="mt-2">
                @foreach($bloodGroups as $group => $count)
                    <li>{{ $group }}: {{ $count }}</li>
                @endforeach
            </ul>
        </x-filament::card>
    </div>

    {{-- Detay tablosu --}}
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
            @foreach($matches as $m)
                <tr>
                    <td>{{ $m['blood_group'] }}</td>
                    <td>{{ $m['expiration_date'] }}</td>
                    <td>{{ $m['remaining_days'] }}</td>
                    <td>{{ $m['remaining_hours'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>
