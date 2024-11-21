<?php

namespace App\Http\Controllers\Clients;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class Update extends Controller
{
    public function __invoke(Client $client)
    {
        request()->validate([
            'cui' => ['required', 'numeric', 'digits_between:6,8'],
            'denumire' => ['required'],
            'regcom' => ['required'],
            'cod_client' => ['nullable'],
            'platitor_tva' => ['required'],
            'adresa' => ['required', 'max:200'],
            'tara' => ['required'],
            'judet' => ['required'],
            'localitate' => ['nullable'],
            'iban' => ['nullable'],
            'banca' => ['nullable'],
            'email' => ['nullable'],
            'persoana_de_contact' => ['nullable'],
            'telefon' => ['nullable']
        ], [
            'digits_between' => 'Campul trebuie sa contina intre 6 si 8 caractere.',
            'max' => 'Campul nu poate depasii :max caractere.',
            'numeric' => 'Campul nu poate contine litere.',
        ]);

        $client->update(request()->all());

        return Redirect::to('/clients');
    }
}
