<?php

namespace App\Http\Controllers\Messages;

use App\Models\Team;
use Inertia\Inertia;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Index extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'type' => ['in:FACTURA PRIMITA,FACTURA TRIMISA'],
        ]);

        $query = Message::where('team_id', Auth::user()->current_team_id)->orderByDesc('date');

        if (request('type')) {
            $query->where('type', request('type'));
        }

        return Inertia::render('Messages/Index', [
            'messages' => $query->paginate(10)->withQueryString(),
            'filters' => request()->all(['type'])
        ]);
    }
}
