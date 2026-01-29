<x-filament::page>
    @php
        $matched = is_string($this->record->matched_records)
            ? json_decode($this->record->matched_records, true)
            : ($this->record->matched_records ?? []);

        if (! is_array($matched)) {
            $matched = [];
        }
    @endphp

    <h2 class="text-xl font-bold mb-4">
        {{ $this->record->file_1_name }} ↔ {{ $this->record->file_2_name }}
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kan Grubu</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stok Sayısı</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kullanılacak Adet</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">İşlem</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Son Kullanma Tarihi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kalan Gün</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($matched as $item)
                    @php
                        $expiration = \Carbon\Carbon::parse($item['expiration_date']);

                        // Bugünden SKT'ye kalan gün
                        $remainingDays = now()->startOfDay()->lt($expiration->startOfDay())
                            ? now()->startOfDay()->diffInDays($expiration->startOfDay())
                            : 0;

                        // Kalan gün 0 ise bu kan KESİNLİKLE kullanılamaz
                        $isExpired = $remainingDays <= 0;

                        $usage = (int) ($usageAmounts[$item['blood_group']] ?? 1);
                        $invalidUsage = $usage < 1 || $usage > $item['stock_count'];
                    @endphp
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $item['blood_group'] }}
                        </td>

                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $item['stock_count'] }}
                        </td>

                        <td class="px-4 py-2 whitespace-nowrap">
                            <input
                                x-data
                                x-on:input="if ($event.target.value > {{ $item['stock_count'] }}) $event.target.value = {{ $item['stock_count'] }}"
                                type="number"
                                min="1"
                                max="{{ $item['stock_count'] }}"
                                wire:model.defer="usageAmounts.{{ $item['blood_group'] }}"
                                class="border rounded w-20 p-1"
                                @if($isExpired) disabled @endif
                            />
                            <div class="text-xs text-red-600 mt-1">
                                @if ($invalidUsage)
                                    Geçersiz adet!
                                @elseif($isExpired)
                                    Süre geçti, bu kan kullanılamaz.
                                @endif
                            </div>
                        </td>

                        <td class="px-4 py-2 whitespace-nowrap">
                            <x-filament::button
                                size="sm"
                                wire:click="useBlood('{{ $item['blood_group'] }}')"
                                :disabled="$invalidUsage || $isExpired"
                            >
                                @if($isExpired)
                                    Süre Geçti (Kullanılamaz)
                                @else
                                    Kullan
                                @endif
                            </x-filament::button>
                        </td>

                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $expiration->format('d M Y') }}
                            @if($isExpired)
                                <div class="text-xs text-red-600">
                                    SKT geçmiş — imhaya gönderilmelidir.
                                </div>
                            @endif
                        </td>

                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ $remainingDays }}
                            @if($isExpired)
                                <div class="text-xs text-red-600">
                                    Süre doldu, kullanılamaz.
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Eşleşme bulunamadı.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-filament::page>
