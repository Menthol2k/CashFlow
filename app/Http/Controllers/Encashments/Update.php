<?php

namespace App\Http\Controllers\Encashments;

use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Models\Encashment;
use Illuminate\Validation\ValidationException;

class Update extends Controller
{
    public function __invoke(Encashment $encashment)
    {
        request()->validate([
            'team_id' => ['required'],
            'client' => ['required'],
            'cont_bancar' => ['required'],
            'tip_document' => ['required'],
            'cota_tva' => ['required_if:tva,true', 'numeric'],
            'tva' => ['required'],
            'data_emiterii' => ['required', 'date'],
            'numar' => ['required'],
            'valoare' => ['required', 'numeric'],
        ], [
            'numeric' => 'Campul nu poate contine litere sau virgula.',
            'date' => 'Campul nu are o data valida.',
            'required_if' => 'Campul este obligatoriu.'
        ]);

        $client = Client::find(request('client')['id']);
        if (!$client) {
            throw ValidationException::withMessages(['client' => 'Nu a fost gasit nici-un client, va rugam adaugati clientul in platforma.']);
        }

        $encashment->update([
            'team_id' => request('team_id'),
            'client_id' => $client->id,
            'cont_bancar' => request('cont_bancar'),
            'tip_document' => request('tip_document'),
            'cota_tva' => request('cota_tva'),
            'tva' => request('tva'),
            'data_emiterii' => request('data_emiterii'),
            'numar' => request('numar'),
            'valoare' => request('valoare'),
        ]);

        return redirect()->to('/encashments')->with('message', 'Incasarea a fost modificata cu succes!');
    }
}
