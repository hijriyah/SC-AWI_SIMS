<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\WhatsAppSchedule;
use App\Models\JadwalPertemuan;
use Illuminate\Support\Carbon;

class WhatsAppMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:whats-app-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $today = Carbon::today()->toDateString(); 
        $DataJadwalPertemuan = JadwalPertemuan::whereDate('start', $today)->get();

        foreach($DataJadwalPertemuan as $data)
        {
            WhatsAppSchedule::dispatch($data->description);
        }

    }
}
