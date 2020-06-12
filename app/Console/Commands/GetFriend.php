<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;

class GetFriend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:friend';

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
      $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));
      $result = $connection->get("followers/ids", ["screen_name" =>'@hikakin',"count"=>500]);
      for ($i=0; $i <50 ; $i++) {
         $get = $connection->post("friendships/create", ["user_id" => $result->ids[$i]]);
      }
    }
}
