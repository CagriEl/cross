<?php

namespace App\Observers;

use App\Models\Hasta;
use App\Services\MatchingService;

class PatientObserver
{
    /**
     * Hasta oluşturulduğunda çalışır.
     */
   public function created(Hasta $hasta): void  // <--- BURASI DEĞİŞTİ (Patient yerine Hasta yazdık)
    {
        $matchingService = new MatchingService();
        
        // Servisteki metod adının da checkForHasta olduğundan emin ol
        $matchingService->checkForHasta($hasta); 
    }
}