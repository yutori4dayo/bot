<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;
use App\Mail\SampleMail;
use App\Trend;

class GetTrends extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:trends';

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
     * @return mixed
     */
    public function handle()
    {
      if(Trend::truncate()){
        $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));
        $result = $connection->get("trends/place", ["id" =>23424856]);
        for ($i=0; $i <10; $i++) {
          $items = new Trend();
          $items->name = $result[0]->trends[$i]->name;
          if($items->save()){
            $tank[] = $result[0]->trends[$i]->name;
          }
        }
       \Mail::to('oonlookerss.manager@gmail.com')->send( new SampleMail($tank) );
      }
    }
}
