<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
 
class UpdateUnitPriceToProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:updateUnitPrice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for Update Unit Price To Project';

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
        return $this->getPrices();
    }

    public function getPrices()
    {
        //Log::debug("cron:updateUnitPrice, Cron is working fine! ".date('Y-d-d H:i:s A'));
        //$this->info("cron:updateUnitPrice, Cron is working fine! terminal ".date('Y-d-d H:i:s A'));
        $projects = Project::where('status',1)->get();
        if($projects->isNotEmpty()){
            foreach($projects as $row){

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                ])->get('https://reservation.cuengine.com/api/v7/project/getMinMaxPrice/'.$row->res_project_id);
                
                 if($response->status() === 200){
                    $units = $response->json();
                    if( $units){
                        $data = [
                            'min_price' => $units['data']['min_price'], 
                            'max_price'=> $units['data']['max_price'], 
                            'min_built_up_area'=> $units['data']['min_built_up_area'],
                            'max_built_up_area'=> $units['data']['max_built_up_area']
                        ];
                        Project::where('id',$row->id)->update($data);
                        //Log::debug('getMinMaxPrice updated'.$row->title,['units' => $units]);
                    }
                }else{
                    //Log::debug('getMinMaxPrice failed ='.$row->title);

                }

            }
            //end loop
        }

    }
}
