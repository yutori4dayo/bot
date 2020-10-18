<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpQuery;
use App\Scraping;
use Storage;
use Intervention\Image\ImageManagerStatic as Images;
use App\Image;
use Carbon\Carbon;
use App\Mail\SampleMail;

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
      for ($z=0; $z < 1; $z++) {
        for ($n=0; $n < 5; $n++) {
          sleep(2);
          $html = file_get_contents('http://blog.nogizaka46.com/?p='.$z);
          $sorce = mb_convert_encoding($html, "UTF-8", "auto");
          $get = phpQuery::newDocumentHTML($sorce);
          $dates = $get->find('.right2')->find('.clearfix:eq('.$n.')')->find('.date')->text();
          $name = $get->find('.right2')->find('.clearfix:eq('.$n.')')->find('.heading')->find('.author')->text();
          $title = $get->find('.right2')->find('.clearfix:eq('.$n.')')->find('.heading')->find('.entrytitle')->text();
          $url = $get->find('.right2')->find('.clearfix:eq('.$n.')')->find('.heading')->find('.entrytitle')->find('a')->attr('href');

          $dt = new Carbon(str_replace("/","",substr($dates,0,9)));
          $date = $dt->format('Ymd');

          if($get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(0)')->attr('src') !==''){
            $imgs[0] = $get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(0)')->attr('src');
          }else {
            $imgs[0] = null;
          }
          if($get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(1)')->attr('src') !==''){
            $imgs[1] = $get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(1)')->attr('src');
          }else {
            $imgs[1] = null;
          }
          if($get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(2)')->attr('src') !==''){
            $imgs[2] = $get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(2)')->attr('src');
          }else {
            $imgs[2] = null;
          }
          if($get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(3)')->attr('src') !==''){
            $imgs[3] = $get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(3)')->attr('src');
          }else {
            $imgs[3] = null;
          }
          if($get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(4)')->attr('src') !==''){
            $imgs[4] = $get->find('.right2')->find('.entrybody:eq('.$n.')')->find('img:eq(4)')->attr('src');
          }else {
            $imgs[4] = null;
          }
          $images = serialize($imgs);
          dump($title);
          $datas = Scraping::where('title',$title)->where('name',$name)->where('date',$date)->where('flg',3)->get();
          if($datas->isEmpty()){

                if(isset($imgs[0]) && $imgs[0] !==''){
                  $result = Images::make(@file_get_contents($imgs[0]));
                  $ext = '.jpg';
                  $uniq = uniqid("img_").$ext;
                  $save_path = public_path('img/'.$uniq);
                  $result->save($save_path);
                  $paths[0] = $uniq;
                }else {
                  $paths[0] = null;
                }
                if(isset($imgs[1]) && $imgs[1] !==''){
                  $result = Images::make(@file_get_contents($imgs[1]));
                  $ext = '.jpg';
                  $uniq = uniqid("img_").$ext;
                  $save_path = public_path('img/'.$uniq);
                  $result->save($save_path);
                  $paths[1] = $uniq;
                }else {
                  $paths[1] = null;
                }
                if(isset($imgs[2]) && $imgs[2] !==''){
                  $result = Images::make(@file_get_contents($imgs[2]));
                  $ext = '.jpg';
                  $uniq = uniqid("img_").$ext;
                  $save_path = public_path('img/'.$uniq);
                  $result->save($save_path);
                  $paths[2] = $uniq;
                }else {
                  $paths[2] = null;
                }
                if(isset($imgs[3]) && $imgs[3] !==''){
                  $result = Images::make(@file_get_contents($imgs[3]));
                  $ext = '.jpg';
                  $uniq = uniqid("img_").$ext;
                  $save_path = public_path('img/'.$uniq);
                  $result->save($save_path);
                  $paths[3] = $uniq;
                }else {
                  $paths[3] = null;
                }
                if(isset($imgs[4]) && $imgs[4] !==''){
                  $result = Images::make(@file_get_contents($imgs[4]));
                  $ext = '.jpg';
                  $uniq = uniqid("img_").$ext;
                  $save_path = public_path('img/'.$uniq);
                  $result->save($save_path);
                  $paths[4] = $uniq;
                }else {
                  $paths[4] = null;
                }
                $path = serialize($paths);
                $names = new Scraping();
                $names->date = $date;
                $names->flg = 3;
                $names->title = $title;
                $names->url = $url;
                $this->question($title);
                $names->content = $path;
                $names->name = $name;
                $names->save();
                $tank[] = '乃木坂 : '.$title;
          }else {
            $this->error('nogizaka no data insert');
            $tank[] = null;
          }
        }
    }

       for ($n=0; $n<1; $n++) {
        for ($i=0; $i <20; $i++) {
          sleep(1);
          $html = file_get_contents('https://www.keyakizaka46.com/s/k46o/diary/member/list?ima=0000&page='.$n.'&cd=member');
          $get = phpQuery::newDocument($html);

          $datef = $get->find('article:eq('.$i.')')->find('.innerHead')->find('.box-date')->find('time:eq(0)')->text();
          $datee = $get->find('article:eq('.$i.')')->find('.innerHead')->find('.box-date')->find('time:eq(1)')->text();
          $newDate = $datef.'-'.$datee;

          $dateData = str_replace(".",'-', $newDate);
          $dt = new Carbon($dateData);
          $dd = $dt->format('Y-m-d');
          $titles = $get->find('article:eq('.$i.')')->find('.innerHead')->find('.box-ttl')->find('h3')->text();
          $urls = $get->find('article:eq('.$i.')')->find('.innerHead')->find('.box-ttl')->find('h3')->find('a')->attr('href');
          $url = "https://www.keyakizaka46.com".$urls;

          $name = $get->find('article:eq('.$i.')')->find('.innerHead')->find('.box-ttl')->find('p')->text();

          $title = str_replace(" ","",trim(str_replace("\n","",$titles)));
      //    $img = $get->find('article:eq('.$i.')')->find('.box-article')->find('img')->attr('src');

          if($get->find('article:eq('.$i.')')->find('.box-article')->find('img:eq(0)')->attr('src') !==null){
            $imgs[0] = $get->find('article:eq('.$i.')')->find('.box-article')->find('img:eq(0)')->attr('src');
          }else {
            $imgs[0] = null;
          }
          if($get->find('article:eq('.$i.')')->find('.box-article')->find('img:eq(1)')->attr('src') !==null){
            $imgs[1] = $get->find('article:eq('.$i.')')->find('.box-article')->find('img:eq(1)')->attr('src');
          }else {
            $imgs[1] = null;
          }
          if($get->find('article:eq('.$i.')')->find('.box-article')->find('img:eq(2)')->attr('src') !==null){
            $imgs[2] = $get->find('article:eq('.$i.')')->find('.box-article')->find('img:eq(2)')->attr('src');
          }else {
            $imgs[2] = null;
          }
          if($get->find('article:eq('.$i.')')->find('.box-article')->find('img:eq(3)')->attr('src') !==null){
            $imgs[3] = $get->find('article:eq('.$i.')')->find('.box-article')->find('img:eq(3)')->attr('src');
          }else {
            $imgs[3] = null;
          }

          $datas = Scraping::where('title',$title)->where('name',str_replace(" ","",trim(str_replace("\n","",$name))))->where('date',$dd)->where('flg',1)->get();
          if($datas->isEmpty()){
              if(isset($imgs[0]) && $imgs[0] !==''){
                $result = Images::make(file_get_contents($imgs[0]));
                $ext = '.jpg';
                $uniq = uniqid("img_").$ext;
                $save_path = public_path('kimg/'.$uniq);
                $result->save($save_path);
                $paths[0] = $uniq;
              }else {
                $paths[0] = null;
              }
              if(isset($imgs[1]) && $imgs[1] !==''){
                $result = Images::make(file_get_contents($imgs[1]));
                $ext = '.jpg';
                $uniq = uniqid("img_").$ext;
                $save_path = public_path('kimg/'.$uniq);
                $result->save($save_path);
                $paths[1] = $uniq;
              }else {
                $paths[1] = null;
              }
              if(isset($imgs[2]) && $imgs[2] !==''){
                $result = Images::make(file_get_contents($imgs[2]));
                $ext = '.jpg';
                $uniq = uniqid("img_").$ext;
                $save_path = public_path('kimg/'.$uniq);
                $result->save($save_path);
                $paths[2] = $uniq;
              }else {
                $paths[2] = null;
              }
              if(isset($imgs[3]) && $imgs[3] !==''){
                $result = Images::make(file_get_contents($imgs[3]));
                $ext = '.jpg';
                $uniq = uniqid("img_").$ext;
                $save_path = public_path('kimg/'.$uniq);
                $result->save($save_path);
                $paths[3] = $uniq;
              }else {
                $paths[3] = null;
              }
              $path = serialize($paths);
            $names = new Scraping();
            $names->title = $title;
            $this->question($title);
            $names->url = $url;
            $names->content = $path;
            $names->name = str_replace(" ","",trim(str_replace("\n","",$name)));
            $names->date = $dd;
            $names->flg = 1;
            $names->save();
            $tank[] = '欅坂 : '.$title;
          }else {
            $this->error('keyakizaka no data insert');
            $tank[] = null;
          }
    }
  }

      for ($n=0; $n < 1; $n++) {
        for ($i=0; $i <20; $i++) {
          sleep(1);
          $html = file_get_contents('https://www.hinatazaka46.com/s/official/diary/member/list?ima=0000&page='.$n.'&cd=member');
          $get = phpQuery::newDocument($html);
          $urls = $get->find('.p-blog-article:eq('.$i.')')->find('.p-button__blog_detail')->find('a')->attr('href');
          $url = "https://www.hinatazaka46.com".$urls;
          $dates = $get->find('.p-blog-article:eq('.$i.')')->find('.p-blog-article__head')->find('.c-blog-article__title')->text();
          $title = str_replace(" ","",trim(str_replace("\n","",$dates)));
          $dates = $get->find('.p-blog-article:eq('.$i.')')->find('.p-blog-article__head')->find('.p-blog-article__info')->find('.c-blog-article__date')->text();
          $datee = str_replace("\n", '', $dates);
          $dateed = str_replace(".", '-', $datee);
          $target = $dateed;
          $res = str_replace(".","-",$target);
          $a = substr(trim($dateed),0,-6);
          $dt = new Carbon($a);
          $e = $dt->format('Y-m-d');
          $name = $get->find('.p-blog-article:eq('.$i.')')->find('.p-blog-article__head')->find('.p-blog-article__info')->find('.c-blog-article__name')->text();

        //  $img = $get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img')->attr('src');

          if($get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img:eq(0)')->attr('src') !==null){
            $imgs[0] = $get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img:eq(0)')->attr('src');
          }else {
            $imgs[0] = null;
          }
          if($get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img:eq(1)')->attr('src') !==null){
            $imgs[1] = $get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img:eq(1)')->attr('src');
          }else {
            $imgs[1] = null;
          }
          if($get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img:eq(2)')->attr('src') !==null){
            $imgs[2] = $get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img:eq(2)')->attr('src');
          }else {
            $imgs[2] = null;
          }
          if($get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img:eq(3)')->attr('src') !==null){
            $imgs[3] = $get->find('.p-blog-article:eq('.$i.')')->find('.c-blog-article__text')->find('img:eq(3)')->attr('src');
          }else {
            $imgs[3] = null;
          }

          dump(str_replace(" ","",trim(str_replace("\n","",$name))));
          dump(str_replace(" ","",trim(str_replace("\n","",$title))));
          $datas = Scraping::where('title',$title)->where('name',str_replace(" ","",trim(str_replace("\n","",$name))))->where('date',$e)->where('flg',2)->get();
          if($datas->isEmpty()){
            if(isset($imgs[0]) && $imgs[0] !==''){
               $result = Images::make(file_get_contents($imgs[0]));
               $ext = '.jpg';
               $uniq = uniqid("himg_").$ext;
               $save_path = public_path('himg/'.$uniq);
               $result->save($save_path);
               $paths[0] = $uniq;
             }else {
               $paths[0] = null;
             }
             if(isset($imgs[1]) && $imgs[1] !==''){
               $result = Images::make(file_get_contents($imgs[1]));
               $ext = '.jpg';
               $uniq = uniqid("himg_").$ext;
               $save_path = public_path('himg/'.$uniq);
               $result->save($save_path);
               $paths[1] = $uniq;
             }else {
               $paths[1] = null;
             }
             if(isset($imgs[2]) && $imgs[2] !==''){
               $result = Images::make(file_get_contents($imgs[2]));
               $ext = '.jpg';
               $uniq = uniqid("himg_").$ext;
               $save_path = public_path('himg/'.$uniq);
               $result->save($save_path);
               $paths[2] = $uniq;
             }else {
               $paths[2] = null;
             }
             if(isset($imgs[3]) && $imgs[3] !==''){
               $result = Images::make(file_get_contents($imgs[3]));
               $ext = '.jpg';
               $uniq = uniqid("himg_").$ext;
               $save_path = public_path('himg/'.$uniq);
               $result->save($save_path);
               $paths[3] = $uniq;
             }else {
               $paths[3] = null;
             }
             $path = serialize($paths);
            $names = new Scraping();
            $this->question($title);
            $names->title = $title;
            $names->url = $url;
            $names->content = $path;
            $names->name = str_replace(" ","",trim(str_replace("\n","",$name)));
            $names->date = $e;
            $names->flg = 2;
            $names->save();
            $tank[] = '日向坂 : '.$title;

          }else {
            $this->error('hinatazaka no data insert');
            $tank[] = null;
          }
        }
    }
    \Mail::to('oonlookerss.manager@gmail.com')->send( new SampleMail($tank) );

}
}
