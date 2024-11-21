<?php

namespace App\Http\Controllers\Clients;

use Inertia\Inertia;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Index extends Controller
{
    public function __invoke()
    {
        $query = Client::where('team_id', Auth::user()->current_team_id)->orderByDesc('id');

        return Inertia::render('Clients/Index', [
            'clients' => $query->paginate(10)->withQueryString(),
        ]);
    }
}
