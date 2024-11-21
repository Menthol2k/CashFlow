<?php

namespace App\Http\Controllers\Clients;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Create extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Clients/Create', [
            'current_team_id' => (int) Auth::user()->current_team_id,
        ]);
    }
}
