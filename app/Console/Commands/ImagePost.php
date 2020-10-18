<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scraping;
use Abraham\TwitterOAuth\TwitterOAuth;
use Carbon\Carbon;

class ImagePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:image';

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
        $get = base64_encode(file_get_contents('https://cdn.hinatazaka46.com/files/14/diary/official/member/moblog/202007/mobGc9q7q.jpg'));

        $connection = new TwitterOAuth(env('CONSUMER_KEY'), env('COMSUMER_CEACRET_KEY'), env('ACCESS_TOKEN'), env('ACCESS_TOKEN_CEACRET'));

        $path = base64_encode('http://project1.yosiakiando.work/bot/public/img/img_5f084e4509692.jpg');
        $media1 = $connection->upload('media/upload', ['media_data' => $path]);
        $file_string = $media1->media_id_string;
        dd($file_string);
        $image2 = $connection->upload("media/upload", ["media" => $aUpdImgParams]);
        $tweet = 'Tweetする内容';
        $media_ids = implode(",",
        				[
        					$image1->media_id_string,
        					$image2->media_id_string,
        				]
        );
        $result = $connection->post(
        			"statuses/update",
        			[
        				"status" => $tweet,
        				"media_ids" => $media_ids
        			]
        );

    }
}
