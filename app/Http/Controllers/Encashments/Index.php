<?php

namespace App\Http\Controllers\Encashments;

use Inertia\Inertia;
use App\Models\Encashment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Index extends Controller
{
    public function __invoke()
    {
        $query = Encashment::with('client')->where('team_id', Auth::user()->current_team_id);
        $totalValue = Encashment::where('team_id', Auth::user()->current_team_id)->sum('valoare');

        return Inertia::render('Encashments/Index', [
            'encashments' => $query->paginate(10)->withQueryString(),
            'total_value' => (int) $totalValue
        ]);
    }
}
