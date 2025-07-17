{{-- resources/views/filament/components/matches-detail.blade.php --}}
@props(['record'])

@php
    use Illuminate\Support\Facades\Storage;
    $path1 = Storage::disk('local')->path($record->file_1);
    $path2 = Storage::disk('local')->path($record->file_2);
    // IOFactory'ı tam nitelikli çağırıyoruz, render yok!
    $sheet1 = \PhpOffice\PhpSpreadsheet\IOFactory::load($path1)->getActiveSheet()->toArray();
    $sheet2 = \PhpOffice\PhpSpreadsheet\IOFactory::load($path2)->getActiveSheet()->toArray();
    $matches = is_array($record->matched_records)
        ? $record->matched_records
        : json_decode($record->matched_records ?? '[]', true);
@endphp

<div class="space-y-4">
  <!-- 1. Dosya Tablosu -->
  <div>
    <h5 class="font-semibold">1. Dosya</h5>
    <table class="table-auto w-full text-xs">
      <thead><tr>
        @foreach($sheet1[0] ?? [] as $h)
          <th class="border px-2 py-1">{{ $h }}</th>
        @endforeach
      </tr></thead>
      <tbody>
        @foreach(array_slice($sheet1, 1) as $row)
          <tr>
            @foreach($row as $cell)
              <td class="border px-2 py-1">{{ $cell }}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- 2. Dosya Tablosu -->
  <div>
    <h5 class="font-semibold">2. Dosya</h5>
    <table class="table-auto w-full text-xs">
      <thead><tr>
        @foreach($sheet2[0] ?? [] as $h)
          <th class="border px-2 py-1">{{ $h }}</th>
        @endforeach
      </tr></thead>
      <tbody>
        @foreach(array_slice($sheet2, 1) as $row)
          <tr>
            @foreach($row as $cell)
              <td class="border px-2 py-1">{{ $cell }}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Eşleşen Kayıtlar -->
  <div>
    <h5 class="font-semibold">Eşleşen Kayıtlar</h5>
    @if(count($matches))
      <table class="table-auto w-full text-xs">
        <thead><tr><th class="border px-2 py-1">Eşleşme Kaydı</th></tr></thead>
        <tbody>
          @foreach($matches as $item)
            <tr><td class="border px-2 py-1">{{ $item }}</td></tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p class="text-xs text-gray-500">Eşleşme bulunamadı.</p>
    @endif
  </div>
</div>
