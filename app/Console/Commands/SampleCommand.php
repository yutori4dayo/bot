<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Post;
use App\PostLog;
use Carbon\Carbon;

class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'post to twitter';

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
      $nowTime = Carbon::now()->format('H:i');
      if($nowTime === "19:00"){
        $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));
        $gets = $connection->get("search/tweets",["q" => "ぺこぱ",'count'=>20,"result_type"=>"recent","include_entities"=>false]);
          for ($i=0; $i <20 ; $i++) {
            $connection->post("favorites/create",["id" => $gets->statuses[$i]->id]);
          }
      }
      
      $count = Post::all()->count();
      $randomId = mt_rand(1,$count);
      $data = Post::find($randomId);
      $latestPostId = PostLog::orderBy('created_at','desc')->first();
      if($latestPostId->posts_id !== $data->id){
        $saveLog = new PostLog();
        $saveLog->posts_id = $data->id;
        $time = Carbon::now()->format('H時i分');
        if($saveLog->save()){
          $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));
          $connection->post("statuses/update", [
              "status" =>
                '時刻は'.$time.'だが時を戻そう..。'.PHP_EOL.
                PHP_EOL.
                PHP_EOL.
                $data->contents
          ]);
        }
      }
    }
}
