<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;

class WhatsAppSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $ApiKey;
    protected $number;
    protected $sender;
    protected $message;

    public function __construct($message)
    {
        //
        $this->ApiKey = "G7qHnUlDNLoumkh9VuSVkqPGWgA7vMhn";
        $this->sender = "6282147482020";
        $this->number = "6283845205871";
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $client = new Client();
        $response = $client->post("https://wa.hosterweb.my.id/send-message", [
           'query' => [ 
                'api_key' => $this->ApiKey, 
                'sender' => $this->sender, 
                'number' => $this->number, 
                'message' => $this->message, 
            ]
        ]);

        if($response->getStatusCode() == 200)
        {
            echo "Request Send!";
        }
        else {
            echo "Request Failed!";
        }
    }
}
