<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpQuery;
use App\Scraping;

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
      for ($i=0; $i <10; $i++) {
        sleep(3);
        $html = file_get_contents('http://kaomojis.com/twitter140aa3/');
        $get = phpQuery::newDocument($html);
      //  $title = $get->find('.aalist')->find('li:eq('.$i.')')->find('.tit_aa')->text();
        $title = 'a';
        $content = $get->find('.entry-content')->find('.box01:eq('.$i.')')->html();
        $names = new Scraping();
        $names->title = $title;
        $names->content = $content;
        $names->save();
        }
    }
}
