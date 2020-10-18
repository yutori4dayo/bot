<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpQuery;
use App\Grade;

class GetMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '坂道メンバーをwikipediaから取得する';

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
      //坂道メンバー取得

      // $html = file_get_contents('https://ja.wikipedia.org/wiki/%E4%B9%83%E6%9C%A8%E5%9D%8246#%E7%8F%BE%E3%83%A1%E3%83%B3%E3%83%90%E3%83%BC');
      // $get = phpQuery::newDocument($html);
      // for ($i=1; $i <31 ; $i++) {
      //   $grades = new Grade();
      //   $name = $get->find('.sortable:eq(0)')->find('tbody')->find('tr:eq('.$i.')')->find('td:eq(0)')->text();
      //   $grad = $get->find('.sortable:eq(0)')->find('tbody')->find('tr:eq('.$i.')')->find('td:eq(6)')->text();
      //   $grade = substr($grad,0,1);
      //   $grades->name = $name;
      //   $grades->grade = $grade;
      //   $grades->type = 1;
      //   dump($name);
      //   $grades->save();
      // }

      // $html = file_get_contents('https://ja.wikipedia.org/wiki/%E4%B9%83%E6%9C%A8%E5%9D%8246#%E7%8F%BE%E3%83%A1%E3%83%B3%E3%83%90%E3%83%BC');
      // $get = phpQuery::newDocument($html);
      // for ($i=1; $i <17; $i++) {
      //   $grades = new Grade();
      //   $name = $get->find('.sortable:eq(1)')->find('tbody')->find('tr:eq('.$i.')')->find('td:eq(0)')->text();
      //   $grad = $get->find('.sortable:eq(1)')->find('tbody')->find('tr:eq('.$i.')')->find('td:eq(6)')->text();
      //   $grade = substr($grad,0,1);
      //   $grades->name = $name;
      //   $grades->grade = $grade;
      //   $grades->type = 1;
      //   dump($name);
      //   $grades->save();
      // }

      // $html = file_get_contents('https://ja.wikipedia.org/wiki/%E6%AC%85%E5%9D%8246#%E7%8F%BE%E3%83%A1%E3%83%B3%E3%83%90%E3%83%BC');
      // $get = phpQuery::newDocument($html);
      // for ($i=1; $i <29 ; $i++) {
      //   $grades = new Grade();
      //   $name = $get->find('.sortable:eq(0)')->find('tbody')->find('tr:eq('.$i.')')->find('td:eq(0)')->text();
      //   $grad = $get->find('.sortable:eq(0)')->find('tbody')->find('tr:eq('.$i.')')->find('td:eq(6)')->text();
      //   $grade = substr($grad,0,1);
      //   $grades->name = $name;
      //   $grades->grade = $grade;
      //   $grades->type = 2;
      //   dump($name);
      //   $grades->save();
      // }

      // $html = file_get_contents('https://ja.wikipedia.org/wiki/%E6%97%A5%E5%90%91%E5%9D%8246#%E7%8F%BE%E3%83%A1%E3%83%B3%E3%83%90%E3%83%BC');
      // $get = phpQuery::newDocument($html);
      // for ($i=1; $i <23 ; $i++) {
      //   $grades = new Grade();
      //   $name = $get->find('.sortable:eq(0)')->find('tbody')->find('tr:eq('.$i.')')->find('td:eq(0)')->text();
      //   $grad = $get->find('.sortable:eq(0)')->find('tbody')->find('tr:eq('.$i.')')->find('td:eq(6)')->text();
      //   $grade = substr($grad,0,1);
      //   $grades->name = $name;
      //   $grades->grade = $grade;
      //   $grades->type = 3;
      //   dump($grade);
      //  $grades->save();
      // }
    }
}
