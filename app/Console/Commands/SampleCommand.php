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
    protected $signature = 'post:post';

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
      $count = Post::all()->count();
      $randomId = mt_rand(1,$count);
      $data = Post::find($randomId);
      $latestPostId = PostLog::orderBy('created_at','desc')->first();
      if($latestPostId->posts_id !== $data->id){
        $saveLog = new PostLog();
        $saveLog->posts_id = $data->id;
        if($saveLog->save()){
          $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));
          $connection->post("statuses/update", [
              "status" =>
                $data->contents
          ]);
        }
      }else {
        $count = Post::all()->count();
        $randomId = mt_rand(1,$count);
        $data = Post::find($randomId);
        $saveLog = new PostLog();
        $saveLog->posts_id = $data->id;
        if($saveLog->save()){
          $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));
          $connection->post("statuses/update", [
              "status" =>
                $data->contents
          ]);
        }
      }
    }
}
