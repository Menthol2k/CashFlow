<?php

namespace App\Console\Commands;

use App\Jobs\FetchSpvMessagesJob;
use Illuminate\Console\Command;

class SynchronizeSpvMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:synchronize-spv-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronizare si cautarea de mesaje noi din SPV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new FetchSpvMessagesJob);
    }
}
