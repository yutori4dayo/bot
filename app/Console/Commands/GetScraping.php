<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpQuery;
use App\Scraping;
use Storage;

class GetScraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:aa';

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
      for ($i=0; $i <20; $i++) {
        sleep(1);
        $html = file_get_contents('https://www.keyakizaka46.com/s/k46o/diary/member/list?ima=0000');
        $get = phpQuery::newDocument($html);

        $date = $get->find('article:eq('.$i.')')->find('.innerHead')->find('.box-date')->find('time')->text();
        $dateDatas = str_replace("\n", '', $date);
        $dateData = str_replace(".",'', $dateDatas);

        $titles = $get->find('article:eq('.$i.')')->find('.innerHead')->find('.box-ttl')->find('h3')->text();
        $title = str_replace("\n", '', $titles);

        $img = $get->find('article:eq('.$i.')')->find('.box-article')->find('img')->attr('src');
        $datas = Scraping::where('content',$img)->where('flg',1)->get();

        if($datas->isEmpty()){
          $names = new Scraping();
          $names->title = $title;
          $names->content = $img;
          $names->date = $dateData;
          $names->flg = 1;
          $names->save();
        }
      }

        for ($i=0; $i <20; $i++) {
          sleep(1);
          $html = file_get_contents('https://www.hinatazaka46.com/s/official/diary/member/list?ima=0000');
          $get = phpQuery::newDocument($html);

          $dates = $get->find('.p-blog-article:eq('.$i.')')->find('.p-blog-article__head')->find('.c-blog-article__title')->text();
          $title = str_replace("\n", '', $dates);

          $dates = $get->find('.p-blog-article:eq('.$i.')')->find('.p-blog-article__head')->find('.p-blog-article__info')->find('.c-blog-article__date')->text();
          $datee = str_replace("\n", '', $dates);
          $dateed = str_replace(".", '', $datee);

          $img = $get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img')->attr('src');

          $datas = Scraping::where('content',$img)->where('flg',2)->get();

          if($datas->isEmpty()){
            $names = new Scraping();
            $names->title = $title;
            $names->content = $img;
            $names->date = $dateed;
            $names->flg = 2;
            $names->save();
          }
        }
    }
}
