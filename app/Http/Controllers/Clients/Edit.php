<?php

namespace App\Http\Controllers\Clients;

use Inertia\Inertia;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Edit extends Controller
{
    public function __invoke(Client $client)
    {
        return Inertia::render('Clients/Edit', [
            'current_team_id' => (int) Auth::user()->current_team_id,
            'client' => $client,
        ]);
    }
}
