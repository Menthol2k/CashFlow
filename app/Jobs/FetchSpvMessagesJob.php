<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class FetchSpvMessagesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $teams = Team::all();
        foreach ($teams as $team) {
            $messages = Http::withToken(env('SPV_TOKEN'), 'Bearer')->get("https://api.anaf.ro/prod/FCTEL/rest/listaMesajeFactura?zile=60&cif={$team->cif}")->body();
            $jsonMessages = json_decode($messages, true);
            if (array_key_exists('mesaje', $jsonMessages)) {
                $apiMessages = $jsonMessages['mesaje'];
                foreach ($apiMessages as $message) {
                    $existingMessage = Message::where('id_spv', $message['id'])->first();
                    if (!$existingMessage) {
                        $formattedDate = Carbon::createFromFormat('YmdHi', $message['data_creare'])->format('Y-m-d H:i:s');
                        $team_id = Team::where('cif', $message['cif'])->first()->id;
                        Message::create([
                            'team_id' => $team_id,
                            'date' => $formattedDate,
                            'cif' => $message['cif'],
                            'id_solicitare' => $message['id_solicitare'],
                            'details' => $message['detalii'],
                            'type' =>  $message['tip'],
                            'id_spv' => $message['id']
                        ]);
                    }
                }
            }
        }
        Log::info("A fost rulata comanda pentru a lua mesaje din API");
    }
}
