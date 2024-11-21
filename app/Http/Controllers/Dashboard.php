<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Encashment;
use Illuminate\Support\Facades\Auth;

class Dashboard
{
    public function __invoke()
    {
        $priceWithTVA = 0;
        $totalTVA = 0;
        $priceWithoutTVA = 0;
        $taxaPeVenitTotal = 0;
        $profitNET = 0;

        $incasari = Encashment::where('team_id', Auth::user()->current_team_id)->get();

        foreach ($incasari as $incasare) {
            $valoareBruta = intval($incasare->valoare);
            $priceWithTVA += $valoareBruta;

            $tva = $valoareBruta * 19 / 119;
            $totalTVA += $tva;

            $valoareNet = $valoareBruta - $tva;
            $priceWithoutTVA += $valoareNet;

            $taxaPeVenit = $valoareNet * ($incasare->cota_taxa_venit / 100);
            $taxaPeVenitTotal += $taxaPeVenit;

            $profitNET += $valoareNet - $taxaPeVenit;
        }

        return Inertia::render('Dashboard', [
            'tva' => (int) $totalTVA,
            'taxa_venit' => (int) $taxaPeVenitTotal,
            'profit_net' => (int) $profitNET,
        ]);
    }
}
