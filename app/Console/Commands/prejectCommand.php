<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Post;
use App\PostLog;
use Carbon\Carbon;

class prejectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:favorites';

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
        $gets = $connection->get("search/tweets",["q" => "ぺこぱ",'count'=>2,"result_type"=>"recent","include_entities"=>false]);
          for ($i=0; $i<2; $i++) {
            $connection->post("favorites/create",["id" => $gets->statuses[$i]->id]);
          }
    }
}
