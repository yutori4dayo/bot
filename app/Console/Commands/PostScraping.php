<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scraping;
use Abraham\TwitterOAuth\TwitterOAuth;

class PostScraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:Scraping';

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
        $data = Scraping::inRandomOrder()->first();
        $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));
        $result = $connection->post("statuses/update", [
            "status" =>
            $data->title
        ]);

        if(empty($result->errors[0]->code)){
          Scraping::where('id',$data->id)->update(['post_flg'=>1]);
        }
    }
}
