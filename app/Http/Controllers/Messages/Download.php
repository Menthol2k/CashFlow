<?php

namespace App\Http\Controllers\Messages;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class Download extends Controller
{
    public function __invoke($id)
    {
        $file = Http::withToken(env('SPV_TOKEN'), 'Bearer')->get("https://api.anaf.ro/prod/ FCTEL/rest/descarcare?id={$id}");
        return $file;
    }
}
