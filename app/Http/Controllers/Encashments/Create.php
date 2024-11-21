<?php

namespace App\Http\Controllers\Encashments;

use App\Models\Team;
use Inertia\Inertia;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Create extends Controller
{
    public function __invoke()
    {
        $clients = Client::where('team_id', Auth::user()->current_team_id);

        return Inertia::render('Encashments/Create', [
            'clients' => $clients->get(),
            'current_team_id' => (int) Auth::user()->current_team_id,
            'bank_account' => Team::where('id', Auth::user()->current_team_id)->first()->cont_bancar
        ]);
    }
}
