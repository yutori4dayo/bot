<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scraping;

class ImageController extends Controller
{
    public function ImageList(){
      $images = Scraping::all();
      return view('imageList',compact('images'));
    }
}
