<?php

namespace App\Http\Controllers\Encashments;

use App\Models\Team;
use Inertia\Inertia;
use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Models\Encashment;
use Illuminate\Support\Facades\Auth;

class Edit extends Controller
{
    public function __invoke(Encashment $encashment)
    {
        $clients = Client::where('team_id', Auth::user()->current_team_id);
        $selectedClient = Client::find($encashment->client_id);

        return Inertia::render('Encashments/Edit', [
            'encashment' => $encashment,
            'clients' => $clients->get(),
            'selected_client' => $selectedClient,
            'current_team_id' => (int) Auth::user()->current_team_id,
            'bank_account' => Team::where('id', Auth::user()->current_team_id)->first()->cont_bancar
        ]);
    }
}
