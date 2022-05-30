<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\CurrencyExchangeRate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
 
class OpenExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:openexchangerates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getRates();
    }

    public function getRates()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get('https://openexchangerates.org/api/latest.json?app_id=9b14b16a54554ffbae5422c6f5561ad1');
        
         if($response->status() === 200){
            $rates = $response->json();
            //dd($rates['rates']);
            if( $rates){
                $data = $rates['rates'];
                $data['base'] = $rates['base'];
                CurrencyExchangeRate::create($data);
                //Log::debug('cexchangerates inserted');
                //$this->debug('cexchangerates inserted.');
            }
        }else{
            Log::debug('cexchangerates failed.');

        }
    }
}
