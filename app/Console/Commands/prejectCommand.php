<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Post;
use App\PostLog;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Images;
use App\Usomatu;

class prejectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:get';

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
      $count = 200;
        $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));
        $gets = $connection->get("statuses/user_timeline",["screen_name" => "kyogen_fujoshi",'count'=>$count,"exclude_replies"=>"false"]);
         for ($i=0; $i <$count; $i++) {
          if(!empty($gets[$i]->extended_entities->media[0])){
            $data[] = $gets[$i]->extended_entities->media[0]->media_url_https;
            if(isset($gets[$i]->extended_entities->media[1])){
              $data[] = $gets[$i]->extended_entities->media[1]->media_url_https;
              if(isset($gets[$i]->extended_entities->media[2])){
                $data[] = $gets[$i]->extended_entities->media[2]->media_url_https;
                if(isset($gets[$i]->extended_entities->media[3])){
                  $data[] = $gets[$i]->extended_entities->media[3]->media_url_https;
                }
              }
            }
          }
         }
         foreach ($data as $key => $data) {
           $result = Images::make($data);
           $uniq = uniqid("img_").'.jpg';
           $save_path = public_path('uso/'.$uniq);
           $result->save($save_path);
           $paths = $uniq;
           $datas = new Usomatu();
           $datas->url = $paths;
           $datas->save();
           $this->info($key);
         }
    }
}
